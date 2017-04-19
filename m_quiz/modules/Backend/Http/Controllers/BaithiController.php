<?php namespace Modules\Backend\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use App\BaiThi;
use App\Cauhoi;
use Request;
use Auth;
use Illuminate\Http\Request as Request1;
use Modules\Backend\Http\Requests\BaithiRequest;
use Carbon\Carbon;
use App\MonHoc;
use App\BaithiCauhoi;

class BaithiController extends Controller {
	
	public function index()
	{
		$monhocs = MonHoc::all();
		$keyword = Request::get('keyword', '');
		if($keyword)
		{
			$baithis = BaiThi::where('ten_bai_thi', 'like', "%$keyword%")
				->where('user_id', Auth::user()->id)
				->orderBy('created_at', 'desc')->paginate(10);
			$baithis->appends(['keyword' => $keyword]);
		}
		else
		{
			$baithis = BaiThi::orderBy('created_at', 'desc')
				->where('user_id', Auth::user()->id)->paginate(10);
		}
		return view('backend::baithi.list', ['baithis' => $baithis, 'monhocs' => $monhocs]);
	}
	
	public function new_bai_thi(BaithiRequest $request)
	{
		if($request->mon_hoc_id == ""){
			return redirect()->route('backend.bai-thi', ['page'=>Request::get('page',1)])
				->withErrors('Bạn phải chọn môn học !');
		}
		else{
			$baithi = new Baithi;

			$baithi->mon_hoc_id = $request->mon_hoc_id;
			$baithi->user_id = Auth::user()->id;
			$baithi->ten_bai_thi = $request->ten_bai_thi;
			$baithi->thoi_gian = $request->thoi_gian;
			$baithi->so_cau_hoi = $request->so_cau_hoi;
			// Nếu thời gian nhập nhỏ hơn thời gian hiện tại thì không tạo mới được bài thi
			if(Carbon::createFromTimeStamp(strtotime($request->ngay_thi)) < Carbon::now())
			{
				return redirect()->route('backend.bai-thi', ['page'=>Request::get('page',1)])
					->withErrors('Phải nhập thời gian lớn hơn thời gian hiện tại !');
			}
			else
			{
				$baithi->ngay_thi = $request->ngay_thi;
				$baithi->save();
				return redirect()->route('backend.bai-thi', ['page'=>Request::get('page',1)])
					->withSuccess('Thêm mới bài thi thành công !');
			}
		}
	}

	public function edit_bai_thi($bai_thi_id)
	{
		$baithi = Baithi::find($bai_thi_id);
		// Không được sửa bài thi của người khác
		if($baithi && (Auth::user()->id == $baithi['user_id']))
		{
			// Khi bài thi quá hạn thì không được sửa
			if(Carbon::createFromTimeStamp(strtotime($baithi['ngay_thi'])) < Carbon::now())
			{
				$mh = $baithi->monhocs;
				$monhocs = MonHoc::all();
				return view('backend::baithi.edit_bai_thi', 
					['baithi' => $baithi, 'mh' => $mh, 'monhocs' => $monhocs])
					->withErrors('Bạn không thể chỉnh sửa vì đã quá hạn thời gian thi !');
			}
			else
			{
				$mh = $baithi->monhocs;
				$monhocs = MonHoc::all();
				return view('backend::baithi.edit_bai_thi', 
					['baithi' => $baithi, 'mh' => $mh, 'monhocs' => $monhocs]);
			}
		}
		else{
			return redirect()
				->route('backend.bai-thi', ['page'=>Request::get('page',1)])
				->withErrors('Không có bài thi này !');
		}
	}

