<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\models\TheParent;

class TheParentsController extends Controller
{

    public function index()
    {
        $parents = TheParent::all();
        return view('pages.parents.index',compact('parents'));
    }
}
