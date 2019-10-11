<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\User;

class UserRepositories implements MyInterface
{
    private $model;

    public function __construct(User $model)
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