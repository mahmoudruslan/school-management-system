<?php

namespace App\Http\Livewire;
use App\Http\Requests\TeachersRequest;
use App\Http\Requests\TheParentRequest;
use App\models\TheParent;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\models\BloodType;
use App\models\Nationality;
use App\models\Religion;
use Illuminate\Support\Facades\Hash;
use App\Traits\SaveImgTrait;

class MyParents extends Component
{
    use SaveImgTrait;
    use WithFileUploads;
    public $editMode = false;
    public $currentStep = 1;
    public $addMode = false;
    public $photos = [];
    public $parent_id, $email, $password, $name_father_ar, $name_father_en, $national_id_father,
    $passport_id_father, $phone_father, $job_father_ar, $job_father_en, $blood_Type_father_id,
    $nationality_father_id, $religion_father_id, $address_father, $name_mother_ar, $name_mother_en,
    $national_id_mother, $passport_id_mother, $phone_mother, $job_mother_ar, $job_mother_en,
    $blood_Type_mother_id, $nationality_mother_id, $religion_mother_id, $address_mother;
    public $successMsg = '';
    public $errorMsg = '';

    public function render()
    {
        return view('livewire.my-parents',[
            'my_parents' => TheParent::all(),
            'bloodtypes' => BloodType::all(),
            'nationalitys' => Nationality::all(),
            'religions' => Religion::all()
        ]);
    }
    #######################################  start Add mode  #############################################
    public function Add()
    {
        $this->addMode = true;
        $this->clearForm();
        $this->successMsg = '';
        $this->errorMsg = '';
        $this->currentStep = 1;
    }
    //real time validation
    public function updated($probertyName)
    {
        $req = new TheParentRequest();
        $this->validateOnly($probertyName,$req->realTimeValidation());
    }

// Father data validation
    public function firstStepSubmit()
    {
        $req = new TheParentRequest();
        $this -> validate($req->rules1());

        $this->currentStep = 2;
    }
// Mother data validation
    public function secondStepSubmit()
    {
        $req = new TheParentRequest();
        $this -> validate($req->rules2());

        $this->currentStep = 3;
    }

    // Going back from one step to the next
    public function back($step)
    {
        $this->currentStep = $step;
    }

    // Back to Parents' table
    public function toParentList(){
        $this->editMode = false;
        $this->addMode = false;
    }
    #######################################  start create parents  #############################################
    public function submitForm()
    {
        try{
            $parent = TheParent::create([
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
            $this->saveimg('attachments/TheParents/'.$this->name_father_ar,$parent->id,'App\models\TheParent',$this->photos );
            $this->successMsg = __('Data saved successfully');
            $this->clearForm();
            $this->addMode = false;
        }catch(\Exception $e){
            $this->currentStep = 1;
            $this->errorMsg = $e->getMessage();
        }
    }

    #######################################  start Edit parents  #############################################
    // Fetching the owner's ID number in form
    public function edit($id)
    {
        $this->currentStep = 1;
        $this-> editMode = true;
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
        $req = new TheParentRequest();
        $this -> validate($req->editRule1());
        $this->currentStep = 2;
    }
    //Move to the next step in the edit mode
    public function secondStepSubmitEdit()
    {
        $req = new TheParentRequest();
        $this -> validate($req->rules2());
        $this->currentStep = 3;
    }

    #######################################  start update parents  #############################################
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

            $this->saveimg('attachments/TheParents/'.$this->name_father_ar, $id,'App\models\TheParent',$this->photos);//look trait
        }
        $this->successMsg = __('Data updated successfully');
        $this-> editMode = false;
        }catch(\Exception $e){
            $this->currentStep = 1;
            $this->errorMsg = $e->getMessage();
        }
    }
    #######################################  start delete parents  #############################################

    public function delete($id)
    {
        $my_parent = TheParent::find($id);
        $directory_path = 'attachments/parents/'.$my_parent->name_father_ar;
        if(!$my_parent){
            $this->errorMsg = __('Guardian is not available');
        }else{
           $this->deleteDirectory($directory_path,$id);//lock trait save image
            $my_parent->delete();
            $this->successMsg = __('Data deleted successfully');
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
        $req = new TheParentRequest();
        return $req->messages();

    }
    public function show($id){
        return redirect()->route('Parents.show',$id);

    }
}
