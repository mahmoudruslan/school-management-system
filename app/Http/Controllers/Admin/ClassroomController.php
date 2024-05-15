<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\repositories\Eloquent\ClassroomRepository;
use App\repositories\Eloquent\StudentRepository;
use Illuminate\Http\Request;
use App\repositories\Eloquent\SectionRepository;
use App\repositories\Eloquent\GradeRepository;

class ClassroomController extends Controller
{
    private $classroom;
    public function __construct(ClassroomRepository $classroom)
    {
        $this->classroom = $classroom;
    }
    public function index(GradeRepository $grade)
    {
        $grades = $grade->all([]);
        $classrooms = $this->classroom->all(['grades:id,name_ar,name_en']);
        return view('admin_dashboard.pages.myclassroom.index', compact(['grades', 'classrooms']));
    }

    public function store(Request $request)
    {
        $this->classroom->create($request->all());
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $this->classroom->update($request->all(), $request->id);
        return redirect()->back();
    }

    //Show students
    public function show(Request $request, $classroom_id, StudentRepository $s)
    {
        $students = $s->all([])->where('classroom_id', $classroom_id);
        return view('admin_dashboard.pages.myclassroom.show', compact(['students']));
    }
    public function destroy(Request $request, SectionRepository $sec, StudentRepository $stud)
    {
        $student = $stud->getRelatedStuff('classroom_id', $request->id); //في طلاب عندهم الكلاس رووم اي دي دا؟ تب كم واحد؟
        $sections = $sec->getRelatedStuff('classroom_id', $request->id);
        if (count($sections) > 0 || count($student) > 0) {
            toastr()->error(__("Classroom can't be deleted, there are things about it"));
            return redirect()->back();
        }
        $this->classroom->destroy($request->id);
        return redirect()->back();
    }
}
