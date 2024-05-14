<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\repositories\Eloquent\GradeRepository;
use App\repositories\Eloquent\StudentRepository;
use App\repositories\GraduatedRepositoryInterface;
use App\Http\Requests\GraduatedRequest;
use Illuminate\Http\Request;

class GraduatedController extends Controller
{
    private $student_graduated;
    public function __construct(GraduatedRepositoryInterface $student_graduated)
    {
        $this->student_graduated = $student_graduated;
    }


    public function index()
    {
        $students = $this->student_graduated->all(['grade', 'classroom', 'section']);
        return view('admin_dashboard.pages.graduated.index', compact('students'));
    }

    public function create(GradeRepository $grade)
    {
        $grades = $grade->all([]);
        return view('admin_dashboard.pages.graduated.create', compact(['grades']));
    }

    public function store(GraduatedRequest $request, StudentRepository $student)
    {
        $students = $student->all([])
            ->where('grade_id', $request->grade_id)
            ->where('classroom_id', $request->classroom_id);

        if (count($students) > 0) {
            foreach ($students as $student) {
                $student->delete();
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
            $this->student_graduated->getById($id)->restore();
            $this->student_graduated->update([
                'entry_status' => 0
            ],$id);
            
        }
        return redirect()->route('graduated.index');
    }

    public function destroy(Request $request)
    {
        $ids = explode(",", $request->ids);
        foreach ($ids as $id) {

            $this->student_graduated->destroy($id);
        }
        toastr()->success(__('Data deleted successfully'));
        return redirect()->back();
    }
}
