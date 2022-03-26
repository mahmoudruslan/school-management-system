<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\repositories\GradesRepositoryInterface;
use App\models\Classroom;
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
    return view('admin_dashboard.pages.grades.index', compact(['grades']));
  }

  public function store(Request $request)
  {
    $this->grade->create($request->all());
    return redirect()->back();
  }

  public function update(Request $request)
  {
    $this->grade->update($request->all(), $request->id);
    return redirect()->back();
  }

  public function destroy(Request $request)
  {
    $ClassroomsOfTheGrade = Classroom::where('grade_id', $request->id)->pluck('grade_id'); //بيجيب كام جرييد اي دي بيحمل نفس الاي دي بتاع المرحلة
    if (count($ClassroomsOfTheGrade) !== 0) {
      toastr()->error(__('It is not possible to delete the stage because there are classes affiliated with it'));
      return redirect()->back();
    } else {
      $this->grade->destroy($request->id);
      return redirect()->back();
    }
  }
}
