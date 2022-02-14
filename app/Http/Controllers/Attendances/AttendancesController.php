<?php

namespace App\Http\Controllers\Attendances;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Attendance;
use App\models\Section;
use App\models\Student;
use App\models\Teacher;
use App\repositories\Eloquent\StudentsRepository;
use App\repositories\Eloquent\TeachersRepository;
use App\repositories\AttendancesRepositoryInterface;
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
                    toastr()->success('Absence is recorded'); 
                
            }
            return redirect()->back();
        }catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);

        }
    }

    //show teacher's classrooms
    public function showLayout($id,TeachersRepository $t)
    {
        $sections = $t->getById($id)->sections;//to get sections do foreach
        $uniqueGradeId = $sections->unique('grade_id');
        
        $teacher_id = $id;

        return view('pages.attendances.create1',compact(['sections','uniqueGradeId','teacher_id']));
    }

    //Show class students
    public function ShowSectionStudents(Request $request,$id, StudentsRepository $s)
    {
        $students = $s->getData()->where('section_id',$id);
        $teacher_id = $request->teacher_id;
        $attendances = $this->attendance->getData();
        return view('pages.attendances.create2',compact(['students','teacher_id','attendances']));
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
