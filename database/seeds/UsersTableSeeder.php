<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            'name' => 'Administrator - Perpus',
            'username' => 'admin12345',
            'email' => 'admins@gmail.com',
            'password' => bcrypt('password'),
            'image' => NULL,
            'level' => 'admin',
            'remember_token' => NULL,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        
        DB::table('users')->insert([
            'name' => 'User - Perpus',
            'username' => 'user12345',
            'email' => 'users@gmail.com',
            'password' => bcrypt('password'),
            'image' => NULL,
            'level' => 'user',
            'remember_token' => NULL,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
