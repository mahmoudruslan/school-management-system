<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\repositories\StudentsRepositoryInterface;

class StudentsController extends Controller
{
    private $student;
    public function __construct(StudentsRepositoryInterface $student)
    {
        $this->student = $student;
    }

    public function show($id)
    {
        
        $student = $this->student->getById($id);
        $section_student = $student->sections;
        return view('pages.students.show', compact(['student', 'section_student']));
    }

}
