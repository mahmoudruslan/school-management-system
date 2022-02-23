<?php
namespace App\repositories;

interface ResultsRepositoryInterface{
    
    public function getData($columns='*'):object;
    public function myModel():object;
    public function create(array $attributes);
    public function update(array $attributes,int $id):object;
    public function destroy($id):bool;
    public function getById($id);
}