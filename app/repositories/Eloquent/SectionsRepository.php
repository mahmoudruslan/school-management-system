<?php

namespace App\repositories\Eloquent;

use App\models\Section;
use App\repositories\SectionsRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class SectionsRepository extends BasicRepository implements SectionsRepositoryInterface
{
    public function __construct(Section $model)
    {
        parent::__construct($model);
    }



}
