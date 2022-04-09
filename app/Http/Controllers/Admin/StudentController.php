<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\models\TheParent;
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
        $students = $this->student->getData();
        return view('admin_dashboard.pages.students.index',compact('students'));
    }

    public function create()
    {

        //$student = $this->student->getById($id);
        return view('admin_dashboard.pages.students.create');
    }

    public function edit($id)
    {

        $student = $this->student->getById($id);
        return view('admin_dashboard.pages.students.edit', compact(['student']));
    }
    public function show($id)
    {
        $student = $this->student->getById($id);
        $section_student = $student->sections;
        return view('admin_dashboard.pages.students.show', compact(['student', 'section_student']));
    }

    public function destroy($id)
    {
        $student = $this->student->getById($id);
        $student->delete();
        toastr()->success(__('Data deleted successfully'));
        return redirect()->back();
    }
}
