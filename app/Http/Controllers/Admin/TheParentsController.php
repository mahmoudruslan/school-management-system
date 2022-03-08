<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\models\TheParent;
use App\Traits\SaveImgTrait;

class TheParentsController extends Controller
{
    use SaveImgTrait;

    public function index()
    {
        return view('pages.parents.my_parents');
    }


    public function show($id)
    {
        $parent = TheParent::find($id);
        return view('pages.parents.show',compact('parent'));
    }


}
