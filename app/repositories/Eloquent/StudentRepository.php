<?php

namespace App\repositories\Eloquent;

use App\Models\BloodType;
use App\Models\Nationality;
use App\Models\Religion;
use App\Models\Student;
use App\Models\TheParent;
use App\repositories\ClassroomRepositoryInterface;
use App\repositories\GradeRepositoryInterface;
use App\repositories\StudentRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StudentRepository extends BasicRepository implements StudentRepositoryInterface
{
    public $g;
    public $c;
    public function __construct(Student $model,GradeRepositoryInterface $g,ClassroomRepositoryInterface $c)
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
