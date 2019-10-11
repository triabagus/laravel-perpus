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
}