<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\TheParent;

class TheParentController extends Controller
{

    public function index()
    {
        $parents = TheParent::all();
        return view('admin_dashboard.pages.parents.index',compact('parents'));
    }
}
