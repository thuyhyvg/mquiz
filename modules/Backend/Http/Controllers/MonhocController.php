<?php namespace Modules\Backend\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use App\Monhoc;
use Request;
use Cache;
use Modules\Backend\Http\Requests\CauhoiRequest;
use Modules\Backend\Http\Requests\MonhocRequest;
use Modules\Backend\Http\Requests\BaithiRequest;
use Illuminate\Http\Request as Request1;
use App\Cauhoi;
use App\Dapan;
use Auth;
use App\Baithi;
use App\BaithiCauhoi;
use Carbon\Carbon;

class MonhocController extends Controller {

	/**
	* Danh sách môn học Teacher
	*/
	public function index()
	{
		$keyword = Request::get('keyword', '');
		if($keyword)
		{
			$monhocs = Monhoc::where('ten_mon_hoc', 'like', "%$keyword%")
				->orderBy('created_at', 'desc')->paginate(10);
			$monhocs->appends(['keyword' => $keyword]);
		}
		else
		{
			$monhocs = Monhoc::orderBy('created_at', 'desc')->paginate(10);
		}

		return view('backend::monhoc.list_teacher1', ['monhocs' => $monhocs]);
	}
	/**
	* Danh sách môn học Admin
	*/
	public function index_admin()
	{
		$keyword = Request::get('keyword', '');
		if($keyword)
		{
			$monhocs = Monhoc::where('ten_mon_hoc', 'like', "%$keyword%")
				->orderBy('created_at', 'desc')->paginate(10);
			$monhocs->appends(['keyword' => $keyword]);
		}
		else
		{
			$monhocs = Monhoc::orderBy('created_at', 'desc')->paginate(10);
		}

		return view('backend::monhoc.list', ['monhocs' => $monhocs]);
	}
	/**
	* Tạo mới môn học
	*/
	public function new_mon_hoc(MonhocRequest $request)
	{
		$monhoc = new Monhoc;
		$monhoc->ten_mon_hoc = $request->ten_mon_hoc;
		$monhoc->save();
		return redirect()->route('backend.mon-hoc.admin')->withSuccess('Thêm mới môn học thành công!');
	}
	/**
	* Chỉnh sửa môn học phương thức get
	*/
	public function edit_mon_hoc($id)
	{
		$keyword = Request::get('keyword', '');
		if($keyword)
		{
			$monhocs = Monhoc::where('ten_mon_hoc', 'like', "%$keyword%")
				->orderBy('created_at', 'desc')->paginate(10);
			$monhocs->appends(['keyword' => $keyword]);
		}
		else
		{
			$monhocs = Monhoc::orderBy('created_at', 'desc')->paginate(10);
		}
		$monhoc = Monhoc::find($id);
		if($monhoc)
		{
			return view('backend::monhoc.edit', ['monhoc' => $monhoc, 'monhocs' => $monhocs]);
		}
		return redirect()->route('backend.mon-hoc.admin');
	}
	/**
	* Chỉnh sửa môn học phương thức post
	*/
	public function save_edit_mon_hoc($id)
	{
		$monhoc = Monhoc::find($id);
		$monhoc->ten_mon_hoc = Request::input('ten_mon_hoc');
		$monhoc->save();
		return redirect()->route('backend.mon-hoc.admin', ['page'=>Request::get('page', 1)])
			->withSuccess("Chỉnh sửa môn học thành công !");
	}

