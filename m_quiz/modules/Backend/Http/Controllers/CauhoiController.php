<?php namespace Modules\Backend\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use App\Cauhoi;
use App\Monhoc;
use App\Dapan;
use Request;
use Illuminate\Http\Request as Request1;
use Modules\Backend\Http\Requests\CauhoiRequest;
use Carbon\Carbon;
use Auth;

class CauhoiController extends Controller {

	/**
	* Danh sách câu hỏi
	**/
	public function index()
	{
		$keyword = Request::get('keyword', '');
		if($keyword)
		{
			$cauhois = Cauhoi::where('noi_dung_cau_hoi', 'like', "%$keyword%")
				->where('user_id', Auth::user()->id)
				->orderBy('created_at', 'desc')->paginate(10);
			$cauhois->appends(['keyword' => $keyword]);
		}
		else
		{
			$cauhois = Cauhoi::orderBy('created_at', 'desc')
				->where('user_id', Auth::user()->id)->paginate(10);
		}
		return view('backend::cauhoi.list', ['cauhois' => $cauhois]);
	}
	/**
	* Tạo mới câu hỏi
	**/
	public function new_cau_hoi()
	{
		$monhocs = Monhoc::all();
		return view('backend::cauhoi.new_cau_hoi', ['monhocs' => $monhocs]);
	}
	/**
	* Save tạo mới câu hỏi
	**/
	public function save_new_cau_hoi(CauhoiRequest $request)
	{
		if($request->mon_hoc_id == null)
		{
			return redirect()->route('backend.new-cau-hoi')
				->withErrors('Chưa chọn môn học nào.');
		}
		else
		{
			$cauhoi = new Cauhoi;

			$cauhoi->mon_hoc_id = $request->mon_hoc_id;
			$cauhoi->user_id = Auth::user()->id;
			$cauhoi->noi_dung_cau_hoi = $request->noi_dung_cau_hoi;
			$cauhoi->save();
			$dsDapAn = $request->noi_dung_dap_an;

			foreach ($dsDapAn as $key => $value) {
				$dapAn = new Dapan;
				if($value[0] != '')
				{
					$dapAn->cau_hoi_id = $cauhoi->id;
					$dapAn->noi_dung_dap_an = $value[0];
					$dapAn->dung_sai = (isset($value[1]) ? $value[1] : '');
					$dapAn->save();
				}
			}
			return redirect()->route('backend.cau-hoi')->withSuccess('Tạo mới câu hỏi thành công !');
		}
	}
	/**
	* Chỉnh sửa câu hỏi
	**/
	public function edit_cau_hoi($cau_hoi_id)
	{
		$cauhoi = Cauhoi::find($cau_hoi_id);
		if($cauhoi['user_id'] != Auth::user()->id)
		{
			return redirect()->route('backend.cau-hoi')
				->withErrors('Không có câu hỏi này !');
		}
		else{
			$mh = $cauhoi->monhocs;
			$monhocs = Monhoc::all();
			if(count($cauhoi->dapans) > 0){
				foreach($cauhoi->dapans as $da)
				{
					$dapans[] = $da;
				}
				return view('backend::cauhoi.edit_cau_hoi',
					[
						'monhocs' => $monhocs,
						'cauhoi' => $cauhoi,
						'dapans' => $dapans,
						'mh' => $mh
					]);
			}
			else{
				return view('backend::cauhoi.edit_cau_hoi',
					[
						'monhocs' => $monhocs,
						'cauhoi' => $cauhoi,
						'mh' => $mh
					]);
			}
		}
	}
	/**
	* Save chỉnh sửa câu hỏi
	**/
	public function save_edit_cau_hoi($cau_hoi_id, CauhoiRequest $request)
	{
		$cauhoi = Cauhoi::find($cau_hoi_id);

		// Khi câu hỏi thuộc bài thi nào đó
		if(count($cauhoi->baithis) > 0)
		{
			foreach($cauhoi->baithis as $baithi)
			{
				$time = Carbon::createFromTimeStamp(strtotime($baithi['ngay_thi'])) < Carbon::now();
				// Nếu bài thi đã quá hạn thi thì không được sửa câu hỏi
				if($time == true)
				{
					return redirect()
						->route('backend.cau-hoi.edit-cau-hoi', [$cau_hoi_id, 'page'=>Request::get('page',1)])
						->withErrors('Không thể chỉnh sửa câu hỏi vì bài thi "' . $baithi['ten_bai_thi'] . '" quá hạn.');
				}
				else{
					$cauhoi->noi_dung_cau_hoi = $request->noi_dung_cau_hoi;
					$cauhoi->save();

					$dsDapAn = $request->noi_dung_dap_an;
					$da = Dapan::where('cau_hoi_id', $cau_hoi_id)->get();
					foreach($da as $da)
					{
						$da->delete();
					}

					foreach($dsDapAn as $key => $value)
					{
						$dapAn = new Dapan;
						if($value[0] != '')
						{
							$dapAn->cau_hoi_id = $cauhoi->id;
							$dapAn->noi_dung_dap_an = $value[0];
							$dapAn->dung_sai = (isset($value[1]) ? $value[1] : '');
							$dapAn->save();
						}
					}
					return redirect()->route('backend.cau-hoi', ['page'=>Request::get('page',1)])
						->withSuccess('Chỉnh sửa thành công câu hỏi');
				}
			}
		}
		else{
			$cauhoi->mon_hoc_id = $request->mon_hoc_id;
			$cauhoi->noi_dung_cau_hoi = $request->noi_dung_cau_hoi;
			$cauhoi->save();

			$dsDapAn = $request->noi_dung_dap_an;
			$da = Dapan::where('cau_hoi_id', $cau_hoi_id)->get();
			foreach($da as $da)
			{
				$da->delete();
			}

			foreach($dsDapAn as $key => $value)
			{
				$dapAn = new Dapan;
				if($value[0] != '')
				{
					$dapAn->cau_hoi_id = $cauhoi->id;
					$dapAn->noi_dung_dap_an = $value[0];
					$dapAn->dung_sai = (isset($value[1]) ? $value[1] : '');
					$dapAn->save();
				}
			}
			return redirect()->route('backend.cau-hoi', ['page'=>Request::get('page',1)])
				->withSuccess('Chỉnh sửa thành công câu hỏi');
		}
	}
	/**
	* Xóa câu hỏi
	**/
	public function delete_cau_hoi(Request1 $request)
	{
		$cau_hoi_id = $request->cau_hoi_id;
		$cauhoi = Cauhoi::find($request->get('cau_hoi_id', 0));
		if($cauhoi)
		{
			if(count($cauhoi->baithis) > 0)
			{
				$baithi = $cauhoi->baithis;

				foreach($baithi as $bt)
				{
					$time = Carbon::createFromTimeStamp(strtotime($bt['ngay_thi'])) < Carbon::now();
					if($time == true)
					{
						return redirect()
							->route('backend.cau-hoi',
								['page'=>Request::get('page',1)])
							->withErrors('Không thể xóa câu hỏi này vì bài thi đã quá hạn.');
					}
					else
					{
						$bt->khoa = 0;
						$bt->save();
						$cauhoi->delete();
						return redirect()
							->route('backend.cau-hoi',
								['page'=>Request::get('page',1)])
							->withSuccess('Xóa câu hỏi thành công');
					}
				}
			}
			else
			{
				$cauhoi->delete();
				return redirect()
					->route('backend.cau-hoi',
						['page'=>Request::get('page',1)])
					->withSuccess('Xóa câu hỏi thành công');
			}
		}
	}
}