	public function save_edit_bai_thi($bai_thi_id, BaithiRequest $request)
	{
		$baithi = Baithi::find($bai_thi_id);

		$baithi->ten_bai_thi = $request->ten_bai_thi;
		$baithi->thoi_gian = $request->thoi_gian;
		if(count($baithi->cauhois) > 0)
		{
			$baithi->mon_hoc_id = $baithi->mon_hoc_id;
		}
		else
		{
			$baithi->mon_hoc_id = $request->mon_hoc_id;
		}
		// Khi bài thi quá hạn thì không được sửa
		if(Carbon::createFromTimeStamp(strtotime($baithi['ngay_thi'])) < Carbon::now())
		{
			return redirect()
				->route('backend.bai-thi.edit-bai-thi', [$bai_thi_id, 'page'=>Request::get('page',1)])
				->withErrors('Bạn không thể chỉnh sửa vì đã quá hạn thời gian thi !');
		}
		else{
			// Nếu thời gian nhập nhỏ hơn thời gian hiện tại thì không được sửa
			if(Carbon::createFromTimeStamp(strtotime($request->ngay_thi)) < Carbon::now())
			{
				$baithi->ngay_thi = $baithi->ngay_thi;
				$baithi->save();
				return redirect()
					->route('backend.bai-thi.edit-bai-thi', [$bai_thi_id, 'page'=>Request::get('page',1)])
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
					return redirect()
						->route('backend.bai-thi.edit-bai-thi', [$bai_thi_id, 'page'=>Request::get('page',1)])
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
						return redirect()
							->route('backend.bai-thi.edit-bai-thi', [$bai_thi_id, 'page'=>Request::get('page',1)])
							->withErrors('Không thể mở khóa vì số câu hỏi của bài thi khác so với bạn nhập.
										  Bài thi này đang có ' . count($baithi->cauhois) . ' câu hỏi !');
					}
					else if($request->so_cau_hoi ==0)
					{
					    return redirect()
					    	->route('backend.bai-thi.edit-bai-thi', [$bai_thi_id, 'page'=>Request::get('page',1)])
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
									->route('backend.bai-thi.edit-bai-thi', [$bai_thi_id, 'page'=>Request::get('page',1)])
									->withErrors('Không thể mở khóa vì câu hỏi \"' . $cauhoi["noi_dung_cau_hoi"] . '\" chưa có đáp án !');
							}
							else
							{
								$baithi->so_cau_hoi = $request->so_cau_hoi;
								$baithi->khoa = $request->khoa;
								$baithi->save();
								return redirect()
									->route('backend.bai-thi', ['page'=>Request::get('page',1)])
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
					return redirect()->route('backend.bai-thi', ['page'=>Request::get('page',1)])
						->withSuccess('Chỉnh sửa bài thi thành công !');
				}
			}
		}
	}

	public function delete_bai_thi(Request1 $request)
	{
		$baithi = Baithi::find($request->get('bai_thi_id', 0));
		if($baithi && (Auth::user()->id == $baithi['user_id']))
		{
			// Nếu bài thi đã quá hạn thì không được xóa
			if(Carbon::createFromTimeStamp(strtotime($baithi['ngay_thi'])) < Carbon::now())
			{
				return redirect()->route('backend.bai-thi')
					->withErrors('Không thể xóa vì bài thi này đã quá hạn thi !');
			}
			else
			{
				$baithi->delete();
				return redirect()->route('backend.bai-thi')
					->withSuccess('Xóa bài thi thành công !');
			}
		}
		else{
			return redirect()
				->route('backend.bai-thi')
				->withErrors('Không có bài thi này !');
		}
	}

	public function chon_cau_hoi($bai_thi_id)
	{
		$baithi = Baithi::find($bai_thi_id);
		$monhoc = Monhoc::find($baithi['mon_hoc_id']);
		if(Auth::user()->id != $baithi['user_id'])
		{
			return redirect()
				->route('backend.bai-thi', ['page'=>Request::get('page',1)])
				->withErrors('Bạn không có bài thi này !');
		}
		else{
			$keyword = Request::get('keyword', '');
			if($keyword)
			{
				$cauhois = Cauhoi::where('mon_hoc_id', $monhoc['id'])
					->where('noi_dung_cau_hoi', 'like', "%$keyword%")
					->where('user_id', Auth::user()->id)
					->orderBy('created_at', 'desc')->paginate(10);
				$cauhois->appends(['keyword' => $keyword]);
			}
			else{
				$cauhois = Cauhoi::where('mon_hoc_id', $monhoc['id'])
					->where('user_id', Auth::user()->id)->paginate(10);
			}
			return view('backend::baithi.chon_cau_hoi',
				[
					'baithi' => $baithi,
					'cauhois' => $cauhois
				]
			);
		}
	}

	public function save_chon_cau_hoi($bai_thi_id, Request1 $request)
	{
		$baithi = Baithi::find($bai_thi_id);
		$baithi_cauhoi = BaithiCauhoi::where('bai_thi_id',$bai_thi_id)->get();
		$time = Carbon::createFromTimeStamp(strtotime($baithi['ngay_thi'])) < Carbon::now();
		// Nếu bài thi đã quá hạn thì không được thay đổi câu hỏi của bài thi
		if($time == true)
		{
			return redirect()
				->route('backend.bai-thi.chon-cau-hoi', [$bai_thi_id, 'page'=>Request::get('page',1)])
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
					return redirect()
						->route('backend.bai-thi.chon-cau-hoi', [$bai_thi_id, 'page'=>Request::get('page',1)])
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
				return redirect()
					->route('backend.bai-thi.chon-cau-hoi', [$bai_thi_id, 'page'=>Request::get('page',1)])
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
				return redirect()
					->route('backend.bai-thi.chon-cau-hoi', [$bai_thi_id, 'page'=>Request::get('page',1)])
					->withSuccess('Thay đổi câu hỏi của bài thi thành công.');
			}
		}
	}
}