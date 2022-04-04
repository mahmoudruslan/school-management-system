<?php

namespace App\repositories;

interface FeesInvoiceRepositoryInterface
{
    public function getData($columns='*'):object;
    public function getById($id);
    public function myModel():object;
    public function create(array $attributes);
    public function update(array $attributes,int $id):object;
    public function destroy($id);
}
