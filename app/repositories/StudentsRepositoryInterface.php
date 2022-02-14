<?php

namespace App\repositories;

use App\models\BloodType;
use App\repositories\Eloquent\ClassroomsRepository;
use App\repositories\Eloquent\GradesRepository;
use App\repositories\Eloquent\SectionsRepository;

interface StudentsRepositoryInterface
{
    public function getData($columns='*'):object;
    public function create(array $attributes);
    public function getById($id);
    public function update(array $attributes,int $id):object;
    public function destroy($id):bool;
    public function getMyData();
    public function getRelatedStuff($col_name,$id);

}
