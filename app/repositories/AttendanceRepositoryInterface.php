<?php

namespace App\repositories;

interface AttendanceRepositoryInterface extends EloquentRepositoryInterface{
    public function createOrup(array $x, array $attributes);

}
