<?php

namespace App\Http\Controllers\Attendances;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\repositories\Eloquent\StudentsRepository;
use App\repositories\Eloquent\TeachersRepository;
use App\repositories\AttendancesRepositoryInterface;
use App\repositories\Eloquent\GradesRepository;
use App\repositories\Eloquent\SectionsRepository;

class AttendancesController extends Controller
{
    private $attendance;
    public function __construct(AttendancesRepositoryInterface $attendance)
    {
        $this->attendance = $attendance;
    }


    public function indexx($teacher_id, SectionsRepository $sections)
    {
        $attendances = $this->attendance->getData()->where('teacher_id',$teacher_id)->where('status',0);
        return view('pages.attendances.index',compact('attendances'));
    }

    public function store(Request $request)
    {
        try {
            foreach ($request->student_id as $id){

                    $this->attendance->create([
                        'grade_id' => $request->grade_id,
                        'classroom_id' => $request->classroom_id,
                        'section_id' => $request->section_id,
                        'teacher_id' => $request->teacher_id,
                        'student_id' => $id,
                        'date' => date('y-m-d'),
                        'status' => $request->status[$id]??'1'
                    ]);
                    toastr()->success(__('Absence is recorded')); 
            }
            return redirect()->back();
        }catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);

        }
    }

    public function showLayout($id,TeachersRepository $t,GradesRepository $g)
    {
        $sections = $t->getById($id)->sections;
        $teacher_id = $id;
        $grades = $g->getData();
        return view('pages.attendances.create',compact(['sections','teacher_id','grades']));
    }

    //Show students
    public function show(Request $request,$section_id, StudentsRepository $s)
    {
        $attendances = $this->attendance->getData();
        $students = $s->getData()->where('section_id',$section_id);
        $teacher_id = $request->teacher_id;
        
        return view('pages.attendances.create2',compact(['students', 'section_id', 'teacher_id','attendances']));
    }

}