	/**
	* Xóa môn học
	**/
	public function delete_mon_hoc(Request1 $request)
	{
		$monhoc = Monhoc::find($request->get('id', 0));
		// Khi môn học có bài thi
		if(count($monhoc->baithis) > 0){
			foreach($monhoc->baithis as $baithi)
			{
				$time = Carbon::createFromTimeStamp(strtotime($baithi['ngay_thi'])) < Carbon::now();
				// Nếu bài thi đã quá hạn thì không được xóa môn học
				if($time == true)
				{
					return redirect(Route('backend.mon-hoc.admin', ['page'=>$request->get('page', 1)]))
	        			->withErrors("Không thể xóa môn học " . $monhoc->ten_mon_hoc . " !");
				}
				else{
					if($monhoc){
			            $monhoc->delete();
			        }
			        return redirect(Route('backend.mon-hoc.admin', ['page'=>$request->get('page', 1)]))
			        	->withSuccess("Xóa môn học " . $monhoc->ten_mon_hoc . " thành công !");
				}
			}
        }
        else{
        	if($monhoc){
	            $monhoc->delete();
	        }
	        return redirect(Route('backend.mon-hoc.admin', ['page'=>$request->get('page', 1)]))
	        	->withSuccess("Xóa môn học " . $monhoc->ten_mon_hoc . " thành công !");
        }
	}
	/**
	* Chọn bài thi hoặc câu hỏi tương ứng với môn học
	**/
	public function choose($id)
	{
		$monhoc = Monhoc::find($id);
		return view('backend::monhoc.choose', ['monhoc'=> $monhoc]);
	}
	/**
	* Danh sách câu hỏi của môn học
	**/
	public function list_cau_hoi($mon_hoc_id)
	{
		$monhoc = Monhoc::find($mon_hoc_id);
		if(count($monhoc->cauhois) > 0)
		{
			$keyword = Request::get('keyword', '');
			if($keyword)
			{
				$cauhois = Cauhoi::where('mon_hoc_id', $mon_hoc_id)
					->where('noi_dung_cau_hoi', 'like', "%$keyword%")
					->where('user_id', Auth::user()->id)
					->orderBy('created_at', 'desc')->paginate(10);
				$cauhois->appends(['keyword' => $keyword]);
			}
			else{
				$cauhois = Cauhoi::where('mon_hoc_id', $mon_hoc_id)
					->where('user_id', Auth::user()->id)->paginate(10);
			}
			return view('backend::monhoc.list_cau_hoi', ['cauhois' => $cauhois, 'monhoc' => $monhoc]);
		}
		return view('backend::monhoc.list_cau_hoi', ['monhoc' => $monhoc]);
	}
	/**
	* Tạo mới câu hỏi của môn học
	**/
	public function new_cau_hoi($mon_hoc_id, CauhoiRequest $request)
	{
		$cauhoi = new Cauhoi;

		$cauhoi->mon_hoc_id = $mon_hoc_id;
		$cauhoi->user_id = Auth::user()->id;
		$cauhoi->noi_dung_cau_hoi = Request::input('noi_dung_cau_hoi');
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

		return redirect()->route('backend.mon-hoc.list-cau-hoi', [$mon_hoc_id, 'page'=>Request::get('page',1)])
			->withSuccess('Tạo mới thành công câu hỏi');
	}
	/**
	* Chỉnh sửa câu hỏi của môn học phương thức get
	**/
	public function edit_cau_hoi($mon_hoc_id, $cau_hoi_id)
	{
		$monhoc = Monhoc::find($mon_hoc_id);
		$cauhoi = Cauhoi::find($cau_hoi_id);
		if(!$cauhoi || Auth::user()->id != $cauhoi['user_id'])
		{
			return redirect()
				->route('backend.mon-hoc.list-cau-hoi', [$mon_hoc_id, 'page'=>Request::get('page',1)])
				->withErrors('Không tồn tại câu hỏi này !');
		}
		else{
			if(count($cauhoi->dapans) > 0){
				foreach($cauhoi->dapans as $da)
				{
					$dapans[] = $da;
				}
				if(count($cauhoi->baithis) > 0)
				{
					foreach($cauhoi->baithis as $baithi)
					{
						$time = Carbon::createFromTimeStamp(strtotime($baithi['ngay_thi'])) < Carbon::now();
						// Nếu bài thi đã quá hạn thi thì không được sửa câu hỏi
						if($time == true)
						{
							return view('backend::monhoc.edit_cau_hoi', 
								['monhoc' => $monhoc,'cauhoi' => $cauhoi, 'dapans' => $dapans])
								->withErrors('Không thể chỉnh sửa câu hỏi vì bài thi "' . $baithi['ten_bai_thi'] . '" quá hạn.');
						}
						else
						{
							return view('backend::monhoc.edit_cau_hoi', ['monhoc' => $monhoc,'cauhoi' => $cauhoi, 'dapans' => $dapans]);
						}
					}
				}
				return view('backend::monhoc.edit_cau_hoi', ['monhoc' => $monhoc,'cauhoi' => $cauhoi, 'dapans' => $dapans]);
			}
			else{
				if(count($cauhoi->baithis) > 0)
				{
					foreach($cauhoi->baithis as $baithi)
					{
						$time = Carbon::createFromTimeStamp(strtotime($baithi['ngay_thi'])) < Carbon::now();
						// Nếu bài thi đã quá hạn thi thì không được sửa câu hỏi
						if($time == true)
						{
							return view('backend::monhoc.edit_cau_hoi', 
								['monhoc' => $monhoc,'cauhoi' => $cauhoi])
								->withErrors('Không thể chỉnh sửa câu hỏi vì bài thi "' . $baithi['ten_bai_thi'] . '" quá hạn.');
						}
						else
						{
							return view('backend::monhoc.edit_cau_hoi', ['monhoc' => $monhoc,'cauhoi' => $cauhoi, 'dapans' => $dapans]);
						}
					}
				}
				return view('backend::monhoc.edit_cau_hoi', ['monhoc' => $monhoc,'cauhoi' => $cauhoi]);
			}
		}
	}
	/**
	* Chỉnh sửa câu hỏi của môn học phương thức post
	**/
	public function save_edit_cau_hoi($mon_hoc_id, $cau_hoi_id, CauhoiRequest $request)
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
						->route('backend.mon-hoc.edit-cau-hoi', [$mon_hoc_id, $cau_hoi_id, 'page'=>Request::get('page',1)])
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
					return redirect()->route('backend.mon-hoc.list-cau-hoi', [$mon_hoc_id, 'page'=>Request::get('page',1)])
						->withSuccess('Chỉnh sửa thành công câu hỏi');
				}
			}
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
			return redirect()->route('backend.mon-hoc.list-cau-hoi', [$mon_hoc_id, 'page'=>Request::get('page',1)])
				->withSuccess('Chỉnh sửa thành công câu hỏi');
		}
	}
	/**
	* Xóa câu hỏi của môn học phương thức post
	**/
	public function delete_cau_hoi($mon_hoc_id, Request1 $request)
	{
		$mon_hoc_id = $request->mon_hoc_id;
		$cauhoi = Cauhoi::find($request->get('cau_hoi_id', 0));
		if(!$cauhoi || Auth::user()->id != $cauhoi['user_id'])
		{
			return redirect()
				->route('backend.mon-hoc.list-cau-hoi', [$mon_hoc_id, 'page'=>Request::get('page',1)])
				->withErrors('Không tồn tại câu hỏi này !');
		}
		else
		{
			// Khi câu hỏi thuộc bài thi nào đó
			if(count($cauhoi->baithis) > 0)
			{
				$baithi = $cauhoi->baithis;

				foreach($baithi as $bt)
				{
					// Bài thi đã quá hạn thi thì không được xóa câu hỏi
					$time = Carbon::createFromTimeStamp(strtotime($bt['ngay_thi'])) < Carbon::now();
					if($time == true)
					{
						return redirect()
							->route('backend.mon-hoc.list-cau-hoi',
								[$mon_hoc_id, 'page'=>Request::get('page',1)])
							->withErrors('Không thể xóa câu hỏi này vì bài thi đã quá hạn.');
					}
					else
					{
						$bt->khoa = 0;
						$bt->save();
						$cauhoi->delete();
						return redirect()
							->route('backend.mon-hoc.list-cau-hoi',
								[$mon_hoc_id, 'page'=>Request::get('page',1)])
							->withSuccess('Xóa câu hỏi thành công');
					}
				}
			}
			else
			{
				$cauhoi->delete();
				return redirect()
					->route('backend.mon-hoc.list-cau-hoi',
						[$mon_hoc_id, 'page'=>Request::get('page',1)])
					->withSuccess('Xóa câu hỏi thành công');
			}
		}
	}
	/**
	* Danh sách bài thi của môn học
	**/
	public function list_bai_thi($mon_hoc_id)
	{
		$monhoc = Monhoc::find($mon_hoc_id);
		if(count($monhoc->baithis) > 0)
		{
			$keyword = Request::get('keyword', '');
			if($keyword)
			{
				$baithis = Baithi::where('mon_hoc_id', $mon_hoc_id)
					->where('ten_bai_thi', 'like', "%$keyword%")
					->where('user_id', Auth::user()->id)
					->orderBy('created_at', 'desc')->paginate(10);
				$baithis->appends(['keyword' => $keyword]);
			}
			else{
				foreach($monhoc->baithis as $mh)
				{
					$baithis = Baithi::where('mon_hoc_id', $mon_hoc_id)
						->where('user_id', Auth::user()->id)->paginate(10);
				}
			}
			return view('backend::monhoc.list_bai_thi', ['baithis' => $baithis, 'monhoc' => $monhoc]);
		}
		return view('backend::monhoc.list_bai_thi', ['monhoc' => $monhoc]);
	}
	/**
	* Tạo mới bài thi
	**/
	public function new_bai_thi($mon_hoc_id, BaithiRequest $request)
	{
		$baithi = new Baithi;

		$baithi->mon_hoc_id = $mon_hoc_id;
		$baithi->user_id = Auth::user()->id;
		$baithi->ten_bai_thi = $request->ten_bai_thi;
		$baithi->thoi_gian = $request->thoi_gian;
		$baithi->so_cau_hoi = $request->so_cau_hoi;
		// Nếu thời gian nhập nhỏ hơn thời gian hiện tại thì không tạo mới được bài thi
		if(Carbon::createFromTimeStamp(strtotime($request->ngay_thi)) < Carbon::now())
		{
			return redirect()->route('backend.mon-hoc.list-bai-thi', [$mon_hoc_id, 'page'=>Request::get('page',1)])
				->withErrors('Phải nhập thời gian lớn hơn thời gian hiện tại !');
		}
		else
		{
			$baithi->ngay_thi = $request->ngay_thi;
			$baithi->save();
			return redirect()->route('backend.mon-hoc.list-bai-thi', [$mon_hoc_id, 'page'=>Request::get('page',1)])
				->withSuccess('Thêm mới bài thi thành công !');
		}
	}
	/**
	* Chỉnh sửa bài thi
	**/
	public function edit_bai_thi($mon_hoc_id, $bai_thi_id)
	{
		$monhoc = Monhoc::find($mon_hoc_id);
		$baithi = Baithi::find($bai_thi_id);
		// Không được sửa bài thi của người khác
		if($baithi && (Auth::user()->id == $baithi['user_id']))
		{
			// Khi bài thi quá hạn thì không được sửa
			if(Carbon::createFromTimeStamp(strtotime($baithi['ngay_thi'])) < Carbon::now())
			{
				return redirect()->route('backend.mon-hoc.list-bai-thi', [$mon_hoc_id])
					->withErrors('Bạn không thể chỉnh sửa vì đã quá hạn thời gian thi !');
			}
			else
			{
				return view('backend::monhoc.edit_bai_thi', ['monhoc' => $monhoc, 'baithi' => $baithi]);
			}
		}
		else{
			return redirect()
				->route('backend.mon-hoc.list-bai-thi', [$mon_hoc_id, 'page'=>Request::get('page',1)])
				->withErrors('Không có bài thi này !');
		}
	}

	/**
	* Save chỉnh sửa bài thi
	**/
	public function save_edit_bai_thi($mon_hoc_id, $bai_thi_id, BaithiRequest $request)
	{
		$baithi = Baithi::find($bai_thi_id);

		$baithi->ten_bai_thi = $request->ten_bai_thi;
		$baithi->thoi_gian = $request->thoi_gian;
		// Nếu thời gian nhập nhỏ hơn thời gian hiện tại thì không được sửa
		if(Carbon::createFromTimeStamp(strtotime($request->ngay_thi)) < Carbon::now())
		{
			$baithi->ngay_thi = $baithi->ngay_thi;
			$baithi->save();
			return redirect()->route('backend.mon-hoc.edit-bai-thi', [$mon_hoc_id, $bai_thi_id])
				->withErrors('Bạn cần nhập thời gian lớn hơn so với thời gian hiện tại !');
		}
		else{
			$baithi->ngay_thi = $request->ngay_thi;
			// Nếu số câu hỏi của bài thi lớn hơn số câu hỏi nhập vào
			// thi không được sửa
			if(count($baithi->cauhois) > $request->so_cau_hoi)
			{
				$baithi->so_cau_hoi = $baithi->so_cau_hoi;
				$baithi->khoa = 0;
				$baithi->save();
				return redirect()->route('backend.mon-hoc.edit-bai-thi', [$mon_hoc_id, $bai_thi_id])
					->withErrors('Không thể chỉnh sửa nếu số câu hỏi bạn nhập nhỏ hơn số câu hỏi của bài thi.
								  Bài thi này đang có ' . count($baithi->cauhois) . ' câu hỏi !');
			}
			// Khi chọn mở khóa bài thi
			else if($request->khoa == 1)
			{
				// Nếu số câu hỏi của bài thi khác với số câu hỏi nhập vào
				// thì không được phép mở
				if(count($baithi->cauhois) != $request->so_cau_hoi)
				{
					$baithi->so_cau_hoi = $request->so_cau_hoi;
					$baithi->khoa = 0;
					$baithi->save();
					return redirect()->route('backend.mon-hoc.edit-bai-thi', [$mon_hoc_id, $bai_thi_id])
						->withErrors('Không thể mở khóa vì số câu hỏi của bài thi khác so với bạn nhập.
									  Bài thi này đang có ' . count($baithi->cauhois) . ' câu hỏi !');
				}
				else if($request->so_cau_hoi ==0)
				{
				    return redirect()->route('backend.mon-hoc.edit-bai-thi', [$mon_hoc_id, $bai_thi_id])
				    ->withErrors('Không thể mở khóa bài thi vì số câu hỏi bạn nhập bằng 0.');
				}
				else{
					foreach($baithi->cauhois as $cauhoi)
					{
						// Nếu tồn tại 1 câu hỏi chưa có đáp án
						// thì không được mở khóa
						if(count($cauhoi->dapans) == 0)
						{
							$baithi->so_cau_hoi = $request->so_cau_hoi;
							$baithi->khoa = 0;
							$baithi->save();
							return redirect()
								->route('backend.mon-hoc.edit-bai-thi', [$mon_hoc_id, $bai_thi_id])
								->withErrors('Không thể mở khóa vì câu hỏi \"' . $cauhoi["noi_dung_cau_hoi"] . '\" chưa có đáp án !');
						}
						else
						{
							$baithi->so_cau_hoi = $request->so_cau_hoi;
							$baithi->khoa = $request->khoa;
							$baithi->save();
							return redirect()->route('backend.mon-hoc.list-bai-thi', [$mon_hoc_id])
								->withSuccess('Chỉnh sửa bài thi thành công !');
						}
					}
				}
			}
			else
			{
				$baithi->so_cau_hoi = $request->so_cau_hoi;
				$baithi->khoa = $request->khoa;
				$baithi->save();
				return redirect()->route('backend.mon-hoc.list-bai-thi', [$mon_hoc_id])
					->withSuccess('Chỉnh sửa bài thi thành công !');
			}
		}
	}

	/**
	* Xóa bài thi
	**/
	public function delete_bai_thi($mon_hoc_id, Request1 $request)
	{
		$baithi = Baithi::find($request->get('bai_thi_id', 0));
		if($baithi && (Auth::user()->id == $baithi['user_id']))
		{
			// Nếu bài thi đã quá hạn thì không được xóa
			if(Carbon::createFromTimeStamp(strtotime($baithi['ngay_thi'])) < Carbon::now())
			{
				return redirect()->route('backend.mon-hoc.list-bai-thi', [$mon_hoc_id])
					->withErrors('Không thể xóa vì bài thi này đã quá hạn thi !');
			}
			else
			{
				$baithi->delete();
				return redirect()->route('backend.mon-hoc.list-bai-thi', [$mon_hoc_id])
					->withSuccess('Xóa bài thi thành công !');
			}
		}
		else{
			return redirect()
				->route('backend.mon-hoc.list-bai-thi', [$mon_hoc_id])
				->withErrors('Không có bài thi này !');
		}
	}

	/**
	* Chọn câu hỏi cho bài thi
	**/
	public function chon_bai_thi_cau_hoi($mon_hoc_id, $bai_thi_id)
	{
		$monhoc = Monhoc::find($mon_hoc_id);
		$baithi = Baithi::find($bai_thi_id);
		if(Auth::user()->id != $baithi['user_id'])
		{
			return redirect()
				->route('backend.mon-hoc.list-cau-hoi', [$mon_hoc_id, 'page'=>Request::get('page',1)])
				->withErrors('Bạn không có bài thi này !');
		}
		else{
			if(count($monhoc->cauhois) > 0)
			{
				$keyword = Request::get('keyword', '');
				if($keyword)
				{
					$cauhois = Cauhoi::where('mon_hoc_id', $mon_hoc_id)
						->where('noi_dung_cau_hoi', 'like', "%$keyword%")
						->where('user_id', Auth::user()->id)
						->orderBy('created_at', 'desc')->paginate(10);
					$cauhois->appends(['keyword' => $keyword]);
				}
				else{
					$cauhois = Cauhoi::where('mon_hoc_id', $mon_hoc_id)
						->where('user_id', Auth::user()->id)->paginate(10);
				}
				return view('backend::monhoc.chon_bai_thi_cau_hoi',
					[
						'baithi' => $baithi,
						'cauhois' => $cauhois,
						'monhoc' => $monhoc
					]
				);
			}
			return view('backend::monhoc.chon_bai_thi_cau_hoi',
				[
					'baithi' => $baithi,
					'monhoc' => $monhoc
				]
			);
		}
	}
	/**
	* Save Chọn câu hỏi cho bài thi
	**/
	public function save_chon_bai_thi_cau_hoi(Request1 $request, $mon_hoc_id, $bai_thi_id)
	{
		$baithi = Baithi::find($bai_thi_id);
		$baithi_cauhoi = BaithiCauhoi::where('bai_thi_id',$bai_thi_id)->get();
		$time = Carbon::createFromTimeStamp(strtotime($baithi['ngay_thi'])) < Carbon::now();
		// Nếu bài thi đã quá hạn thì không được thay đổi câu hỏi của bài thi
		if($time == true)
		{
			return redirect()->route('backend.mon-hoc.chon-bai-thi-cau-hoi', [$mon_hoc_id, $bai_thi_id])
				->withErrors('Không thể thay đổi câu hỏi của bài thi vì bài thi đã quá hạn.');
		}
		else{
			// Nếu bài thi có số câu hỏi > 0
			if(count($request->cauhoi) > 0)
			{
				$cauhoi = $request->cauhoi;
				// Nếu số câu hỏi của bài thi đã chọn lớn hơn số câu hỏi yêu cầu
				// thì không được thay đổi câu hỏi của bài thi
				if(count($cauhoi) > $baithi['so_cau_hoi'])
				{
					return redirect()->route('backend.mon-hoc.chon-bai-thi-cau-hoi', [$mon_hoc_id, $bai_thi_id])
						->withErrors('Vượt quá số lượng câu hỏi của bài thi');
				}
				else
				{
					// Xóa câu hỏi đã chọn từ trước của bài thi
					// Tạo danh sách câu hỏi mới
					foreach($baithi_cauhoi as $bt)
					{
						$bt->delete();
					}
					foreach($cauhoi as $ch)
					{
						$baithi_cauhoi = new BaithiCauhoi;

						$baithi_cauhoi->bai_thi_id = $bai_thi_id;
						$baithi_cauhoi->cau_hoi_id = $ch;

						$baithi_cauhoi->save();
					}
				}
				return redirect()->route('backend.mon-hoc.chon-bai-thi-cau-hoi', [$mon_hoc_id, $bai_thi_id])
					->withSuccess('Thay đổi câu hỏi của bài thi thành công.');
			}
			else{
				// Nếu bỏ chọn tất cả câu hỏi thì khóa bài thi lại
				foreach($baithi_cauhoi as $bt)
				{
					$bt->delete();
				}
				$baithi->khoa = 0;
				$baithi->save();
				return redirect()->route('backend.mon-hoc.chon-bai-thi-cau-hoi', [$mon_hoc_id, $bai_thi_id])
					->withSuccess('Thay đổi câu hỏi của bài thi thành công.');
			}
		}
	}
}