<?php

namespace App\repositories;

interface GradeRepositoryInterface
{
    public function getData($columns='*'):object;
    public function create(array $attributes);
    public function update(array $attributes,int $id);
    public function destroy($id);
}
