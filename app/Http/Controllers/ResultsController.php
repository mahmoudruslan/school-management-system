<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\repositories\ResultsRepositoryInterface;
use App\repositories\GradesRepositoryInterface;
use App\repositories\StudentsRepositoryInterface;
use App\repositories\Eloquent\StudentAccountsRepository;
use App\repositories\SubjectsRepositoryInterface;

class ResultsController extends Controller
{
    private $result;
    public function __construct(ResultsRepositoryInterface $result)
    {
        $this->result = $result;
    }

    public function index1(GradesRepositoryInterface $g)
    {
        //$results = $this->result->getData();
        $grades = $g->getData();
        return view('pages.results.index1', compact('grades'));
    }

    public function index2($classroom_id)
    {
        $results = $this->result->getData()->where('classroom_id', $classroom_id);
        return view('pages.results.index2', compact('results'));
    }


    public function create1(GradesRepositoryInterface $g, $teacher_id)
    {
        $grades = $g->getData();
        return view('pages.results.create', compact(['grades', 'teacher_id']));
    }


    public function store(Request $request, ResultsRepositoryInterface $r)
    {
        try {
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
                        'teacher_id' => $request->teacher_id,
                        'grade_id' => $request->grade_id,
                        'classroom_id' => $request->classroom_id,
                        'academic_year' => $request->academic_year,
                        'term' => $request->term,
                        'from' => $request->from,
                        'degree' => $request->degree[$studnet_id],
                        'student_id' => $studnet_id,

                    ]);
                }
            }
            toastr()->success(__('Data saved successfully'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $result = $this->result->getById($id);
        return view('pages.results.edit', compact('result'));
    }

    public function create2(Request $request, StudentsRepositoryInterface $s, SubjectsRepositoryInterface $sub)
    {
        $students = $s->getData(['id', 'name_ar', 'name_en', 'classroom_id', 'grade_id'])->where('classroom_id', $request->classroom_id);
        $subjects = $sub->getData(['id', 'name_ar', 'name_en', 'grade_id', 'classroom_id'])
            ->where('grade_id', $request->grade_id)
            ->where('classroom_id', $request->classroom_id);
        $teacher_id = $request->teacher_id;

        return view('pages.results.create2', compact(['students', 'subjects', 'teacher_id']));
    }

    public function show($student_id, ResultsRepositoryInterface $r, StudentsRepositoryInterface $s, StudentAccountsRepository $s_a)
    {
        $credit = $s_a->myModel()->where('student_id', $student_id)->select('credit')->sum('credit');
        $debit = $s_a->myModel()->where('student_id', $student_id)->select('debit')->sum('debit');

        $student = $s->getById($student_id);
        $student_result = $r->getData()
            ->where('student_id', $student->id)
            ->where('grade_id', $student->grade_id);
        $classrooms = $student_result->unique('classroom_id');

        return view('pages.students.result', compact(['student_result', 'classrooms', 'credit', 'debit']));
    }

    public function update(Request $request, $id)
    {
        try {
            $this->result->update([
                'degree' => $request->degree
            ], $id);
            toastr()->success(__('Data updated successfully'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try {
            $this->result->destroy($id);
            toastr()->success(__('Data deleted successfully'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
