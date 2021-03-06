<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiRepositories implements MyInterface
{
    private $model;

    public function __construct(Transaksi $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->get();
    }

    public function getById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $attribute)
    {

    }

    public function update(int $id, array $attribute)
    {

    }

    public function delete(int $id)
    {
        return $this->model->find($id)->delete();
    }

    /**
     * Not Interface
     */
    public function getAnggota(int $id)
    {
        return $this->model->where('anggota_id', $id)->get();
    }

    public function getIdTransaksi()
    {
        return $this->model->orderBy('id', 'DESC')->get();
    }

    public function validationRule()
    {
        return $rules = [
            'kode_transaksi' => 'required|string|max:255',
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'required',
            'buku_id' => 'required',
            'anggota_id' => 'required',
            'jumlah_buku_dipinjam' => 'required'
        ];
    }

    public function customMessageRule()
    {  
        return $customMessage = [
            'jumlah_buku_dipinjam.required' => 'kosong'
        ];
    }

    public function generate_kode($input, $id, $strength = 16) {
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
    
        return "TR".$random_string."".$id;
    }
}