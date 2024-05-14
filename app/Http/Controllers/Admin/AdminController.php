<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeachersRequest;
use App\Models\Teacher;
use App\Models\Specialization;
use App\repositories\AdminRepositoryInterface;
use App\repositories\RoleRepositoryInterface;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    protected $admin;
    public function __construct(AdminRepositoryInterface $admin)
    {
        $this->admin = $admin;
    }
    
    public function index()
    {
        $admins = $this->admin->all([]);
        return view('admin_dashboard.pages.admins.index', compact('admins'));
    }

    public function create(RoleRepositoryInterface $role)
    {
        $roles = $role->all([]);
        $specializations = Specialization::all();
        return view('admin_dashboard.pages.admins.create', compact('roles','specializations'));
    }

    public function store(TeachersRequest $request)
    {
        $this->admin->create($request->validated());
        return redirect()->route('admins.index');
    }

    public function show($id)
    {
        $admin =  $this->admin->getById($id);
        return view('admin_dashboard.pages.admins.show', compact('admin'));
    }

    public function edit($id, RoleRepositoryInterface $role)
    {
        $specializations = Specialization::all();
        $admin = $this->admin->getById($id);
        $roles = $role->all([],['id','name_ar','name_en']);
        return view('admin_dashboard.pages.admins.edit', compact(['specializations','admin','roles']));
    }

    public function update(TeachersRequest  $request)
    {
        $this->admin->update($request->validated(),$request->id);
        return redirect()->route('admins.index');
    }

    public function destroy(Request $request)
    {
        $this->admin->destroy($request->id);
        return redirect()->back();
    }
}
