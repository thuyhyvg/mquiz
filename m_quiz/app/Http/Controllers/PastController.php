<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\BaiThi;
use App\HocVienBaiThi;
use App\MonHoc;
use App\BaiThiCauHoi;
use App\DapAn;
use Auth;

class PastController extends Controller
{




    /**
     * Hàm liệt kê danh sách bài thi đã thi
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(){
        $user_id = Auth::user()->id;
        $bai_thi_da_thi = HocVienBaiThi::where('user_id', $user_id)->get();

        $bai_thi = BaiThi::all();
        $mon_hoc = MonHoc::all();
        return view('quiz.past', [
                'bai_thi' => $bai_thi,
                'bai_thi_da_thi' => $bai_thi_da_thi,
                'mon_hoc' => $mon_hoc,
        ]);
    }



    public function detail(Request $request, $id){
        $dap_an = DapAn::all();
        $user_id = Auth::user()->id;;



        /**
         * Lấy chi tiết bài thi
         */
        $bai_thi = BaiThi::find($id);



        /*
         * Biến kiểm tra thi lại
         */
        $thi_lai = 0;



        /**
         * Lấy chi tiết kết quả của thí sinh
         * @var unknown
         */
        $bai_thi_da_thi = HocVienBaiThi::where('user_id', $user_id)->where('bai_thi_id', $id)->first();



        /**
         * Lấy mảng các câu hỏi trong bài thi
         * @var unknown
         */
        $bai_thi_cau_hoi = BaiThiCauHoi::where('bai_thi_id', $id)->get();



        /**
         * Mảng đáp án, mảng trả lời, và mảng đúng sai
         * @var unknown
         */
        $array_dap_an = $array_tra_loi = $array_dung_sai = [];




        /**
         * Mảng trả lời của thí sinh
         */
        $array_tra_loi = unserialize($bai_thi_da_thi->ket_qua);



        /**
         * Khởi tạo mảng đáp án và mảng đúng sai
         * @var unknown
         */
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



        /**
         * So sánh 2 mảng đáp án và mảng trả lời
         * @var unknown
         */
        $so_cau_dung = 0;
        foreach ($array_dap_an as $k1 => $array){
            $kiem_tra = 1;
            foreach ($array as $k2 => $val){
                if ($array_tra_loi[$k1][$k2] != $val){
                    $kiem_tra = 0;
                }
            }
            if ($kiem_tra == 1){
                $so_cau_dung++;
                $array_dung_sai[$k1] = "1";
            }
        }



        /**
         * Trả về trang kết thúc
         */
        return view('quiz.finish', [
                'id' => $id,
                'thi_lai' => $thi_lai,
                'tra_loi' => $array_tra_loi,
                'dap_an' => $array_dap_an,
                'dung_sai' => $array_dung_sai,
                'so_cau_dung' => $so_cau_dung

        ]);
    }



}
