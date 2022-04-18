<?php
namespace App\repositories;

interface BookRepositoryInterface{
    public function getData($columns='*');
    public function create(array $attributes);
    public function getById($id);
    public function myModel():object;
    public function update(array $attributes,int $id);
    public function destroy($id);
}