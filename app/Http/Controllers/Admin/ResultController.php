<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\repositories\Eloquent\ResultRepository;
use App\repositories\Eloquent\GradeRepository;
use App\repositories\Eloquent\StudentRepository;
use App\repositories\Eloquent\StudentAccountRepository;
use App\repositories\Eloquent\SubjectRepository;
use App\Http\Requests\ResultRequest;
use App\repositories\Eloquent\ClassroomRepository;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    private $result;
    private $grade;
    private $classroom;
    private $subject;
    private $student;
    public function __construct(ResultRepository $result,GradeRepository $grade,
        ClassroomRepository $classroom, SubjectRepository $subject, StudentRepository $student) 
        {
            $this->result = $result;
            $this->grade = $grade;
            $this->classroom = $classroom;
            $this->subject = $subject;
            $this->student = $student;
        }

    public function index()//choose grade and classroom
    {
        return true;
        $grades = $this->grade->all([]);
        return view('admin_dashboard.pages.results.grades_classrooms_filter_to_show', compact('grades'));
    }

    //filtered students table
    public function gradeAndClassroomStudents($classroom_id)
    {
        $results = $this->result->all(['grade', 'classroom','student:id,name_ar,name_en', 'admin:id,name_ar,name_en', 'subject'])//relationships
        ->where('classroom_id', $classroom_id);
        return view('admin_dashboard.pages.results.grade_classroom_students', compact('results'));
    }

    //choose grade and classroom
    public function gradesClassroomsFilter()
    {
        $grades = $this->grade->all([]);
        return view('admin_dashboard.pages.results.graders_classrooms_filter_to_create', compact(['grades']));
    }

    //choose subject and term
    public function subjectTimeFilter(Request $request)
    {
        $grade = $this->grade->getById($request->grade_id);
        $classroom = $this->classroom->getById($request->classroom_id);
        $subjects = $this->subject->all([], ['id', 'name_ar', 'name_en', 'grade_id', 'classroom_id'])
            ->where('grade_id', $request->grade_id)
            ->where('classroom_id', $request->classroom_id);

        return view('admin_dashboard.pages.results.subject_time_filter_to_create', compact(['grade', 'classroom', 'subjects']));
    }
    //show filtered students and giving degree
    public function givingDegrees(ResultRequest $request)
    {
        $data['academic_year'] = $request->academic_year;
        $data['term'] = $request->term;
        $data['grade'] = $this->grade->getById($request->grade_id);
        $data['classroom'] = $this->classroom->getById($request->classroom_id);
        $data['subject'] = $this->subject->getById($request->subject_id);
        // get the student’s result if he had this result before in this grade, classroom, term, subject and academic year 
        //=> to we show degree and hide degree "input tag"
        $students = $this->student->all(['results' => function ($query) use ($data) {
            $query->Where('subject_id', $data['subject']['id'])
                ->where('term', $data['term'])
                ->where('academic_year', $data['academic_year'])
                ->where('grade_id', $data['grade']['id'])
                ->where('classroom_id', $data['classroom']['id']);
        }])->where('classroom_id', $request->classroom_id)
            ->where('grade_id', $request->grade_id);
        return view('admin_dashboard.pages.results.giving_degrees', compact(['students', 'data']));
    }

    public function store(Request $request)
    {
        foreach ($request->degree as $student_id => $degree) { // in this array key = student_id _ value = degree
            if ($degree == null) {
                continue;
            }
            $this->result->create([//insert data in results table
                'subject_id' => $request->subject_id,
                'admin_id' => Auth::id(),
                'grade_id' => $request->grade_id,
                'classroom_id' => $request->classroom_id,
                'academic_year' => $request->academic_year,
                'term' => $request->term,
                'degree' => $degree,
                'student_id' => $student_id
            ]);
        }
        return redirect()->route('results.index');
    }

    public function edit($id)
    {
        $result = $this->result->getById($id);
        return view('admin_dashboard.pages.results.edit', compact('result'));
    }

    public function show($student_id, StudentAccountRepository $s_a)
    {
        $student = $this->student->getById($student_id);
        $student_results = $this->result->all([])
            ->where('student_id', $student->id);
            
        $results_classrooms = $student_results->unique('classroom_id'); //get classroom names without repetition
        $results_grades = $student_results->unique('grade_id'); //get grade names without repetition
        // return $results_grades;
        $total = $this->subject->myModel()->where('classroom_id', $student->classroom_id)->sum('degree');
        return view('admin_dashboard.pages.students.result', compact(['total', 'student_results', 'results_classrooms', 'results_grades']));
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
