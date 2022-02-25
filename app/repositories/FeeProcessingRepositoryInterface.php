<?php

namespace App\repositories;

interface FeeProcessingRepositoryInterface
{
    public function getData($columns='*');
    public function getById($id);
    public function create(array $attributes);
    public function update(array $attributes,int $id);
    public function destroy($id);
}
