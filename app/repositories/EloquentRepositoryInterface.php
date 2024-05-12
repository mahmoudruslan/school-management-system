<?php

namespace App\repositories;
interface EloquentRepositoryInterface{
    // public function getData($columns='*');
    public function all($related, $columns='*');
    public function myModel():object;
    public function create(array $attributes);
    public function getById($id);
    public function update(array $attributes,int $id);
    public function destroy($id);
}
