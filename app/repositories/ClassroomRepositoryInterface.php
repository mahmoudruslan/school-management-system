<?php

namespace App\repositories;

interface ClassroomRepositoryInterface extends EloquentRepositoryInterface{
    public function getRelated($id);
}
