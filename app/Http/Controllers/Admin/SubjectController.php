<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\repositories\Eloquent\ClassroomRepository;
use App\repositories\Eloquent\GradeRepository;
use App\repositories\Eloquent\SubjectRepository;
use App\Http\Requests\SubjectRequest;

class SubjectController extends Controller
{
    private $subject;
    public function __construct(SubjectRepository $subject)
    {
        $this->subject = $subject;
    }
    public function index()
    {
        $subjects = $this->subject->all(['grades', 'classrooms']);
        return view('admin_dashboard.pages.subjects.index',compact('subjects'));
    }


    public function create(GradeRepository $grade, ClassroomRepository $classroom)
    {
        $grades = $grade->all([]);
        $classrooms = $classroom->all([]);
        return view('admin_dashboard.pages.subjects.create',compact(['grades','classrooms']));
    }


    public function store(SubjectRequest $request)
    {
            $this->subject->create($request->all());
            return redirect()->route('subjects.index');
    }

    public function edit($id, GradeRepository $grade, ClassroomRepository $classroom)
    {
        $grades = $grade->all([]);
        $classrooms = $classroom->all([]);
        $subject = $this->subject->getById($id);
        return view('admin_dashboard.pages.subjects.edit',compact(['classrooms','grades','subject']));
    }

    public function update(SubjectRequest $request, $id)
    {
            $this->subject->update($request->all(),$id);
            return redirect()->route('subjects.index');
    }

    public function destroy($id)
    {
        $this->subject->destroy($id);
        return redirect()->back();
    }
}