<?php

namespace App\repositories;

interface StudentsRepositoryInterface
{
    public function getData($columns='*'):object;
    public function myModel():object;
    public function create(array $attributes);
    public function getById($id);
    public function update(array $attributes,int $id):object;
    public function destroy($id):bool;
    public function getMyData();
    public function getRelatedStuff($col_name,$id);

}
