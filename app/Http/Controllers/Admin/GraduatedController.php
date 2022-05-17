<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\TheParent;
use App\repositories\Eloquent\GradeRepository;
use App\repositories\Eloquent\StudentRepository;
use App\repositories\GraduatedRepositoryInterface;
use App\Http\Requests\GraduatedRequest;
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
        return view('admin_dashboard.pages.graduated.index', compact('students'));
    }

    public function create(GradeRepository $g)
    {
        $grades = $g->getData();
        return view('admin_dashboard.pages.graduated.create', compact(['grades']));
    }

    public function store(GraduatedRequest $request, StudentRepository $s)
    {
        $students = $s->getData()
            ->where('grade_id', $request->grade_id)
            ->where('classroom_id', $request->classroom_id);

        if (count($students) > 0) {
            foreach ($students as $student) {
                $student->delete();
                Attendance::where('student_id', $student->id)->delete();
            }
        }
        return redirect()->route('graduated.index');
    }

    public function show($id)
    {
        $student = $this->student->getById($id);
        return view('admin_dashboard.pages.students.show', compact('student'));
    }

    public function returnStudents(Request $request)
    {
        $ids = explode(",", $request->ids);
        foreach ($ids as $id) {
            $this->student->getById($id)->restore();
            $this->student->update([
                'entry_status' => 0
            ],$id);
            
        }
        return redirect()->route('graduated.index');
    }

    public function destroy(Request $request)
    {
        $ids = explode(",", $request->ids);
        foreach ($ids as $id) {

            $parent_id = $this->student->getById($id)->parent_id;
            $parent = TheParent::find($parent_id);
            $parent->delete();
        }
        toastr()->success(__('Data deleted successfully'));
        return redirect()->back();
    }
}
