<?php

use Illuminate\Database\Seeder;
use App\RoleUser;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('role_user')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $data = [
                [
                        'user_id' => '1',
                        'role_id' => '1',
                ],
                [
                        'user_id' => '2',
                        'role_id' => '1',
                ],
                [
                        'user_id' => '2',
                        'role_id' => '2',
                ],
                [
                        'user_id' => '3',
                        'role_id' => '2',
                ],
                [
                        'user_id' => '4',
                        'role_id' => '3',
                ],
        ];
        foreach($data as $item){
            RoleUser::create($item);
        }
    }
}
