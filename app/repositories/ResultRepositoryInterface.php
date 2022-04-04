<?php
namespace App\repositories;

interface ResultRepositoryInterface{
    
    public function getData($columns='*'):object;
    public function myModel():object;
    public function create(array $attributes);
    public function update(array $attributes,int $id);
    public function destroy($id);
    public function getById($id);
}