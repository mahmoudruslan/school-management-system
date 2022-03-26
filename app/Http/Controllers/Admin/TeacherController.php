<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeachersRequest;
use App\models\Admin;
use App\models\Role;
use App\models\Specialization;
use App\repositories\TeachersRepositoryInterface;
use Illuminate\Http\Request;

class TeacherController extends Controller
{

    protected $teacher;
    public function __construct(TeachersRepositoryInterface $teacher)
    {
        $this->teacher = $teacher;
    }


    public function index()
    {
        $teachers = $this->teacher->getData();
        return view('admin_dashboard.pages.teachers.index', compact('teachers'));
    }


    public function create()
    {
        $roles = Role::all();
        $specializations = Specialization::all();
        return view('admin_dashboard.pages.teachers.create', compact('roles','specializations'));
    }


    public function store(TeachersRequest $request)
    {
        $admin = Admin::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'email' => $request->email,
            'password' => $request->password,
            'gender' => $request->gender,
            'role_id' => $request->role_id,
            
        ]);
        $this->teacher->create([
            'phone' => $request->phone,
            'specialization_id' => $request->specialization_id,
            'joining_date' => $request->joining_date,
            'address' => $request->address,
            'admin_id' => $admin->id,
            'religion' => $request->religion,
            'note' => $request->note
        ]);
        return redirect()->back();
    }


    public function edit($id)
    {

        $specializations = Specialization::all();
        $teacher = $this->teacher->getById($id);
        $admin = Admin::find($teacher->admin_id);
        return view('admin_dashboard.admin_dashboard.pages.teachers.edit', compact(['specializations', 'teacher','admin']));
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
        return redirect()->route('teachers.index');
    }


    public function destroy(Request $request)
    {
        $this->teacher->destroy($request->id);
        return redirect()->back();
    }
}
