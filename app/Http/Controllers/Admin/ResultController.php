<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\repositories\ResultRepositoryInterface;
use App\repositories\GradeRepositoryInterface;
use App\repositories\StudentRepositoryInterface;
use App\repositories\Eloquent\StudentAccountRepository;
use App\repositories\SubjectRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    private $result;
    public function __construct(ResultRepositoryInterface $result)
    {
        $this->result = $result;
    }

    public function index(GradeRepositoryInterface $g)
    {
        $grades = $g->getData();
        return view('admin_dashboard.pages.results.index1', compact('grades'));
    }

    public function index2($classroom_id)
    {
        $results = $this->result->getData()->where('classroom_id', $classroom_id);
        return view('admin_dashboard.pages.results.index2', compact('results'));
    }


    public function create(GradeRepositoryInterface $g)
    {
        $grades = $g->getData();
        return view('admin_dashboard.pages.results.create', compact(['grades']));
    }


    public function store(Request $request, ResultRepositoryInterface $r)
    {
        foreach (array_keys($request->degree) as $studnet_id) { // in this array key = student_id _ value = degree

            if (
                $r->myModel()->where('subject_id', '=', $request->subject_id)
                ->where('grade_id', '=', $request->grade_id)
                ->where('classroom_id', '=', $request->classroom_id)
                ->where('student_id', '=', $studnet_id)
                ->where('term', '=', $request->term)->count() > 0
            ) {
                toastr()->error(__('These results were previously recorded for these students'));
            } else {
                $this->result->create([
                    'subject_id' => $request->subject_id,
                    'admin_id' => Auth::id(),
                    'grade_id' => $request->grade_id,
                    'classroom_id' => $request->classroom_id,
                    'academic_year' => $request->academic_year,
                    'term' => $request->term,
                    'degree' => $request->degree[$studnet_id],
                    'student_id' => $studnet_id,

                ]);
            }
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        $result = $this->result->getById($id);
        return view('admin_dashboard.pages.results.edit', compact('result'));
    }

    public function create2(Request $request, StudentRepositoryInterface $s, SubjectRepositoryInterface $sub)
    {
        $students = $s->getData(['id', 'name_ar', 'name_en', 'classroom_id', 'grade_id'])->where('classroom_id', $request->classroom_id);
        $subjects = $sub->getData(['id', 'name_ar', 'name_en', 'grade_id', 'classroom_id'])
            ->where('grade_id', $request->grade_id)
            ->where('classroom_id', $request->classroom_id);

        return view('admin_dashboard.pages.results.create2', compact(['students', 'subjects']));
    }

    public function show(
        $student_id,
        ResultRepositoryInterface $r,
        StudentRepositoryInterface $s,
        StudentAccountRepository $s_a,
        SubjectRepositoryInterface $subject,
    ) {

        $student = $s->getById($student_id);

        $student_result = $r->getData()
            ->where('student_id', $student->id)
            ->where('grade_id', $student->grade_id);
        $classrooms = $student_result->unique('classroom_id');
        $total = $subject->myModel()->where('classroom_id',$student->classroom_id)->sum('degree');

        return view('admin_dashboard.pages.students.result', compact(['total', 'student_result', 'classrooms']));
    }

    public function update(Request $request, $id)
    {
        $this->result->update([
            'degree' => $request->degree
        ], $id);
        return redirect()->back();
    }


    public function destroy($id)
    {
        $this->result->destroy($id);
        return redirect()->back();
    }
}
