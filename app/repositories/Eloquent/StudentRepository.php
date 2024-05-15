<?php

namespace App\repositories\Eloquent;

use App\Models\BloodType;
use App\Models\Nationality;
use App\Models\Religion;
use App\Models\Student;
use App\Models\TheParent;
use App\repositories\Eloquent\ClassroomRepository;
use App\repositories\Eloquent\GradeRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StudentRepository extends BasicRepository
{
    public $grade;
    public $classroom;
    public function __construct(Student $model,GradeRepository $grade,ClassroomRepository $classroom)
    {
        parent::__construct($model);
        $this->grade = $grade;
        $this->classroom = $classroom;
    }

    public function getMyData(){
        $data['nationalities'] = Nationality::all();
        $data['religions'] = Religion::all();
        $data['Blood_types'] = BloodType::all();
        $data['TheParents'] = TheParent::all('id', 'name_father_ar', 'name_father_en');
        $data['grades'] = $this->grade->all([]);
        $data['classrooms'] = $this->classroom->all([]);
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
