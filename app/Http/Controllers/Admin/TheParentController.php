<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\TheParent;

class TheParentController extends Controller
{

    public function index()
    {
        $parents = TheParent::with('nationality')->get();
        return view('admin_dashboard.pages.parents.index',compact('parents'));
    }
}
