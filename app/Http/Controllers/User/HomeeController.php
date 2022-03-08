<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeeController extends Controller
{
    public function student()
    {
        return view('dashboards.students.student');
    }
}
