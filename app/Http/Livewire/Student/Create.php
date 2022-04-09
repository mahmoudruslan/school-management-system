<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Http\Requests\StudentRequest;
use App\models\TheParent;
use App\models\BloodType;
use App\models\Nationality;
use App\models\Student;
use App\repositories\ClassroomRepositoryInterface;
use App\repositories\GradeRepositoryInterface;
use App\repositories\SectionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    use WithFileUploads;
    public $editMode = false;
    public $currentStep = 1;
    public $addMode = false;
    public $photoss;
    public $name_ar,
        $route,
        $name_en,
        $password,
        $grade_id = '',
        $classroom_id = '',
        $section_id = '',
        $student_nationality_id = '',
        $student_blood_type_id = '',
        $religion = '',
        $joining_date,
        $student_address,
        $gender,
        $email,
        $date_of_birth,
        $entry_status,
        $father_name_ar,
        $father_name_en,
        $father_national_id,
        $father_phone,
        $father_job_ar,
        $classrooms,
        $sections,
        $father_job_en,
        $father_nationality_id = '',
        $mother_name_ar,
        $mother_name_en,
        $mother_national_id,
        $address_father;
    public $successMsg = '';
    public $errorMsg = '';


    public function render(GradeRepositoryInterface $g)
    {
        return view('livewire.student.create', [

            'bloodtypes' => BloodType::all(),
            'nationalitys' => Nationality::all(),
            'grades' => $g->getData(),
        ]);
    }
    #######################################  start Add mode  #############################################
    public function change(ClassroomRepositoryInterface $c, SectionRepositoryInterface $s)
    {
        $this->classrooms = $c->myModel()->where('grade_id', $this->grade_id)->select('id', 'name_ar', 'name_en')->get();
        $this->sections = $s->myModel()->where('classroom_id', $this->classroom_id)->select('id', 'name_ar', 'name_en')->get();
    }


    //real time validation
    public function updated($probertyName)
    {
        $req = new StudentRequest();
        $this->validateOnly($probertyName, $req->realTimeValidation());
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }

    #######################################  start create parents  #############################################
    public function finish() //store
    {
        DB::beginTransaction();
        try {
            $parent = TheParent::create([
                'father_name_ar' => $this->father_name_ar,

                'father_name_en' => $this->father_name_en,
                'father_national_id' => $this->father_national_id,
                'father_phone' => $this->father_phone,

                'father_job_ar' => $this->father_job_ar,
                'father_job_en' => $this->father_job_en,
                'father_nationality_id' => $this->father_nationality_id,

                'mother_name_ar' => $this->mother_name_ar,
                'mother_name_en' => $this->mother_name_en,
                'mother_national_id' => $this->mother_national_id,
            ]);

            Student::create([
                'name_ar' => $this->name_ar,
                'name_en' => $this->name_en,
                'email' => $this->email,
                'password' => $this->password,
                'student_nationality_id' => $this->student_nationality_id,
                'student_blood_type_id' => $this->student_blood_type_id == ''  ? null : $this->student_blood_type_id,
                'date_of_birth' => $this->date_of_birth,
                'religion' => $this->religion,
                'grade_id' => $this->grade_id,
                'classroom_id' => $this->classroom_id,
                'section_id' => $this->section_id,
                'parent_id' => $parent->id,
                'gender' => $this->gender,
                'student_address' => $this->student_address,
                'entry_status' => 1,

            ]);
            DB::commit();
            $this->clearForm();
            $this->currentStep = 1;
            $this->successMsg =  __('Data saved successfully');
        } catch (\Exception $e) {
            DB::rollback();
            $this->currentStep = 1;
            $this->errorMsg = $e->getMessage();
        }
    }

    //Move to the next step in the edit mode
    public function step2()
    {
        $req = new StudentRequest();
        $this->validate($req->createStep1());
        $this->currentStep = 2;
    }
    //Move to the next step in the edit mode
    public function step3()
    {
        $req = new StudentRequest();
        $this->validate($req->createStep2());
        $this->currentStep = 3;
    }


    public function clearMessages()
    {
        $this->successMsg = '';
        $this->errorMsg = '';
    }

    // remove inputs content after add parent
    public function clearForm()
    {
        $this->father_name_ar = '';
        $this->father_name_en = '';
        $this->father_national_id = '';
        $this->father_phone = '';
        $this->father_job_ar = '';
        $this->father_job_en = '';
        $this->father_nationality_id = '';
        $this->mother_name_ar = '';
        $this->mother_name_en = '';
        $this->mother_national_id = '';
        $this->name_ar = '';
        $this->name_en = '';
        $this->email = '';
        $this->password = '';
        $this->student_nationality_id = '';
        $this->student_blood_type_id = '';
        $this->date_of_birth = '';
        $this->religion = '';
        $this->grade_id = '';
        $this->classroom_id = '';
        $this->section_id = '';
        $this->gender = '';
        $this->student_address = '';
    }

    // validation messages
    public function messages()
    {
        $req = new StudentRequest();
        return $req->messages();
    }
}
