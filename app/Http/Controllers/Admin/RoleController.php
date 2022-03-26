<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin_dashboard.pages.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin_dashboard.pages.roles.create');
    }

    public function store(Request $request)
    {
        Role::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'permissions' => $request->permissions
        ]);

        toastr()->success(__('Data saved successfully'));
        return redirect()->route('roles.index');
    }

    public function edit($id)
    {
        $role = Role::find($id);
        return view('admin_dashboard.pages.roles.edit',['role' => $role]);
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'permissions' => $request->permissions
        ]);

        toastr()->success(__('Data updated successfully'));
        return redirect()->route('roles.index');
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        toastr()->success(__('Data deleted successfully'));
        return redirect()->route('roles.index');
    }
}
