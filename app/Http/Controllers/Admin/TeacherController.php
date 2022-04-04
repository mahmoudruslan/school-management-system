<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeachersRequest;
use App\models\Teacher;
use App\models\Role;
use App\models\Specialization;
use App\repositories\AdminRepositoryInterface;
use App\repositories\RoleRepositoryInterface;
use Illuminate\Http\Request;

class TeacherController extends Controller
{

    protected $admin;
    public function __construct(AdminRepositoryInterface $admin)
    {
        $this->admin = $admin;
    }


    public function index()
    {
        $admins = $this->admin->getData();
        return view('admin_dashboard.pages.teachers.index', compact('admins'));
    }


    public function create(RoleRepositoryInterface $r)
    {
        $roles = $r->getData();
        $specializations = Specialization::all();
        return view('admin_dashboard.pages.teachers.create', compact('roles','specializations'));
    }


    public function store(TeachersRequest $request)
    {
        $admin = $this->admin->create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'email' => $request->email,
            'password' => $request->password,
            'gender' => $request->gender,
            'role_id' => $request->role_id,
            
        ]);
        Teacher::create([
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


    public function edit($id, RoleRepositoryInterface $r)
    {

        $specializations = Specialization::all();
        $admin = $this->admin->getById($id);
        $roles = $r->getData('id','name_ar','name_en');
        return view('admin_dashboard.pages.teachers.edit', compact(['specializations','admin','roles']));
    }


    public function update(TeachersRequest  $request)
    {
        
        $this->admin->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'email' => $request->email,
        ],$request->id);
        $teacher = Teacher::where('admin_id', $request->id)->first();
        $teacher->update($request->all());
        return redirect()->route('teachers.index');
    }


    public function destroy(Request $request)
    {
        $this->admin->destroy($request->id);
        return redirect()->back();
    }
}
