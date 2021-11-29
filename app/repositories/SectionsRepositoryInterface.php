<?php

namespace App\repositories;

use App\repositories\Eloquent\ClassroomsRepository;

interface SectionsRepositoryInterface
{
    public function getAll():object;
    public function create(array $attributes);
    public function getById($id);
    public function update(array $attributes,int $id):object;
    public function destroy($id):bool;

}
