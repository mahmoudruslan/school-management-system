<?php

namespace App\Http\Controllers\Classrooms;
use App\Http\Controllers\Controller;
use App\repositories\ClassroomsRepositoryInterface;
use App\repositories\Eloquent\GradesRepository;
use Illuminate\Http\Request;
use App\Http\Requests\ClassroomRequest;
use App\models\Section;

class ClassroomController extends Controller
{

    private $classRoom;
    public function __construct(ClassroomsRepositoryInterface $classRoom){
        $this->classRoom =$classRoom;
    }
    public function index(GradesRepository $g)
    {
        $grades = $g->getAll();
        $classrooms = $this->classRoom->getAll();
            return view('pages.myclassroom.classroom',compact(['grades','classrooms']));
    }


    public function store(ClassroomRequest $request)
    {
        try{
            $this->classRoom->create($request->all());
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
            $this->classRoom->update($request->all(),$request->id);
            toastr()->success(__('Data updated successfully'));
            return redirect()->back();
        }catch(\Exception $e) {
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try{
            $sections = Section::where('classroom_id', $request -> id)->pluck('classroom_id');
            if(count($sections) == 0){
                $this->classRoom->destroy($request->id);
                toastr()->success(__('Data deleted successfully'));
                return redirect()->back();
            }else {
                toastr()->error(__('Sections related to this classroom must be deleted first'));
                return redirect()->back();
            }
        }catch(\Exception $e)
        {
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }

    }




}
