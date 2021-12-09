<?php

namespace App\repositories\Eloquent;

use App\models\BloodType;
use App\models\Nationality;
use App\models\Religion;
use App\models\Student;
use App\models\TheParent;
use App\repositories\model;
use App\repositories\StudentsRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StudentsRepository extends BasicRepository implements StudentsRepositoryInterface
{
    public $g;
    public $c;
    public function __construct(Student $model,GradesRepository $g,ClassroomsRepository $c)
    {
        parent::__construct($model);
        $this->g = $g;
        $this->c = $g;
    }


    public function getData(){
        $data['nationalities'] = Nationality::all();
        $data['religions'] = Religion::all();
        $data['Blood_types'] = BloodType::all();
        $data['TheParents'] = TheParent::all();
        $data['grades'] = $this->g->getAll();
        $data['classrooms'] = $this->c->getAll();
        return $data;
    }
}
