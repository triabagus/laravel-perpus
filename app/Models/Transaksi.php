<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = ['kode_transaksi', 'anggota_id', 'buku_id', 'tgl_pinjam', 'tgl_kembali', 'status', 'jumlah_buku_dipinjam', 'ket'];

    /**
     * Method 
     */
    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    /**
     * Method
     */
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

}
