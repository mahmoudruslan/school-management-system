<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\repositories\ClassroomRepositoryInterface;
use App\repositories\GradeRepositoryInterface;
use App\repositories\SubjectRepositoryInterface;
use Illuminate\Http\Request;

class SubjectController extends Controller
{

    private $subject;
    public function __construct(SubjectRepositoryInterface $subject)
    {
        $this->subject = $subject;
    }
    public function index()
    {
        $subjects = $this->subject->getData();
        return view('admin_dashboard.pages.subjects.index',compact('subjects'));
    }


    public function create(GradeRepositoryInterface $g, ClassroomRepositoryInterface $c)
    {
        $grades = $g->getData();
        $classrooms = $c->getData();
        return view('admin_dashboard.pages.subjects.create',compact(['grades','classrooms']));
    }


    public function store(Request $request)
    {
            $this->subject->create($request->all());
            return redirect()->route('subjects.index');

    }

    public function edit($id, GradeRepositoryInterface $g, ClassroomRepositoryInterface $c)
    {
        $grades = $g->getData();
        $classrooms = $c->getData();
        $subject = $this->subject->getById($id);
        return view('admin_dashboard.pages.subjects.edit',compact(['classrooms','grades','subject']));
    }


    public function update(Request $request, $id)
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