<?php

namespace App\Http\Controllers\Classrooms;
use App\Http\Controllers\Controller;
use App\repositories\ClassroomsRepositoryInterface;
use App\repositories\Eloquent\GradesRepository;
use App\repositories\Eloquent\StudentsRepository;
use Illuminate\Http\Request;
use App\Http\Requests\ClassroomRequest;
use App\models\Section;
use App\repositories\Eloquent\SectionsRepository;

class ClassroomController extends Controller
{

    private $classroom;
    public function __construct(ClassroomsRepositoryInterface $classroom){
        $this->classroom =$classroom;
    }
    public function index(GradesRepository $g)
    {
        $grades = $g->getAll();
        $classrooms = $this->classroom->getAll();
            return view('pages.myclassroom.index',compact(['grades','classrooms']));
    }


    public function store(ClassroomRequest $request)
    {
        try{
            $this->classroom->create($request->all());
            toastr()->success(__('Data saved successfully'));
            return redirect()->back();
        }catch(\Exception $e)
            {
                return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }


    public function update(ClassroomRequest $request)
    {
        try{
            $this->classroom->update($request->all(),$request->id);
            toastr()->success(__('Data updated successfully'));
            return redirect()->back();
        }catch(\Exception $e) {
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }

    public function destroy(Request $request,SectionsRepository $sec,StudentsRepository $stud)
    {
        try{
            $student = $stud->getRelatedStuff('classroom_id',$request->id);//في طلاب عندهم الكلاس رووم اي دي دا؟ تب كم واحد؟
            $sections = $sec->getRelatedStuff('classroom_id',$request -> id);
            if(count($sections) > 0 || count($student) > 0 ){
                toastr()->error(__("Classroom can't be deleted, there are things about it"));
                return redirect()->back();
            }

            $this->classroom->destroy($request->id);
            toastr()->success(__('Data deleted successfully'));
            return redirect()->back();
        }catch(\Exception $e)
        {
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }

    }




}
