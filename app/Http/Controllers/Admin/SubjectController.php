<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\models\Subject;
use App\repositories\Eloquent\ClassroomsRepository;
use App\repositories\Eloquent\GradesRepository;
use App\repositories\Eloquent\TeachersRepository;
use App\repositories\SubjectsRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SubjectController extends Controller
{

    private $subject;
    public function __construct(SubjectsRepositoryInterface $subject)
    {
        $this->subject = $subject;
    }
    public function index()
    {
        $subjects = $this->subject->getData();
        return view('admin_dashboard.pages.subjects.index',compact('subjects'));
    }


    public function create(GradesRepository $g, ClassroomsRepository $c, TeachersRepository $t)
    {
        $grades = $g->getData();
        $classrooms = $c->getData();
        $teachers = $t->getData();
        return view('admin_dashboard.pages.subjects.create',compact(['grades','classrooms','teachers']));
    }


    public function store(Request $request)
    {
            $this->subject->create($request->all());
            return redirect()->route('subjects.index');

    }

    public function edit($id, GradesRepository $g, ClassroomsRepository $c, TeachersRepository $t)
    {
        $grades = $g->getData();
        $classrooms = $c->getData();
        $teachers = $t->getData();
        $subject = $this->subject->getById($id);
        return view('admin_dashboard.pages.subjects.edit',compact(['classrooms','grades','subject','teachers']));
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