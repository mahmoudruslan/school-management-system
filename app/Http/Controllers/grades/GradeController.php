<?php 

namespace App\Http\Controllers\grades;
use App\Http\Controllers\Controller;
use App\Http\Requests\GeadeRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

use App\models\Classroom;
use Illuminate\Http\Request;
use App\models\Grade;
use Exception;
use Illuminate\Validation\Rules\Exists;

class GradeController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    
    $grades = Grade::select([
      'id',
      'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
      'name_ar',//مررت االعربي والانجليزي تاني من غير اازز النييم عشان لما اجي استدعيهم من الداتا بيز في فورمة التعديل اعرف اجيم قيمة الانبوت العربي وقيمة الانبوت الانجليزي  ايا كان لغة الموقع الحالية
      'name_en',
      'notes',

  ])->get();



    return view('pages.grades.grades',compact(['grades']));

  }


  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  //sptie translatable pakage
  public function store(GeadeRequest $request)
  {

    try{
      $validate = $request->validated();
      Grade::create([
        'name_ar' => $request->name_ar, 
        'name_en' => $request->name_en, 
        'notes' => $request->notes,
      ]);

      toastr()->success(__('messages.success'));
  
      return redirect()->back();  
    }catch(\Exception $e)
        {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }
 
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  






       /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  public function update(GeadeRequest $request)
  {
    try{
      $grade = Grade::find($request -> id);
      if(!$grade)
      {
        toastr()->error(__('messages.error_grade'));

        return redirect()->back();
      }else{
        $grade->update([
          'name_ar' => $request->name_ar, 
          'name_en' => $request->name_en, 
          'notes' => $request->notes,
  
        ]);
        toastr()->success(__('messages.success_edit'));
    
        return redirect()->back();    
      }
    }catch(\Exception $e)
    {
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);

    }
    

    
  }


##################################################################

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request)
  {
    try{
      $grade = Grade::find($request -> id);
      if(!$grade)
      {
          toastr()->error(__('messages.error'));
          return redirect()->back();

      }else{

        $ClassroomsOfTheGrade = Classroom::where('grade_id', $request -> id)->pluck('grade_id');//بيجيب كام جرييد اي دي بيحمل نفس الاي دي بتاع المرحلة

          if(count($ClassroomsOfTheGrade) !== 0){
            toastr()->error(__('messages.notcascde_grade'));
            return redirect()->back();
          }else{
            $grade->delete();
            toastr()->success(__('messages.success_delete'));
            return redirect()->back();
          }


      }
    }catch(\Exception $e)
    {
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);

    }  
  }
  





}

