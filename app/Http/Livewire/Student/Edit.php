<?php

namespace App\Http\Livewire\Student;

use App\Http\Requests\StudentRequest;
use App\Models\TheParent;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\BloodType;
use App\Models\Nationality;
use App\repositories\ClassroomRepositoryInterface;
use App\repositories\GradeRepositoryInterface;
use App\repositories\SectionRepositoryInterface;
use App\repositories\StudentRepositoryInterface;

class Edit extends Component
{
    use WithFileUploads;
    public $currentStep = 1;
    public $name_ar,
        $student,
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

    public function mount($student)
    {

        $this->route = url()->previous();
        //student data
        $this->name_ar = $student->name_ar;
        $this->student_id = $student->id;
        $this->name_en = $student->name_en;
        $this->grade_id = $student->grade_id;
        $this->classroom_id = $student->classroom_id;
        $this->section_id = $student->section_id;
        $this->student_nationality_id = $student->student_nationality_id;
        $this->student_blood_type_id = $student->student_blood_type_id;
        $this->religion = $student->religion;
        $this->joining_date = $student->joining_date;
        $this->student_address = $student->student_address;
        $this->gender = $student->gender;
        $this->email = $student->email;
        $this->date_of_birth = $student->date_of_birth;
        $this->entry_status = $student->entry_status;
        //parent data
        $parent = TheParent::find($student->parent_id);

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
    }
    public function render(StudentRepositoryInterface $s, GradeRepositoryInterface $g)
    {
        return view('livewire.student.edit', [

            'student' => $s->getById($this->student->id),
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

    // Going back from one step to the next
    public function back($step)
    {
        $this->currentStep = $step;
    }

    //Move to the next step in the edit mode
    public function step2()
    {
        $req = new StudentRequest();
        $this->validate($req->editStep1());
        $this->currentStep = 2;
    }
    //Move to the next step in the edit mode
    public function step3()
    {
        $req = new StudentRequest();
        $this->validate($req->editStep2());
        $this->currentStep = 3;
    }

    #######################################  start update parents  #############################################
    public function finish(StudentRepositoryInterface $s)
    {
        try {
            $student = $s->getById($this->student_id);
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
                'gender' => $this->gender,
                'student_address' => $this->student_address,

            ]);
            toastr()->success(__('Data updated successfully'));
            return redirect($this->route);
        } catch (\Exception $e) {
            $this->currentStep = 1;
            $this->errorMsg = $e->getMessage();
        }
    }

    public function clearMessages()
    {
        $this->successMsg = '';
        $this->errorMsg = '';
    }

    // validation messages
    public function messages()
    {
        $req = new StudentRequest();
        return $req->messages();
    }
}
