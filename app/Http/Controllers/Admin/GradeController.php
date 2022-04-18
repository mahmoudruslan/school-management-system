<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\repositories\GradeRepositoryInterface;
use App\repositories\ClassroomRepositoryInterface;
use App\repositories\StudentRepositoryInterface;
use Illuminate\Http\Request;


class GradeController extends Controller
{
  private $grade;
  public function __construct(GradeRepositoryInterface $grade)
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

      //Show students
      public function show(Request $request, $grade_id, StudentRepositoryInterface $s)
      {
          $students = $s->getData()->where('grade_id', $grade_id);
          return view('admin_dashboard.pages.grades.show', compact(['students']));
      }

  public function destroy(Request $request,ClassroomRepositoryInterface $c)
  {
    $ClassroomsOfTheGrade = $c->myModel()->where('grade_id', $request->id)->pluck('grade_id'); //بيجيب كام جرييد اي دي بيحمل نفس الاي دي بتاع المرحلة
    if (count($ClassroomsOfTheGrade) !== 0) {
      toastr()->error(__('It is not possible to delete the stage because there are classes affiliated with it'));
      return redirect()->back();
    } else {
      $this->grade->destroy($request->id);
      return redirect()->back();
    }
  }
}
