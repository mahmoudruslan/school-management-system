<?php

namespace App\repositories;

interface FundAccountRepositoryInterface
{
    public function getById($id);
    public function create(array $attributes);
    public function update(array $attributes,int $id);
    public function destroy($id);
}
