<?php

namespace App\Http\Controllers\grades;
use App\Http\Controllers\Controller;
use App\Http\Requests\GeadeRequest;
use App\repositories\GradesRepositoryInterface;
use App\models\Classroom;
use App\models\Grade;
use Illuminate\Http\Request;
class GradeController extends Controller
{
    private $grade;
    public function __construct(GradesRepositoryInterface $grade)
    {
        $this->grade = $grade;
    }



  public function index()
  {
    $grades = $this->grade->getData();
    return view('pages.grades.index',compact(['grades']));

  }



  public function store(GeadeRequest $request)
  {
    try{
        $this->grade->create($request->all());
      toastr()->success(__('Data saved successfully'));
      return redirect()->back();
    }catch(\Exception $e)
        {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }



  public function update(Request $request)
  {
    try{
        $this->grade->update($request->all(),$request->id);
        toastr()->success(__('Data updated successfully'));
        return redirect()->back();
    }catch(\Exception $e)
    {
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }



  public function destroy(Request $request)
  {
    try{
        $ClassroomsOfTheGrade = Classroom::where('grade_id', $request -> id)->pluck('grade_id');//بيجيب كام جرييد اي دي بيحمل نفس الاي دي بتاع المرحلة
          if(count($ClassroomsOfTheGrade) !== 0){
            toastr()->error(__('It is not possible to delete the stage because there are classes affiliated with it'));
            return redirect()->back();
          }else{
              $this->grade->destroy($request->id);
            toastr()->error(__('Data deleted successfully'));
            return redirect()->back();
          }
    }catch(\Exception $e)
    {
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);

    }
  }

}

