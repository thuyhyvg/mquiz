<?php

use Illuminate\Database\Seeder;
use App\MonHoc;

class MonHocTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('mon_hoc')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $data = [
                [
                        'ten_mon_hoc' => 'Toán Rời Rạc',
                ],
                [
                        'ten_mon_hoc' => 'Xác Suất Thống Kê',
                ],
                [
                        'ten_mon_hoc' => 'An Toàn Thông Tin',
                ],
                [
                        'ten_mon_hoc' => 'Công Nghệ Phần Mềm',
                ],
        ];
        foreach($data as $item){
            MonHoc::create($item);
        }
    }
}
