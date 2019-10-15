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
        $rowCount = $getRow->count();

        if($rowCount <= 0):
            $lastId     = 0;
        else:
            $lastId     = $getRow->first();
            $lastId     = $lastId->id;
        endif;

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $kode       = $this->transaksiRepo->generate_kode($permitted_chars, $lastId, 16);

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
        $this->validate(
            $request, $this->transaksiRepo->validationRule(), $this->transaksiRepo->customMessageRule()
        );

        $transaksi = Transaksi::create([
            'kode_transaksi' => $request->get('kode_transaksi'),
            'tgl_pinjam' => $request->get('tgl_pinjam'),
            'tgl_kembali' => $request->get('tgl_kembali'),
            'buku_id' => $request->get('buku_id'),
            'anggota_id' => $request->get('anggota_id'),
            'ket' => $request->get('ket'),
            'jumlah_buku_dipinjam' => $request->get('jumlah_buku_dipinjam'),
            'status' => 'pinjam'
        ]);

        $transaksi->buku->where('id', $transaksi->buku_id)
                    ->update([
                        'jumlah_buku' => ($transaksi->buku->jumlah_buku - $request->get('jumlah_buku_dipinjam')),
                    ]);
        
        alert()->success('Berhasil.','Data telah ditambahkan!');
        return redirect()->route('transaksi.index');

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
    public function edit(int $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $transaksi = $this->transaksiRepo->getById($id);

        $transaksi->update([
                'status' => 'kembali'
        ]);

        $transaksi->buku->where('id', $transaksi->buku->id)
                        ->update([
                            'jumlah_buku' => ($transaksi->buku->jumlah_buku + $transaksi->jumlah_buku_dipinjam),
                        ]);

        alert()->success('Berhasil.','Buku telah kembali!');
        return redirect()->route('transaksi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $this->transaksiRepo->delete($id);
        alert()->success('Berhasil.','Data telah dihapus!');
        return redirect()->route('transaksi.index');
    }
}
