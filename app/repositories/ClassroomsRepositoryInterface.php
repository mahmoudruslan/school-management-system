<?php

namespace App\repositories;

interface ClassroomsRepositoryInterface
{
    public function getData($columns='*');
    public function myModel(): object;
    public function create(array $attributes);
    public function getById($id);
    public function update(array $attributes,int $id);
    public function destroy($id);
    public function getRelated($id);
}
