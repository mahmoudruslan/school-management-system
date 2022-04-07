<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\repositories\StudentRepositoryInterface;

class StudentController extends Controller
{
    private $student;
    public function __construct(StudentRepositoryInterface $student)
    {
        $this->student = $student;
    }

    public function index()
    {
        return view('admin_dashboard.pages.students.index');
    }

    public function edit($id){
        return $id;
    }
    public function show($id)
    {
        $student = $this->student->getById($id);
        $section_student = $student->sections;
        return view('admin_dashboard.pages.students.show', compact(['student', 'section_student']));
    }



}
