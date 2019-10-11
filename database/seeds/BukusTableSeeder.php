<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BukusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bukus')->insert([
            'judul' => 'Belajar Pemprograman PHP',
            'isbn' => '12345678',
            'pengarang' => 'Khalid Kadir',
            'penerbit' => 'PT Gramedia',
            'tahun_terbit' => 2005,
            'jumlah_buku' => 50,
            'deskripsi' => 'Buku pertama pemprograman untuk pemula PHP',
            'lokasi' => 'rak1',
            'cover' => 'buku-php.jpg',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        DB::table('bukus')->insert([
            'judul' => 'Belajar Pemprograman JAVA',
            'isbn' => '98945757',
            'pengarang' => 'Java Lider',
            'penerbit' => 'PT Buku Baru',
            'tahun_terbit' => 2015,
            'jumlah_buku' => 60,
            'deskripsi' => 'Buku pertama pemprograman untuk pemula JAVA',
            'lokasi' => 'rak2',
            'cover' => 'buku-java.jpg',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        
        DB::table('bukus')->insert([
            'judul' => 'Belajar Pemprograman Android',
            'isbn' => '45647536',
            'pengarang' => 'Android Java',
            'penerbit' => 'PT Buku Android',
            'tahun_terbit' => 2018,
            'jumlah_buku' => 20,
            'deskripsi' => 'Buku pertama pemprograman untuk pemula Android',
            'lokasi' => 'rak3',
            'cover' => 'buku-android.jpg',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
