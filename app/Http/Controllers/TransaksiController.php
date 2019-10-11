<?php

namespace App\Http\Controllers;

use App\Repositories\TransaksiRepositories;
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

    public function __construct(TransaksiRepositories $transaksiRepo)
    {
        $this->transaksiRepo = $transaksiRepo;
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
            $dataTransaksis = Transaksi::where('anggota_id', Auth::user()->anggota->id)->get();
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
        $getRow     = Transaksi::orderBy('id', 'DESC')->get();
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

        $bukus      = Buku::where('jumlah_buku', '>', 0)->get();
        $anggotas   = Anggota::get();
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
        //
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
