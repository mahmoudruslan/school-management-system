<?php

namespace App\repositories;

interface AttendancesRepositoryInterface
{
    public function getData($columns='*'):object;
    // public function thisModel():object;
    public function create(array $attributes);
    public function getById($id);
    public function update(array $attributes,int $id);
    public function destroy($id);
}
