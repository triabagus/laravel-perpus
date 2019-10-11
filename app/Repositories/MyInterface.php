<?php
/**
 * Created by Tria Bagus.
 * Date: 10.10.19
 * Time: 09.09
 */
namespace App\Repositories;

interface MyInterface
{
    function getAll();
    function getById(int $id);
    function create(array $attributes);
    function update(int $id, array $attributes);
    function delete(int $id);
}