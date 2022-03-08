<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeachersRequest;
use App\models\Admin;
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
        return view('pages.teachers.index', compact('teachers'));
    }


    public function create()
    {
        $specializations = Specialization::all();
        return view('pages.teachers.create', compact('specializations'));
    }


    public function store(TeachersRequest $request)
    {
        $admin = Admin::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'email' => $request->email,
            'password' => $request->password,
            'gender' => $request->gender,
            
        ]);
        $this->teacher->create([
            'phone' => $request->phone,
            'specialization_id' => $request->specialization_id,
            'joining_date' => $request->joining_date,
            'address' => $request->address,
            'admin_id' => $admin->id,
            'religion' => $request->religion
        ]);
        return redirect()->back();
    }


    public function edit($id)
    {

        $specializations = Specialization::all();
        $teacher = $this->teacher->getById($id);
        $admin = Admin::find($teacher->admin_id);
        return view('pages.teachers.edit', compact(['specializations', 'teacher','admin']));
    }


    public function update(TeachersRequest  $request)
    {
        $admin = Admin::find($request->admin_id);
        $admin->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'email' => $request->email,
        ]);
        $this->teacher->update($request->all(), $request->id);
        return redirect()->route('Teachers.index');
    }


    public function destroy(Request $request)
    {
        $this->teacher->destroy($request->id);
        return redirect()->back();
    }
}
