<?php

use Illuminate\Database\Seeder;
use App\BaiThi;

class BaiThiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('bai_thi')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $data = [
                [
                        'mon_hoc_id' => '1',
                        'user_id' => '1',
                        'ten_bai_thi' => 'Kiểm tra giữa kỳ lần 1',
                        'ngay_thi' => '2016-07-19 19:00:00',
                        'so_cau_hoi' => '4',
                        'thoi_gian' => '30',
                        'khoa' => '1',
                ],
                [
                        'mon_hoc_id' => '3',
                        'user_id' => '1',
                        'ten_bai_thi' => 'Kiểm tra giữa kỳ lần 2',
                        'ngay_thi' => '2016-07-19 20:00:00',
                        'so_cau_hoi' => '5',
                        'thoi_gian' => '30',
                        'khoa' => '1',
                ],
                [
                        'mon_hoc_id' => '2',
                        'user_id' => '1',
                        'ten_bai_thi' => 'Kiểm tra giữa kỳ lần 1',
                        'ngay_thi' => '2016-07-19 19:00:00',
                        'so_cau_hoi' => '4',
                        'thoi_gian' => '30',
                        'khoa' => '1',
                ],
                [
                        'mon_hoc_id' => '4',
                        'user_id' => '1',
                        'ten_bai_thi' => 'Kiểm tra giữa kỳ lần 2',
                        'ngay_thi' => '2016-07-19 20:00:00',
                        'so_cau_hoi' => '5',
                        'thoi_gian' => '30',
                        'khoa' => '1',
                ],
        ];
        foreach($data as $item){
            BaiThi::create($item);
        }
    }
}
