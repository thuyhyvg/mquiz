<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(BaithiTableSeeder::class);
        // $this->call(CauHoiTableSeeder::class);
        // $this->call(DapAnTableSeeder::class);
        // $this->call(MonhocTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
        $this->call(BaiThiCauHoiTableSeeder::class);
        // $this->call(RoleUserTableSeeder::class);
    }
}
