<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $data = [
                [
                        'name' => 'Nguyễn Văn Thủy',
                        'email' => 'thuyhyvg@gmail.com',
                        'password' => bcrypt('1234567'),
                ],
                [
                        'name' => 'Trần Văn D',
                        'email' => 'gv1@gmail.com',
                        'password' => bcrypt('1234567'),
                ],
                [
                        'name' => 'Nguyễn Thị A',
                        'email' => 'hs1@gmail.com',
                        'password' => bcrypt('1234567'),
                ],
                [
                        'name' => 'Admin',
                        'email' => 'admin@gmail.com',
                        'password' => bcrypt('1234567'),
                ],
        ];
        foreach($data as $item){
            User::create($item);
        }
    }
}
