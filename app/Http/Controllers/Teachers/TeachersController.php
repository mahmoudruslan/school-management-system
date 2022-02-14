<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeachersRequest;
use App\models\Specialization;
use App\repositories\TeachersRepositoryInterface;
use Illuminate\Http\Request;

class TeachersController extends Controller
{

    protected $teacher;
    public function __construct(TeachersRepositoryInterface $teacher)
    {
        $this->teacher = $teacher;
    }


    public function index()
    {
        $teachers = $this->teacher->getData();
        return view('pages.teachers.index',compact('teachers'));
    }


    public function create()
    {
        $specializations = Specialization::all();
        return view('pages.teachers.create',compact('specializations'));
    }


    public function store(TeachersRequest $request)
    {
        try {
            $this->teacher->create($request->all());
            toastr()->success(__('Data saved successfully'));
            return redirect()->back();

        }catch (\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }


    public function edit($id)
    {

        $specializations = Specialization::all();
        $teacher = $this->teacher->getById($id);
        return view('pages.teachers.edit',compact(['specializations','teacher']));
    }


    public function update(TeachersRequest  $request)
    {
        try {
            $this->teacher->update($request->only('name_ar', 'name_en', 'email' , 'password', 'specialization_id',
                'joining_date', 'address'),$request->id);
            toastr()->success(__('Data updated successfully'));
            return redirect()->route('Teachers.index');
        }catch (\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }


    public function destroy(Request $request)
    {
        try {
            $this->teacher->destroy($request->id);
            toastr()->success(__('Data deleted successfully'));
            return redirect()->back();
        }catch (\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }
}
