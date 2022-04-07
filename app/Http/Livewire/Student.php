<?php

namespace App\Http\Livewire;

use App\Http\Requests\StudentRequest;
use App\models\TheParent;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\models\BloodType;
use App\models\Grade;
use App\models\Nationality;
use App\models\Student as ModelsStudent;
use Illuminate\Support\Str;
use App\repositories\ClassroomRepositoryInterface;
use App\repositories\GradeRepositoryInterface;
use App\repositories\SectionRepositoryInterface;
use App\repositories\StudentRepositoryInterface;
use App\Traits\SaveImgTrait;

class Student extends Component
{
    use SaveImgTrait;
    use WithFileUploads;
    public $editMode = false;
    public $currentStep = 1;
    public $addMode = false;
    public $photoss;
    public $name_ar,
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

    public function render(StudentRepositoryInterface $s, GradeRepositoryInterface $g)
    {


        return view('livewire.student', [
            'my_parents' => TheParent::all(),
            'students' => $s->getData(['id', 'name_ar', 'name_en', 'gender', 'grade_id', 'classroom_id', 'section_id']),
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

    public function Add()
    {
        if (!isset($this->entry_status)) { //entry status input checked by default
            $this->entry_status = true;
        }
        $this->addMode = true;
        $this->clearForm();
        $this->successMsg = '';
        $this->errorMsg = '';
        $this->currentStep = 1;
    }
    //real time validation
    public function updated($probertyName)
    {
        $req = new StudentRequest();
        $this->validateOnly($probertyName, $req->realTimeValidation());
    }

    // Father data validation
    public function firstStepSubmit()
    {
        $req = new StudentRequest();
        $this->validate($req->rules1());

        $this->currentStep = 2;
    }
    // Mother data validation
    public function secondStepSubmit()
    {
        $req = new StudentRequest();
        $this->validate($req->rules2());

        $this->currentStep = 3;
    }

    // Going back from one step to the next
    public function back($step)
    {
        $this->currentStep = $step;
    }

    // Back to Parents' table
    public function toParentList()
    {
        $this->editMode = false;
        $this->addMode = false;
    }
    #######################################  start create parents  #############################################
    public function store(StudentRepositoryInterface $s)
    {
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
            $s->create([
                'name_ar' => $this->name_ar,
                'name_en' => $this->name_en,
                'email' => $this->email,
                'password' => $this->password,
                'student_nationality_id' => $this->student_nationality_id,
                'student_blood_type_id' => $this->student_blood_type_id,
                'date_of_birth' => $this->date_of_birth,
                'religion' => $this->religion,
                'grade_id' => $this->grade_id,
                'classroom_id' => $this->classroom_id,
                'section_id' => $this->section_id,
                'parent_id' => $parent->id,
                'gender' => $this->gender,
                'student_address' => $this->student_address,
                'entry_status' => $this->entry_status,

            ]);
            $this->clearForm();
            $this->addMode = true;
            $this->currentStep = 1;
            $this->successMsg =  __('Data saved successfully');
        } catch (\Exception $e) {
            $this->currentStep = 1;
            $this->errorMsg = $e->getMessage();
        }
    }
    #######################################  start Edit parents  #############################################
    // Fetching the owner's ID number in form
    public function edit($id, StudentRepositoryInterface $s)
    {
        $this->currentStep = 1;
        $this->editMode = true;
        $this->student_id = $id;
        $student = $s->getById($id);
        $parent = TheParent::find($student->parent_id);

        if ($student->entry_status == 'Noob') { //entry status input checked by default
            $this->entry_status = true;
        } else {
            $this->entry_status = false;
        }
        $this->father_name_ar = $parent->father_name_ar;
        $this->father_name_en = $parent->father_name_en;
        $this->father_national_id = $parent->father_national_id;
        $this->father_phone = $parent->father_phone;
        $this->father_job_ar = $parent->father_job_ar;
        $this->father_job_en = $parent->father_job_en;
        $this->father_nationality_id = $parent->father_nationality_id;
        $this->mother_name_ar = $parent->mother_name_ar;
        $this->mother_name_en = $parent->mother_name_en;
        $this->mother_national_id = $parent->mother_national_id;

        $this->name_ar = $student->name_ar;
        $this->name_en = $student->name_en;
        $this->email = $student->email;
        $this->student_nationality_id = $student->student_nationality_id;
        $this->student_blood_type_id = $student->student_blood_type_id;
        $this->date_of_birth = $student->date_of_birth;
        $this->religion = $student->religion;
        $this->grade_id = $student->grade_id;
        // $this->classroom_id = $student->classroom_id;
        // $this->section_id = $student->section_id;
        $this->parent_id = $student->parent_id;
        $this->gender = $student->gender;
        $this->student_address = $student->student_address;
    }

    //Move to the next step in the edit mode
    public function firstStepSubmitEdit()
    {
        $req = new StudentRequest();
        $this->validate($req->editRule1());
        $this->currentStep = 2;
    }
    //Move to the next step in the edit mode
    public function secondStepSubmitEdit()
    {
        $req = new StudentRequest();
        $this->validate($req->rules2());
        $this->currentStep = 3;
    }

    #######################################  start update parents  #############################################
    public function update($id, StudentRepositoryInterface $s)
    {
        try {

            $student = $s->getById($id);
            $parent = TheParent::find($student->parent_id);


            $parent->update([
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
            $student->update([
                'name_ar' => $this->name_ar,
                'name_en' => $this->name_en,
                'email' => $this->email,
                'password' => $this->password,
                'student_nationality_id' => $this->student_nationality_id,
                'student_blood_type_id' => $this->student_blood_type_id,
                'date_of_birth' => $this->date_of_birth,
                'religion' => $this->religion,
                'grade_id' => $this->grade_id,
                'classroom_id' => $this->classroom_id,
                'section_id' => $this->section_id,
                'parent_id' => $parent->id,
                'gender' => $this->gender,
                'student_address' => $this->student_address,
                'entry_status' => $this->entry_status,

            ]);

            $this->successMsg = __('Data updated successfully');
            $this->editMode = false;
        } catch (\Exception $e) {
            $this->currentStep = 1;
            $this->errorMsg = $e->getMessage();
        }
    }
    #######################################  start delete parents  #############################################

    public function delete($id, StudentRepositoryInterface $s)
    {
        try {

            $student = $s->getById($id);
            if (!$student) {
                $this->errorMsg = __('not available');
            } else {
                $student->delete();
                $this->successMsg = __('Data deleted successfully');
            }
        } catch (\Exception $e) {
            $this->errorMsg = $e->getMessage();
        }
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
