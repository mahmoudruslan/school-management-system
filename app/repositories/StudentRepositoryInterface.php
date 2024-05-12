<?php

namespace App\repositories;

interface StudentRepositoryInterface extends EloquentRepositoryInterface{
    public function getRelatedStuff($col_name,$id);

}
