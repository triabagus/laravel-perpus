<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AnggotasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('anggotas')->insert([
            'id'  			=> 1,
            'user_id'  		=> 1,
            'npm'			=> 10000353,
            'name' 			=> 'Admin GC',
            'tempat_lahir'	=> 'Malang',
            'tgl_lahir'		=> '2018-01-01',
            'jk'			=> 'L',
            'prodi'			=> 'TI',
            'created_at'    => \Carbon\Carbon::now(),
            'updated_at'    => \Carbon\Carbon::now()
        ]);

        DB::table('anggotas')->insert([
            'id'  			=> 2,
            'user_id'  		=> 2,
            'npm'			=> 10000375,
            'name' 			=> 'User GC',
            'tempat_lahir'	=> 'Bogor',
            'tgl_lahir'		=> '2019-01-01',
            'jk'			=> 'L',
            'prodi'			=> 'TI',
            'created_at'    => \Carbon\Carbon::now(),
            'updated_at'    => \Carbon\Carbon::now()
        ]);
    }
}
