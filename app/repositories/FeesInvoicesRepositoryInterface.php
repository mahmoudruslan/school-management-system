<?php

namespace App\repositories;

interface FeesInvoicesRepositoryInterface
{
    public function getAll():object;
    public function getById($id);
    public function create(array $attributes);
    public function update(array $attributes,int $id):object;
    public function destroy($id):bool;
}
