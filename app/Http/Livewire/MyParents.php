<?php

namespace App\Http\Livewire;

use App\models\TheParent;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\models\BloodType;
use App\models\Nationality;
use App\models\ParentsAttachments;
use App\models\Religion;
use Illuminate\Support\Facades\Hash;
use App\Traits\SaveImgTrait;
use Illuminate\Support\Facades\Storage;

class MyParents extends Component
{
    use SaveImgTrait;
    use WithFileUploads;
    public $parent_id;
    public $moodedit = false;
    public $currentStep = 1;
    public $addMood = false;
    public $photos = [];
    public

    $email,
    $password,
    $name_father_ar,
    $name_father_en,
    $national_id_father,
    $passport_id_father,
    $phone_father,
    $job_father_ar,
    $job_father_en,
    $blood_Type_father_id,
    $nationality_father_id,
    $religion_father_id,
    $address_father,
    $name_mother_ar,
    $name_mother_en,
    $national_id_mother,
    $passport_id_mother,
    $phone_mother,
    $job_mother_ar,
    $job_mother_en,
    $blood_Type_mother_id,
    $nationality_mother_id,
    $religion_mother_id,
    $address_mother;

    public $successMsgEdit = '';
    public $errorMsgEdit = '';

    public $successMsg = '';
    public $errorMsg = '';

    public function render()
    {
        return view('livewire.my-parents',[
            'my_parents' => TheParent::get(),
            'bloodtypes' => BloodType::all(),
            'nationalitys' => Nationality::all(),
            'religions' => Religion::all()
        ]);
    }
    #######################################  start Add parents  #############################################
    public function Add()
    {
        $this->addMood = true;
        $this->clearForm();
        $this->successMsg = '';
        $this->errorMsg = '';
        $this->currentStep = 1;

    }
    //real time validation
    public function updated($probertyName)
    {
        $this->validateOnly($probertyName,[
        'email'=> 'required|email|unique:the_parents',
        'password'=> 'required|max:8',

        'national_id_father'=> 'required|string|min:10|max:10|regex:/[0-9]{9}/',
        'passport_id_father'=> 'min:10|max:10',
        'phone_father'=> 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',


        'national_id_mother'=> 'required|string|min:10|max:10|regex:/[0-9]{9}/',
        'passport_id_mother'=> 'min:10|max:10',
        'phone_mother'=> 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',

        ]);


    }

    public function firstStepSubmit()
    {
        // Father data validation
        $this -> validate([
            'email'=> 'required|email|unique:the_parents',
            'password'=> 'required|max:8',
            'name_father_ar'=> 'required|max:100',
            'name_father_en'=> 'required|max:100',

            'national_id_father'=> 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'passport_id_father'=> 'min:10|max:10',
            'phone_father'=> 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',

            'job_father_ar'=> 'required|max:50',
            'job_father_en'=> 'required|max:50',
            'blood_Type_father_id'=> 'required',
            'nationality_father_id'=> 'required',
            'religion_father_id'=> 'required',
            'address_father'=> 'required|max:200',
        ]);
        $this->currentStep = 2;

    }

    public function secondStepSubmit()
    {
        // Mother data validation
        $this->validate([
            'name_mother_ar'=> 'required|max:100',
            'name_mother_en'=> 'required|max:100',
            'national_id_mother'=> 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'passport_id_mother'=> 'min:10|max:10',
            'phone_mother'=> 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'job_mother_ar'=> 'required|max:50',
            'job_mother_en'=> 'required|max:50',
            'blood_Type_mother_id'=> 'required',
            'nationality_mother_id'=> 'required',
            'religion_mother_id'=> 'required',
            'address_mother'=> 'required||max:200',
        ]);

        $this->currentStep = 3;
    }
    // Going back from one step to the next
    public function back($step)
    {
        $this->currentStep = $step;
    }
    // Back to Parents' table
    public function toParentList(){
        $this->moodedit = false;
        $this->addMood = false;
    }


