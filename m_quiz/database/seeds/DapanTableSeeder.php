<?php

use Illuminate\Database\Seeder;
use App\DapAn;

class DapAnTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('dap_an')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $data = [
                [
                        'cau_hoi_id' => '1',
                        'noi_dung_dap_an' => 'đáp án câu 1 - 1',
                        'dung_sai' => '1',
                ],
                [
                        'cau_hoi_id' => '1',
                        'noi_dung_dap_an' => 'đáp án câu 1 - 2',
                        'dung_sai' => '0',
                ],
                [
                        'cau_hoi_id' => '1',
                        'noi_dung_dap_an' => 'đáp án câu 1 - 3',
                        'dung_sai' => '0',
                ],
                [
                        'cau_hoi_id' => '2',
                        'noi_dung_dap_an' => 'đáp án câu 2 - 1',
                        'dung_sai' => '1',
                ],
                [
                        'cau_hoi_id' => '2',
                        'noi_dung_dap_an' => 'đáp án câu 2 - 2',
                        'dung_sai' => '0',
                ],
                [
                        'cau_hoi_id' => '2',
                        'noi_dung_dap_an' => 'đáp án câu 2 - 3',
                        'dung_sai' => '0',
                ],
                [
                        'cau_hoi_id' => '3',
                        'noi_dung_dap_an' => 'đáp án câu 3 - 1',
                        'dung_sai' => '1',
                ],
                [
                        'cau_hoi_id' => '3',
                        'noi_dung_dap_an' => 'đáp án câu 3 - 2',
                        'dung_sai' => '0',
                ],
                [
                        'cau_hoi_id' => '3',
                        'noi_dung_dap_an' => 'đáp án câu 3 - 3',
                        'dung_sai' => '0',
                ],
                [
                        'cau_hoi_id' => '4',
                        'noi_dung_dap_an' => 'đáp án câu 4 - 1',
                        'dung_sai' => '1',
                ],
                [
                        'cau_hoi_id' => '4',
                        'noi_dung_dap_an' => 'đáp án câu 4 - 2',
                        'dung_sai' => '0',
                ],
                [
                        'cau_hoi_id' => '4',
                        'noi_dung_dap_an' => 'đáp án câu 4 - 3',
                        'dung_sai' => '0',
                ],
                [
                        'cau_hoi_id' => '5',
                        'noi_dung_dap_an' => 'đáp án câu 5 - 1',
                        'dung_sai' => '1',
                ],
                [
                        'cau_hoi_id' => '5',
                        'noi_dung_dap_an' => 'đáp án câu 5 - 2',
                        'dung_sai' => '0',
                ],
                [
                        'cau_hoi_id' => '5',
                        'noi_dung_dap_an' => 'đáp án câu 5 - 3',
                        'dung_sai' => '0',
                ],
                [
                        'cau_hoi_id' => '6',
                        'noi_dung_dap_an' => 'đáp án câu 6 - 1',
                        'dung_sai' => '1',
                ],
                [
                        'cau_hoi_id' => '6',
                        'noi_dung_dap_an' => 'đáp án câu 6 - 2',
                        'dung_sai' => '0',
                ],
                [
                        'cau_hoi_id' => '6',
                        'noi_dung_dap_an' => 'đáp án câu 6 - 3',
                        'dung_sai' => '0',
                ],
        ];
        foreach($data as $item){
            DapAn::create($item);
        }
    }
}
