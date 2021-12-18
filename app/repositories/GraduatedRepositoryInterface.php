<?php

namespace App\repositories;

interface GraduatedRepositoryInterface
{
    public function getAll():object;
    public function destroy($id):bool;
    public function getById($id);
}
