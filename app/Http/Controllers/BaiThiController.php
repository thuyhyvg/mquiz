<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\BaiThi;
use App\BaiThiCauHoi;
use App\CauHoi;
use App\DapAn;
use App\HocVienBaiThi;
use App\MonHoc;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Auth;

class BaiThiController extends Controller
{




    /**
     * Hàm liệt kê danh sách bài thi
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(){
        $mon_hoc = MonHoc::all();



        /**
         * List cac bai thi da mo khoa
         * @var unknown
         */
        $bai_thi_mo_khoa = BaiThi::where('khoa',1)->get();



        return view('quiz.baithi', [
                'baithi' => $bai_thi_mo_khoa,
                'mon_hoc' => $mon_hoc,
        ]);
    }







    /**
     * Hàm làm bài thi
     * @param unknown $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function quiz($id){
        $cau_hoi = CauHoi::all()->pluck('noi_dung_cau_hoi', 'id');
        $dap_an = DapAn::all();
        $bai_thi = BaiThi::find($id);
        $user_id = Auth::user()->id;



        /**
         * Kiểm tra thí sinh đã thi 1 lần nào chưa
         * @var unknown
         */
        $bai_thi_ket_thuc = HocVienBaiThi::where('user_id', $user_id)
        ->where('bai_thi_id', $id)->get();



        /**
         * Lấy mảng các câu hỏi trong bài thi
         * @var unknown
         */
        $bai_thi_cau_hoi = BaiThiCauHoi::where('bai_thi_id', $id)->get();



        /**
         * Ngày thi
         * @var unknown
         */
        $ngay_thi = $bai_thi->ngay_thi;



        /**
         * Thời gian làm bài thi
         * @var unknown
         */
        $thoi_gian = ($bai_thi->thoi_gian)*60;



        /**
         * Thời gian bắt đầu thi
         * @var unknown
         */
        $date_begin = strtotime("$ngay_thi");



        /**
         * Thời gian kết thúc bài thi
         * @var unknown
         */
        $date_finish = $date_begin + $thoi_gian;



        /**
         * Thời gian còn lại của thí sinh
         * @var unknown
         */
        $remaining = $date_finish - time();
        $before_time = time() - $date_begin;



        /**
         * Kiểm tra nếu chưa đến giờ thi thì không được vào
         */
        if ($remaining < 0 || $before_time < 0 || !empty($bai_thi_ket_thuc['0'])){
            return redirect()->route('bai_thi.list');
        }



        /**
         * Trả về trang thi
         */
        return view('quiz.quiz', [
                'bai_thi' => $bai_thi_cau_hoi,
                'cau_hoi' => $cau_hoi,
                'dap_an' => $dap_an,
                'thoi_gian' => $remaining,
                'id' => $id,
        ]);
    }







    /**
     * Hàm kết thúc bài thi
     * @param Request $request
     * @param unknown $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function finish(Request $request, $id){
        $dap_an = DapAn::all();
        $bai_thi = BaiThi::find($id);



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
         * Mảng chứa input request từ người dùng
         * @var unknown
         */
        $arr_request = $request->all();
        unset($arr_request['_token']);



        /**
         * Khởi tạo mảng đáp án và mảng trả lời với số phần tử bằng nhau
         * @var unknown
         */
        $chi_so = 0;
        foreach ($bai_thi_cau_hoi as $bt){
            foreach ($dap_an as $da){
                if ($bt->cau_hoi_id == $da->cau_hoi_id){
                    $array_dap_an[$chi_so][] = "$da->dung_sai";
                    $array_tra_loi[$chi_so][] = "0";
                }
            }
            $array_dung_sai[] = "0";
            $chi_so++;
        }



        /**
         * Gán mảng input vào mảng trả lời
         */
        foreach ($arr_request as $k1 => $array){
            foreach ($array as $k2 => $val){
                $array_tra_loi[$k1][$val] = "1";
            }
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
         * Lưu dữ liệu lần thi vào database
         * @var unknown
         */
        $hvbt = new HocVienBaiThi();
        $hvbt->user_id = Auth::user()->id;
        $hvbt->bai_thi_id = $id;
        $hvbt->mon_hoc_id = $bai_thi->mon_hoc_id;
        $hvbt->ket_qua = serialize($array_tra_loi);
        $hvbt->so_cau_dung = $so_cau_dung;
        $hvbt->save();



        /**
         * Trả về trang kết thúc
         */
        return view('quiz.finish', [
                'tra_loi' => $array_tra_loi,
                'dung_sai' => $array_dung_sai,
                'dap_an' => $array_dap_an,
                'so_cau_dung' => $so_cau_dung

        ]);
    }





    /**
     * Hàm thống kê điểm
     */
    public function statistic(){


        $user = Auth::user()->name;
        $id = Auth::user()->id;



        $cau_dung = HocVienBaiThi::where('user_id', $id)->pluck('so_cau_dung', 'bai_thi_id');
        $cau_hoi = BaiThi::all()->pluck('so_cau_hoi', 'id');
        $ten_bai_thi = BaiThi::all()->pluck('ten_bai_thi', 'id');



        /**
         * Chuyển object thành array
         * @var unknown
         */
        $array_cau_dung = (array)$cau_dung;
        shuffle($array_cau_dung);
        $array_cau_hoi = (array)$cau_hoi;
        shuffle($array_cau_hoi);



        /**
         * Kiểm tra nếu chưa có bài thi nào
         */
        $check = 1;
        if(empty($array_cau_dung['0'])){
            $check = 0;
        }




        /**
         * Tổng số câu đúng của thí sinh
         */
        $tong_so_cau_dung = array_sum($array_cau_dung['0']);



        /**
         * Tổng số câu hỏi của thí sinh
         */
        $tong_so_cau_hoi = 0;
        foreach ($array_cau_hoi['0'] as $k1 => $val1){
            foreach ($array_cau_dung['0'] as $k2 => $val2){
                if ($k1 == $k2){
                    $tong_so_cau_hoi += $val1;
                }
            }
        }





        /**
         * Trả về trang kết thúc
         */
        return view('quiz.statistic', [
                'cau_dung' => $array_cau_dung['0'],
                'cau_hoi' => $array_cau_hoi['0'],
                'tong_cau_dung' => $tong_so_cau_dung,
                'tong_cau_hoi' => $tong_so_cau_hoi,
                'ten_bai_thi' => $ten_bai_thi,
                'user' => $user,
                'kt' => $check,

        ]);
    }



}
