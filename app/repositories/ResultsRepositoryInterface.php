<?php
namespace App\repositories;

interface ResultsRepositoryInterface{
    
    public function getData($columns='*'):object;
    public function myModel():object;
    public function create(array $attributes);
    public function update(array $attributes,int $id);
    public function destroy($id);
    public function getById($id);
}