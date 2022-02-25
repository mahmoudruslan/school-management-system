<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\models\Attendance;
use App\repositories\Eloquent\GradesRepository;
use App\repositories\Eloquent\StudentsRepository;
use App\repositories\GraduatedRepositoryInterface;
use Illuminate\Http\Request;

class GraduatedController extends Controller
{
    private $student;
    public function __construct(GraduatedRepositoryInterface $student)
    {
        $this->student = $student;
    }


    public function index()
    {
        $students = $this->student->getData();
        return view('pages.students.graduated.index', compact('students'));
    }

    public function create(GradesRepository $g)
    {
        $grades = $g->getData();
        return view('pages.students.graduated.create', compact(['grades']));
    }

    public function store(Request $request, StudentsRepository $s)
    {
        $students = $s->getData()
            ->where('grade_id', $request->grade_id)
            ->where('classroom_id', $request->classroom_id)
            ->where('section_id', $request->section_id);

        if (count($students) > 0) {
            foreach ($students as $student) {
                $student->delete();
                Attendance::where('student_id', $student->id)->delete();
            }
        }
        return redirect()->route('Graduated.index');
    }

    public function show($id)
    {
        $student = $this->student->getById($id);
        return view('pages.students.graduated.show', compact('student'));
    }

    public function returnStudents(Request $request)
    {
        $ids = explode(",", $request->ids);
        foreach ($ids as $id) {
            $this->student->getById($id)->restore();
        }
        return redirect()->route('Graduated.index');
    }

    public function destroy(Request $request)
    {
        $ids = explode(",", $request->ids);
        foreach ($ids as $id) {
            $this->student->destroy($id);
        }
        return redirect()->back();
    }
}
