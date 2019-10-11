<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $fillable = [
        'judul', 'isbn', 'penerbit', 'pengarang', 'tahun_terbit', 'jumlah_buku', 'deskripsi', 'lokasi', 'cover'
    ];

    /**
     * Method One To Many 
     */
    public function transaksi()
    {
    	return $this->hasMany(Transaksi::class);
    }
}
