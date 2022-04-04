<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\models\Role;
use App\repositories\RoleRepositoryInterface;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $role;
    public function __construct(RoleRepositoryInterface $role)
    {
        $this->role = $role;
    }
    public function index()
    {
        $roles = $this->role->getData();
        return view('admin_dashboard.pages.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin_dashboard.pages.roles.create');
    }

    public function store(Request $request)
    {
        $this->role->create($request->all());
        return redirect()->route('roles.index');
    }

    public function edit($id)
    {
        $role = $this->role->getById($id);
        return view('admin_dashboard.pages.roles.edit',['role' => $role]);
    }

    public function update(Request $request, $id)
    {
        $this->role->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'permissions' => $request->permissions
        ],$id);

        return redirect()->route('roles.index');
    }

    public function destroy($id)
    {
        $this->role->destroy($id);
        return redirect()->route('roles.index');
    }
}
