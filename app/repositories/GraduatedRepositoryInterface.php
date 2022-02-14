<?php

namespace App\repositories;

interface GraduatedRepositoryInterface
{
    public function getData($columns='*'):object;
    public function destroy($id):bool;
    public function getById($id);
}
