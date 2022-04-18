<?php
namespace App\repositories;

interface SubjectRepositoryInterface{
    public function getData($columns='*');
    public function create(array $attributes);
    public function getById($id);
    public function update(array $attributes,int $id);
    public function myModel():object;
    public function destroy($id);

}