<?php

namespace App\repositories;

interface SectionRepositoryInterface
{
    public function getData($columns='*'):object;
    public function myModel(): object;
    public function create(array $attributes);
    public function getById($id);
    public function update(array $attributes,int $id);
    public function destroy($id);
    public function getRelatedStuff($col_name,$id);

}
