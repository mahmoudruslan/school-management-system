<?php

namespace App\repositories;

interface GradesRepositoryInterface
{
    public function getAll():object;
    public function create(array $attributes);
    public function update(array $attributes,int $id):object;
    public function destroy($id):bool;
}