    // create
    public function submitForm()
    {
        try{
            TheParent::create([

                'email'=> $this->email,
                'password'=> Hash::make($this->password),
                'name_father_ar'=> $this->name_father_ar,
                'name_father_en'=> $this->name_father_en,
                'national_id_father'=> $this->national_id_father,
                'passport_id_father'=> $this->passport_id_father,
                'phone_father'=> $this->phone_father,
                'job_father_ar'=> $this->job_father_ar,
                'job_father_en'=> $this->job_father_en,
                'blood_Type_father_id'=> $this->blood_Type_father_id,
                'nationality_father_id'=> $this->nationality_father_id,
                'religion_father_id'=> $this->religion_father_id,
                'address_father'=> $this-> address_father,
                'name_mother_ar'=> $this-> name_mother_ar,
                'name_mother_en'=> $this-> name_mother_en,
                'national_id_mother'=> $this-> national_id_mother,
                'passport_id_mother'=> $this-> passport_id_mother,
                'phone_mother'=> $this-> phone_mother,
                'job_mother_ar'=> $this-> job_mother_ar,
                'job_mother_en'=> $this-> job_mother_en,
                'blood_Type_mother_id'=> $this-> blood_Type_mother_id,
                'nationality_mother_id'=> $this-> nationality_mother_id,
                'religion_mother_id'=> $this-> religion_mother_id,
                'address_mother' => $this-> address_mother
            ]);
            $P_id = TheParent::where('national_id_father', $this->national_id_father)->select('id')->get();

            if (!empty($this->photos)) {//Check if the parent has attachments
                foreach($this->photos as $photo){//To store more than one attachment
                    $name_photo = $this->saveimg($photo,$this->phone_father,'parent_attachments');
                    ParentsAttachments::create([
                    'photos'=>  $name_photo,
                    'parents_id'=> $P_id[0]->id,
                    ]);
                }
            }
            $this->successMsg = __('messages.success');
            $this->clearForm();

            $this->currentStep = 1;
        }catch(Exception $e){
            $this->currentStep = 1;
            $this->errorMsg = $e->getMessage();
        }

    }
    #######################################  end Add parents  #############################################

    #######################################  start Edit parents  #############################################
    // Fetching the owner's ID number in form
    public function edit($id)
    {
        $this->currentStep = 1;
        $this-> moodedit = true;
        
        $this->parent_id = $id;
        $parents = TheParent::find($id);
        $this->email = $parents->email;
        $this->password = $parents->password;
        $this->name_father_ar = $parents->name_father_ar;
        $this->name_father_en = $parents->name_father_en;
        $this->national_id_father = $parents->national_id_father;
        $this->passport_id_father = $parents->passport_id_father;
        $this->phone_father = $parents->phone_father;
        $this->job_father_ar = $parents->job_father_ar;
        $this->job_father_en = $parents->job_father_en;
        $this->blood_Type_father_id = $parents->blood_Type_father_id;
        $this->nationality_father_id = $parents->nationality_father_id;
        $this->religion_father_id = $parents->religion_father_id;
        $this-> address_father = $parents->address_father;
        $this-> name_mother_ar = $parents->name_mother_ar;
        $this-> name_mother_en = $parents->name_mother_en;
        $this-> national_id_mother = $parents->national_id_mother;
        $this-> passport_id_mother = $parents->passport_id_mother;
        $this-> phone_mother = $parents->phone_mother;
        $this-> job_mother_ar = $parents->job_mother_ar;
        $this-> job_mother_en = $parents->job_mother_en;
        $this-> blood_Type_mother_id = $parents->blood_Type_mother_id;
        $this-> nationality_mother_id = $parents->nationality_mother_id;
        $this-> religion_mother_id = $parents->religion_mother_id;
        $this-> address_mother = $parents->address_mother;
        $this-> address_mother = $parents->address_mother;
    }
    //Move to the next step in the edit mode
    public function firstStepSubmitEdit(){
        $this->currentStep = 2;
    }
    //Move to the next step in the edit mode
    public function secondStepSubmitEdit()
    {
        $this->currentStep = 3;
    }

    // Edit
    public function submitFormEdit($id)
    {
        try{
        $parents = TheParent::find($id);

        $parents->update([
            'email'=> $this->email,
            'password'=> $this->password,
            'name_father_ar'=> $this->name_father_ar,
            'name_father_en'=> $this->name_father_en,
            'national_id_father'=> $this->national_id_father,
            'passport_id_father'=> $this->passport_id_father,
            'phone_father'=> $this->phone_father,
            'job_father_ar'=> $this->job_father_ar,
            'job_father_en'=> $this->job_father_en,
            'blood_Type_father_id'=> $this->blood_Type_father_id,
            'nationality_father_id'=> $this->nationality_father_id,
            'religion_father_id'=> $this->religion_father_id,
            'address_father'=> $this-> address_father,
            'name_mother_ar'=> $this-> name_mother_ar,
            'name_mother_en'=> $this-> name_mother_en,
            'national_id_mother'=> $this-> national_id_mother,
            'passport_id_mother'=> $this-> passport_id_mother,
            'phone_mother'=> $this-> phone_mother,
            'job_mother_ar'=> $this-> job_mother_ar,
            'job_mother_en'=> $this-> job_mother_en,
            'blood_Type_mother_id'=> $this-> blood_Type_mother_id,
            'nationality_mother_id'=> $this-> nationality_mother_id,
            'religion_mother_id'=> $this-> religion_mother_id,
            'address_mother' => $this-> address_mother
        ]);
        if (!empty($this->photos)) {//Check if the parent has attachments
            foreach($this->photos as $photo){//To store more than one attachment
                $name_photo = $this->saveimg($photo,$this->phone_father,'parent_attachments');//look trait
                ParentsAttachments::create([
                'photos'=>  $name_photo,
                'parents_id'=> $id,
                ]);
            }
        }
        $this->successMsgEdit = __('messages.success_edit');
        $this-> moodedit = false;
        }catch(Exception $e){
            $this->currentStep = 1;
            $this->errorMsgEdit = $e->getMessage();
        }
    }
    #######################################  end Edit parents  #############################################



