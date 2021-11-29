<?php

namespace App\repositories;
interface EloquentRepositoryInterface
{
    public function getAll():object;
    public function create(array $attributes);
    public function getById($id);
    public function update(array $attributes,int $id):object;
    public function destroy($id):bool;
}
