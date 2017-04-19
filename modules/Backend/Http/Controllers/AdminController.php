<?php namespace Modules\Backend\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use App\HocVienBaiThi;
use App\BaiThi;
use App\MonHoc;
use Auth;
use Request;
use App\DapAn;
use Excel;
use App\BaiThiCauHoi;
use DB;
use Carbon\Carbon;

class AdminController extends Controller {
	
	public function index()
	{
		return view('backend::index');
	}

	public function bangdiem_baithi($mon_hoc_id)
	{
		$monhoc = MonHoc::find($mon_hoc_id);
		$keyword = Request::get('keyword', '');
		if($keyword)
		{
			$baithis = BaiThi::where('ten_bai_thi', 'like', "%$keyword%")
				->where('mon_hoc_id', $mon_hoc_id)->paginate(10);
			$baithis->appends(['keyword' => $keyword]);
		}
		else{
			$baithis = BaiThi::where('mon_hoc_id', $mon_hoc_id)->get();
		}
		return view('backend::admin.baithi_bangdiem', 
			['baithis'=>$baithis, 'monhoc'=>$monhoc, 'page'=>Request::get('page',1)]);
	}

	public function bangdiem_user($bai_thi_id)
	{
		$baithi = BaiThi::find($bai_thi_id);
		$hocvien_baithi = HocVienBaiThi::where('bai_thi_id', $bai_thi_id)->get();
		return view('backend::admin.user_bangdiem',
			['hocvien_baithi' => $hocvien_baithi, 'baithi'=>$baithi, 'page'=>Request::get('page',1)]);
	}

	public function bangdiem_excel($bai_thi_id)
	{
		$baithi = BaiThi::find($bai_thi_id);
		$hocvien_baithi = HocVienBaiThi::where('bai_thi_id', $bai_thi_id)
			->orderBy('created_at', 'asc')->get();
		return Excel::create('Bảng điểm ' . date('Y-m-d'), function($excel) use ($hocvien_baithi, $baithi){
		    $excel->sheet('Sheetname', function($sheet) use ($hocvien_baithi, $baithi){
				$sheet->prependRow(1, array(
				    'Bảng điểm - ' . $baithi->monhocs->ten_mon_hoc . ' - ' . $baithi['ten_bai_thi']
				));
				$sheet->prependRow(2, array(
				    'STT', 'Họ Tên', 'Điểm'
				));
				$stt = 1;
		        foreach($hocvien_baithi as $hv_bt)
		        {
		        	$sheet->prependRow(3, array(
				    	$stt, $hv_bt->users->name, $hv_bt['so_cau_dung'] . '/' . $baithi['so_cau_hoi']
					));
					$stt = $stt + 1;
		        }
		    });
		})->export('xls');
	}

	public function bangdiem_chitiet($bai_thi_id, $hocvien_baithi_id)
	{
		$baithi = BaiThi::find($bai_thi_id);
		$dap_an = DapAn::all();
		$bai_thi_cau_hoi = BaiThiCauHoi::where('bai_thi_id', $bai_thi_id)->get();
		$hocvien_baithi = HocVienBaiThi::find($hocvien_baithi_id);
		$ket_qua = unserialize($hocvien_baithi['ket_qua']);
		$array_dap_an = $array_dung_sai = [];
		$chi_so = 0;
        foreach ($bai_thi_cau_hoi as $bt){
            foreach ($dap_an as $da){
                if ($bt->cau_hoi_id == $da->cau_hoi_id){
                    $array_dap_an[$chi_so][] = "$da->dung_sai";
                }
            }
            $array_dung_sai[] = "0";
            $chi_so++;
        }
        $so_cau_dung = 0;
        foreach ($array_dap_an as $k1 => $array){
            $kiem_tra = 1;
            foreach ($array as $k2 => $val){
                if ($ket_qua[$k1][$k2] != $val){
                    $kiem_tra = 0;
                }
            }
            if ($kiem_tra == 1){
                $so_cau_dung++;
                $array_dung_sai[$k1] = "1";
            }
        }
		return view('backend::admin.bangdiem_chitiet', 
			[
				'hocvien_baithi'=>$hocvien_baithi, 
				'ket_qua'=>$ket_qua, 
				'dung_sai' => $array_dung_sai,
				'baithi' => $baithi
			]);
	}
	
}