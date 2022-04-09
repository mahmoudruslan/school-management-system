<?php

namespace App\repositories;

interface AttendanceRepositoryInterface
{
    public function getData($columns='*'):object;
    public function myModel():object;
    public function createOrup(array $x, array $attributes);
    public function getById($id);
    public function update(array $attributes,int $id);
}
