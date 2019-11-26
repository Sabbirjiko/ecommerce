<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Sabbir hossain Jiko',
            'email' => 'admin@demo.com',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(15),
            'isadmin' => 1,
        ]);
    }
}
