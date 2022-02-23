<?php

namespace App\Http\Controllers\Subjects;

use App\Http\Controllers\Controller;
use App\repositories\Eloquent\ClassroomsRepository;
use App\repositories\Eloquent\GradesRepository;
use App\repositories\Eloquent\SubjectsRepository;
use App\repositories\Eloquent\TeachersRepository;
use Illuminate\Http\Request;

class SubjectController extends Controller
{

    private $subject;
    public function __construct(SubjectsRepository $subject)
    {
        $this->subject = $subject;
    }
    public function index()
    {
        $subjects = $this->subject->getData();
        return view('pages.subjects.index',compact('subjects'));
    }


    public function create(GradesRepository $g, ClassroomsRepository $c, TeachersRepository $t)
    {
        $grades = $g->getData();
        $classrooms = $c->getData();
        $teachers = $t->getData();
        return view('pages.subjects.create',compact(['grades','classrooms','teachers']));
    }


    public function store(Request $request)
    {
        try {
            $this->subject->create($request->all());
            toastr()->success(__('Data saved successfully'));
            return redirect()->back();
        }catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id, GradesRepository $g, ClassroomsRepository $c, TeachersRepository $t)
    {
        $grades = $g->getData();
        $classrooms = $c->getData();
        $teachers = $t->getData();
        $subject = $this->subject->getById($id);
        return view('pages.subjects.edit',compact(['classrooms','grades','subject','teachers']));
    }


    public function update(Request $request, $id)
    {
        try {
            $this->subject->update($request->all(),$id);
            toastr()->success(__('Data updated successfully'));
            return redirect()->route('Subjects.index');
        }catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try {
            $this->subject->destroy($id);
            toastr()->success(__('Data deleted successfully'));
            return redirect()->back();
        }catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }
}