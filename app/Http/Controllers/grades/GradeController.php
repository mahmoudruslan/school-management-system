<?php

namespace App\Http\Controllers\grades;
use App\Http\Controllers\Controller;
use App\Http\Requests\GeadeRequest;
use App\repositories\GradesRepositoryInterface;
use App\models\Classroom;
use Illuminate\Http\Request;
class GradeController extends Controller
{
    private $Grade;
    public function __construct(GradesRepositoryInterface $Grade)
    {
        $this->Grade = $Grade;
    }



  public function index()
  {
    $grades = $this->Grade->getAll();
    return view('pages.grades.grades',compact(['grades']));

  }



  public function store(GeadeRequest $request)
  {
    try{
        $this->Grade->create($request->all());
      toastr()->success(__('Data saved successfully'));
      return redirect()->back();
    }catch(\Exception $e)
        {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }



  public function update(GeadeRequest $request)
  {
    try{
        $this->Grade->update($request->all(),$request->id);
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
              $this->Grade->destroy($request->id);
            toastr()->error(__('Data deleted successfully'));
            return redirect()->back();
          }
    }catch(\Exception $e)
    {
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);

    }
  }

}

