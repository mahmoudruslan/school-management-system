<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Specialization;
use App\repositories\Eloquent\AdminRepository;
use App\repositories\Eloquent\RoleRepository;
use Illuminate\Http\Request;



class AdminController extends Controller
{

    protected $admin;
    public function __construct(AdminRepository $admin)
    {
        $this->admin = $admin;
    }

    public function index()
    {
        $admins = $this->admin->all([])->except(auth()->user()->id);
        return view('admin_dashboard.pages.admins.index', compact('admins'));
    }

    public function create(RoleRepository $role)
    {
        $roles = $role->all([]);
        $specializations = Specialization::all();
        return view('admin_dashboard.pages.admins.create', compact('roles','specializations'));
    }

    public function store(AdminRequest $request)
    {
        $this->admin->create($request->validated());
        return redirect()->route('admins.index');
    }

    public function show($id)
    {
        $admin =  $this->admin->getById($id);
        return view('admin_dashboard.pages.admins.show', compact('admin'));
    }

    public function edit($id, RoleRepository $role)
    {
        $specializations = Specialization::all();
        $admin = $this->admin->getById($id);
        $roles = $role->all([],['id','name_ar','name_en']);
        return view('admin_dashboard.pages.admins.edit', compact(['specializations','admin','roles']));
    }

    public function update(AdminRequest  $request)
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
