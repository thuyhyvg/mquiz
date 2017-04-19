<?php

use Illuminate\Database\Seeder;
use App\BaiThiCauHoi;

class BaiThiCauHoiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('bai_thi_cau_hoi')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $data = [
                [
                        'bai_thi_id' => '1',
                        'cau_hoi_id' => '2',
                ],
                [
                        'bai_thi_id' => '1',
                        'cau_hoi_id' => '3',
                ],
                [
                        'bai_thi_id' => '1',
                        'cau_hoi_id' => '4',
                ],
                [
                        'bai_thi_id' => '1',
                        'cau_hoi_id' => '5',
                ],
                [
                    'bai_thi_id' => '2',
                    'cau_hoi_id' => '1',
                ],
                [
                        'bai_thi_id' => '2',
                        'cau_hoi_id' => '3',
                ],
                [
                        'bai_thi_id' => '2',
                        'cau_hoi_id' => '5',
                ],
        ];
        foreach($data as $item){
            BaiThiCauHoi::create($item);
        }
    }
}
