<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransaksiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function createRules()
    {
        return [
            'kode_transaksi'    => 'required|string|max:255',
            'anggota_id'        => 'required',
            'buku_id'           => 'required',
            'tgl_pinjam'        => 'required',
            'tgl_kembali'       => 'required',
            'status'            => 'required',
            'jumlah_buku_dipinjam' => 'required',
            'ket'                  => 'min:5'
        ];
    }
    
    public function rules()
    {

        if( $this->isMethod('post') ) {
            return $this->createRules();
        } elseif ( $this->isMethod('put') ) {
            return $this->updateRules();
        }      
    }
}
