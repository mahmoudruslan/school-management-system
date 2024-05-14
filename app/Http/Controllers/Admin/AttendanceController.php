<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\repositories\AttendanceRepositoryInterface;
use App\repositories\GradeRepositoryInterface;
use App\repositories\AdminRepositoryInterface;
use App\repositories\StudentRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    private $attendance;
    public function __construct(AttendanceRepositoryInterface $attendance)
    {
        $this->attendance = $attendance;
    }

    public function index()
    {
        $attendances = $this->attendance->all(
            ['students:id,name_ar,name_en',
            'grades:id,name_ar,name_en',
            'classrooms:id,name_ar,name_en',
            'sections:id,name_ar,name_en',
            'admin:id,name_ar,name_en' 
        ]);
        return view('admin_dashboard.pages.attendances.index',compact('attendances'));
    }

    public function create(AdminRepositoryInterface $admin,GradeRepositoryInterface $grade)
    {
        $sections = $admin->getById(Auth::id())->sections;
        $grades = $grade->all([]);
        return view('admin_dashboard.pages.attendances.create',compact(['sections','grades']));
    }

    public function store(Request $request)
    {
        if (!empty($request->status)) {
            foreach ($request->student_id as $id) {
                if (array_key_exists($id, $request->status)) {
                    $this->attendance->createOrup(
                        [
                        'student_id' => $id,
                        'date' => date('y-m-d'),
                        'grade_id' => $request->grade_id,
                        'classroom_id' => $request->classroom_id,
                        'section_id' => $request->section_id,
                    ],
                    [
                        'grade_id' => $request->grade_id,
                        'classroom_id' => $request->classroom_id,
                        'section_id' => $request->section_id,
                        'admin_id' => Auth::id(),
                        'student_id' => $id,
                        'date' => date('y-m-d'),
                        'status' => '0'
                    ]);
                }
            }
        }
            return redirect()->back();
    }

    //Show students
    public function show(Request $request,$section_id, StudentRepositoryInterface $student)
    {
        $attendances = $this->attendance->all([]);
        $students = $student->all([])->where('section_id',$section_id);        
        return view('admin_dashboard.pages.attendances.create2',compact(['students', 'section_id','attendances']));
    }

}