    public function delete($id)
    {
        $my_parent = TheParent::find($id);
        $namefolder = $my_parent->phone_father;
        

        if(!$my_parent){
            $this->errorMsg = 'غير موجود';
        }else{
            $directory = 'parent_attachments/'.$namefolder;
            if(isset($directory)){
                Storage::deleteDirectory($directory);
            }

            $my_parent->delete();
            $this->successMsg = __('messages.success_delete');




            
        }
        


    }

    public function clearMessages()
    {
        $this->successMsgEdit = '';
        $this->errorMsgEdit = '';
        $this->successMsg = '';
        $this->errorMsg = '';
    }

    // remove inputs content after add parent
    public function clearForm()
    {
        $this->email = '';
        $this->password = '';
        $this->name_father_ar = '';
        $this->name_father_en = '';
        $this->national_id_father = '';
        $this->passport_id_father = '';
        $this->phone_father = '';
        $this->job_father_ar = '';
        $this->job_father_en = '';
        $this->blood_Type_father_id = '';
        $this->nationality_father_id = '';
        $this->religion_father_id = '';
        $this-> address_father = '';

        $this-> name_mother_ar = '';
        $this-> name_mother_en = '';
        $this-> national_id_mother = '';
        $this-> passport_id_mother = '';
        $this-> phone_mother = '';
        $this-> job_mother_ar = '';
        $this-> job_mother_en = '';
        $this-> blood_Type_mother_id = '';
        $this-> nationality_mother_id = '';
        $this-> religion_mother_id = '';
        $this-> address_mother = '';
    }
    // validation messages
    public function messages() {


        return [
            'email.required' => __('messages.This field is required'),
            'email.email' => __('messages.This field must be an email'),
            'name_father_ar.required' => __('messages.This field is required'),
            'name_father_ar.max' => __('messages.This is field must be no more than 100 characters'),
            'name_father_en.required' => __('messages.This field is required'),
            'name_father_en.max' => __('messages.This is field must be no more than 100 characters'),
            'name_mother_ar.required' => __('messages.This field is required'),
            'name_mother_ar.max' => __('messages.This is field must be no more than 100 characters'),
            'name_mother_en.required' => __('messages.This field is required'),
            'name_mother_en.max' => __('messages.This is field must be no more than 100 characters'),
            'password.required' => __('messages.This field is required'),
            'password.max' => __('messages.This is field must be no more than 8 characters'),



            'national_id_father.required' => __('messages.This field is required'),
            'national_id_father.regex' => __('messages.The format is invalid.'),
            'national_id_mother.required' => __('messages.This field is required'),
            'national_id_mother.regex' => __('messages.The format is invalid.'),


            'job_father_ar.required' => __('messages.This field is required'),
            'job_father_ar.max' => __('messages.This is field must be no more than 50 characters'),
            'job_father_en.required' => __('messages.This field is required'),
            'job_father_en.max' => __('messages.This is field must be no more than 50 characters'),

            'job_mother_ar.required' => __('messages.This field is required'),
            'job_mother_ar.max' => __('messages.This is field must be no more than 50 characters'),
            'job_mother_en.required' => __('messages.This field is required'),
            'job_mother_en.max' => __('messages.This is field must be no more than 50 characters'),

            'religion_father_id.required' => __('messages.This field is required'),
            'religion_mother_id.required' => __('messages.This field is required'),
            'blood_Type_father_id.required' => __('messages.This field is required'),
            'blood_Type_mother_id.required' => __('messages.This field is required'),
            'nationality_father_id.required' => __('messages.This field is required'),
            'nationality_mother_id.required' => __('messages.This field is required'),
            'passport_id_father.required' => __('messages.This field is required'),
            'passport_id_father.numeric' => __('messages.It must be numbers'),
            'passport_id_mother.required' => __('messages.This field is required'),
            'passport_id_mother.numeric' => __('messages.It must be numbers'),
            'phone_father.required' => __('messages.This field is required'),
            'phone_father.regex' => __('messages.The format is invalid.'),
            'phone_mother.required' => __('messages.This field is required'),
            'phone_mother.regex' => __('messages.The format is invalid.'),


            'address_father.required' => __('messages.This field is required'),
            'address_father.max' => __('messages.This is field must be no more than 200 characters'),
            'address_mother.required' => __('messages.This field is required'),
            'address_mother.max' => __('messages.This is field must be no more than 200 characters'),


        ];

    }




























}
