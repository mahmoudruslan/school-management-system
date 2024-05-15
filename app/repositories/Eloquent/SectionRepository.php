<?php

namespace App\repositories\Eloquent;

use App\Models\Section;

class SectionRepository extends BasicRepository
{
    public function __construct(Section $model)
    {
        parent::__construct($model);
    }
    public function getRelatedStuff($col_name,$id)
    {
        return $this->model->where($col_name,$id)->pluck($col_name);
    }



}
