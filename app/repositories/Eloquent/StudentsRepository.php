<?php

namespace App\repositories\Eloquent;

use App\models\BloodType;
use App\models\Nationality;
use App\models\Religion;
use App\models\Student;
use App\models\TheParent;
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
        $this->c = $c;
    }

    public function getMyData(){
        $data['nationalities'] = Nationality::all();
        $data['religions'] = Religion::all();
        $data['Blood_types'] = BloodType::all();
        $data['TheParents'] = TheParent::all('id', 'name_father_ar', 'name_father_en');
        $data['grades'] = $this->g->getData();
        $data['classrooms'] = $this->c->getData();
        return $data;
    }

    public function getRelatedStuff($col_name,$id)
    {
        return $this->model->where($col_name,$id)->pluck($col_name);
    }

    public function destroy($id):bool
    {
        $model = $this->model->find($id);
        if(!$model)
        {
            throw new ModelNotFoundException(__('not_found'));
        }
        return $model->forceDelete();

    }
}
