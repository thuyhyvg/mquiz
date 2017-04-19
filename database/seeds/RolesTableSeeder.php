<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $data = [
                [
                        'slug' => 'teacher',
                        'name' => 'Teacher',
                ],
                [
                        'slug' => 'student',
                        'name' => 'Seacher',
                ],
        ];
        foreach($data as $item){
            Role::create($item);
        }
    }
}
