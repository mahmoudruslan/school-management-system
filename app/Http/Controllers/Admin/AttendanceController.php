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
        $attendances = $this->attendance->getData();
        return view('admin_dashboard.pages.attendances.index',compact('attendances'));
    }


    public function create(AdminRepositoryInterface $a,GradeRepositoryInterface $g)
    {
        $sections = $a->getById(Auth::id())->sections;
        $grades = $g->getData();
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
    public function show(Request $request,$section_id, StudentRepositoryInterface $s)
    {
        $attendances = $this->attendance->getData();
        $students = $s->getData()->where('section_id',$section_id);        
        return view('admin_dashboard.pages.attendances.create2',compact(['students', 'section_id','attendances']));
    }

}
