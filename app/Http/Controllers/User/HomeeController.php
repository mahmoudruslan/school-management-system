<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeeController extends Controller
{
    public function student()
    {
        return view('student_dashboard.student');
    }

    public function create()
    {
        return view('admin_dashboard.pages.students.index');
    }
}
