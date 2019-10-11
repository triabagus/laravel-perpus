<?php

namespace App\Http\Controllers;

use App\Repositories\TransaksiRepositories;
use App\Repositories\BukuRepositories;
use App\Repositories\AnggotaRepositories;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Transaksi;
use Carbon\Carbon;
use Session;
use Auth;
use Illuminate\Support\Facades\Redirect;

class TransaksiController extends Controller
{
    protected $transaksi = null;

    public function __construct(TransaksiRepositories $transaksiRepo, BukuRepositories $bukuRepo, AnggotaRepositories $anggotaRepo)
    {
        $this->transaksiRepo    = $transaksiRepo;
        $this->bukuRepo         = $bukuRepo;
        $this->anggotaRepo      = $anggotaRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->level == 'user')
        {
            $dataTransaksis = $this->transaksiRepo->getAnggota(Auth::user()->anggota->id);
        } else {
            $dataTransaksis = $this->transaksiRepo->getAll();
        }

        return view('transaksi.index', compact('dataTransaksis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getRow     = $this->transaksiRepo->getIdTransaksi();
        $rowCount   = $getRow->count();
        $lastId     = $getRow->first();
        
        $kode       = "TR00001";

        if($rowCount > 0):
            if($lastId->id < 9):
                $kode = "TR0000".''.($lastId->id + 1);
            elseif($lastId->id < 99):
                $kode = "TR000".''.($lastId->id + 1);
            elseif($lastId->id < 999):
                $kode = "TR00".''.($lastId->id + 1);
            elseif($lastId->id < 9999):
                $kode = "TR0".''.($lastId->id + 1);
            else:
                $kode = "TR".''.($lastId->id + 1);
            endif;
        endif;

        $bukus      = $this->bukuRepo->getJumlahBuku();
        $anggotas   = $this->anggotaRepo->getAll();
        return view('transaksi.create', compact('bukus', 'kode', 'anggotas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
