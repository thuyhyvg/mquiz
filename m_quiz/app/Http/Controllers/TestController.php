<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BaiThi;
use App\BaiThiCauHoi;
use App\CauHoi;
use App\DapAn;
use App\HocVienBaiThi;
use App\MonHoc;
use App\Http\Requests;
use App\ThiThu;
use Auth;

class TestController extends Controller
{





    /**
     * Hàm chọn môn học khi thi thử
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(){
        /**
         * Lấy các môn học từ database
         * @var unknown
         */
        $mon_hoc = MonHoc::all();



        /**
         * Id của học viên
         */
        $user_id = Auth::user()->id;



        /**
         * Kiểm tra nếu hết số lần thi thử thì không được thi nữa
         * @var unknown
         */
        $thi_thu = ThiThu::where('user_id', $user_id)->get();
        if(!empty($thi_thu['0'])){
            if ($thi_thu['0']->so_lan_thi_thu == '0') return view('quiz.testMonHoc', ['check' => 0]);
        }



        /**
         * Trả về trang chọn môn học
         */
        return view('quiz.testMonHoc', [
                'check' => 1,
                'monhoc' => $mon_hoc

        ]);
    }







    public function randomQuestion($so_cau_hoi, $id){



        /**
         * Chọn key => value là id => noi_dung_cau_hoi
         * @var unknown
         */
        $cau_hoi = CauHoi::where('mon_hoc_id', $id)->pluck('noi_dung_cau_hoi', 'id');



        /**
         * Convert object $cau_hoi to array $array_cau_hoi
         */
        $array_cau_hoi = (array)$cau_hoi;
        shuffle($array_cau_hoi);



        /**
         * Mảng chứa key, value và mảng random
         */
        $key_arr = $value_arr = $random_arr = [];




        /**
         * Kiểm tra có câu hỏi không
         */
        if(!empty($array_cau_hoi['0'])){



            /**
             * Gán key vào $key_arr
             */
            $key_arr = array_rand($array_cau_hoi['0'], $so_cau_hoi);



            /**
             * Gán value vào $value_arr
             */
            for ($i = 0; $i < $so_cau_hoi; $i++){
                foreach ($array_cau_hoi as $arr){
                    $value_arr [] = $array_cau_hoi['0'][$key_arr[$i]];
                }
            }



            /**
             * Gán $key_arr và $value_arr vào $random_arr
             * @var unknown
             */
            $random_arr = array_combine($key_arr, $value_arr);

        }
        /**
         * Nếu không có câu hỏi
         */
        else {
            $random_arr = 0;
        }


        /**
         * Trả về $random_arr
         */
        return $random_arr;
    }







    /**
     * Hàm làm bài thi thử
     * @param unknown $id
     */
    public function test($id){
        $dap_an = DapAn::all();




        /**
         * Số câu hỏi random
         */
        $so_cau_hoi = 3;



        /**
         * Mảng câu hỏi random
         * @var unknown
         */
        $random_arr = $this->randomQuestion($so_cau_hoi, $id);



        /**
         * Kiểm tra nếu có câu hỏi
         */
        $check = 1;
        if($random_arr != 0){
            $this->_random_test = $random_arr;
            session(['key' => $random_arr]);
        }
        /**
         * Nếu không có câu hỏi
         */
        else {
            $check = 0;

            /**
             * Trả về trang thi thử
             */
            return view('quiz.test', [
                    'kt' => $check,
                    'cau_hoi' => $random_arr,
                    'dap_an' => $dap_an,
                    'id' => $id
            ]);
        }




        /**
         * Trả về trang thi thử
         */
        return view('quiz.test', [
                'kt' => $check,
                'cau_hoi' => $random_arr,
                'dap_an' => $dap_an,
                'id' => $id
        ]);
    }








    /**
     * Hàm kết thúc thi thử
     * @param Request $request
     * @param unknown $id
     */
    public function finishTest(Request $request, $id){
        $dap_an = DapAn::all();



        /**
         * Id của học viên
         */
        $user_id = Auth::user()->id;



        /**
         * Mảng chứa input request từ người dùng
         * @var unknown
         */
        $arr_request = $request->all();
        unset($arr_request['_token']);



        /**
         * Số câu hỏi random
         */
        $so_cau_hoi = 3;



        /**
         * Mảng các câu hỏi trong bài thi
         * @var unknown
         */
        $bai_thi_cau_hoi = $request->session()->get('key');



        /**
         * Mảng đáp án, mảng trả lời, và mảng đúng sai
         * @var unknown
         */
        $array_dap_an = $array_tra_loi = $array_dung_sai = [];



        /**
         * Khởi tạo mảng đáp án và mảng trả lời với số phần tử bằng nhau
         * @var unknown
         */
        $chi_so = 0;
        foreach ($bai_thi_cau_hoi as $key => $value){
            foreach ($dap_an as $da){
                if ($da->cau_hoi_id == $key){
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
         * Kiểm tra xem thí sinh đã từng thi thử hay chưa
         * @var unknown
         */
        $lan_thi_thu = ThiThu::where('user_id', $user_id)->get();


        /**
         * Nếu chưa thi thử lần nào thì lưu vào database
         */
        if (empty($lan_thi_thu['0'])){
            $thi_thu = new ThiThu();
            $thi_thu->user_id = Auth::user()->id;
            $thi_thu->so_lan_thi_thu = 9;
            $thi_thu->save();
        }

        /**
         * Nếu đã từng thi thì update số lần thi thử
         */
        else {
            $lan_thi_thu['0']->so_lan_thi_thu --;
            $lan_thi_thu['0']->update();
        }



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
}
