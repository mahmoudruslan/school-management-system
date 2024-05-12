<?php

namespace App\repositories;

interface SectionRepositoryInterface extends EloquentRepositoryInterface{
    public function getRelatedStuff($col_name,$id);

}
