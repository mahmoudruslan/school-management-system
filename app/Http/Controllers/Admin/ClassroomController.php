<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\repositories\ClassroomRepositoryInterface;
use App\repositories\Eloquent\GradeRepository;
use App\repositories\Eloquent\StudentRepository;
use Illuminate\Http\Request;
use App\repositories\Eloquent\SectionRepository;

class ClassroomController extends Controller
{
    private $classroom;
    public function __construct(ClassroomRepositoryInterface $classroom){
        $this->classroom =$classroom;
    }
    public function index(GradeRepository $g)
    {
        $grades = $g->getData();
        $classrooms = $this->classroom->getData();
            return view('admin_dashboard.pages.myclassroom.index',compact(['grades','classrooms']));
    }

    public function store(Request $request)
    {
        $this->classroom->create($request->all());
        return redirect()->back();

    }

    public function update(Request $request)
    {
        $this->classroom->update($request->all(),$request->id);
        return redirect()->back();
    }

    public function destroy(Request $request,SectionRepository $sec,StudentRepository $stud)
    {
            $student = $stud->getRelatedStuff('classroom_id',$request->id);//في طلاب عندهم الكلاس رووم اي دي دا؟ تب كم واحد؟
            $sections = $sec->getRelatedStuff('classroom_id',$request -> id);
            if(count($sections) > 0 || count($student) > 0 ){
                toastr()->error(__("Classroom can't be deleted, there are things about it"));
                return redirect()->back();
            }
            $this->classroom->destroy($request->id);
            return redirect()->back();
    }




}
