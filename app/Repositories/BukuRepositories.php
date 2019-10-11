<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuRepositories implements MyInterface
{
    private $model;

    public function __construct(Buku $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->get();
    }

    public function getById(int $id)
    {

    }

    public function create(array $attribute)
    {

    }

    public function update(int $id, array $attribute)
    {

    }

    public function delete(int $id)
    {

    }

    /**
     * Not Interface
     */
    public function getJumlahBuku()
    {
        return $this->model->where('jumlah_buku', '>', 0)->get();
    }
}