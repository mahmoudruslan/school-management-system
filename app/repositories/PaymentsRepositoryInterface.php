<?php

namespace App\repositories;

interface PaymentsRepositoryInterface
{
    public function getData($columns='*'):object;
    public function getById($id);
    public function create(array $attributes);
    public function update(array $attributes,int $id);
    public function destroy($id);
}
