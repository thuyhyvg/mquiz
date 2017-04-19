<?php

use Illuminate\Database\Seeder;
use App\CauHoi;

class CauHoiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('cau_hoi')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $data = [
                [
                        'mon_hoc_id' => '1',
                        'user_id' => '1',
                        'noi_dung_cau_hoi' => 'Câu hỏi toán rời rạc 1',
                ],
                [
                        'mon_hoc_id' => '1',
                        'user_id' => '1',
                        'noi_dung_cau_hoi' => 'Câu hỏi toán rời rạc 2',
                ],
                [
                        'mon_hoc_id' => '1',
                        'user_id' => '1',
                        'noi_dung_cau_hoi' => 'Câu hỏi toán rời rạc 3',
                ],
                [
                        'mon_hoc_id' => '1',
                        'user_id' => '1',
                        'noi_dung_cau_hoi' => 'Câu hỏi toán rời rạc 4',
                ],
                [
                        'mon_hoc_id' => '1',
                        'user_id' => '1',
                        'noi_dung_cau_hoi' => 'Câu hỏi toán rời rạc 5',
                ],
                [
                        'mon_hoc_id' => '1',
                        'user_id' => '1',
                        'noi_dung_cau_hoi' => 'Câu hỏi toán rời rạc 6',
                ],
        ];
        foreach($data as $item){
            CauHoi::create($item);
        }
    }
}
