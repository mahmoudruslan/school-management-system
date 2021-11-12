<?php

namespace App\Http\Controllers\Classrooms;

use App\Http\Controllers\Controller;
use App\models\Classroom;
use App\models\Grade;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\ClassroomRequest;
use App\models\Section;

class ClassroomController extends Controller
{
    public function index()
    {
        $grades = Grade::select([
            'id',
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'name_ar',//مررت االعربي والانجليزي تاني من غير اازز النييم عشان لما اجي استدعيهم من الداتا بيز في فورمة التعديل اعرف اجيم قيمة الانبوت العربي وقيمة الانبوت الانجليزي  ايا كان لغة الموقع الحالية
            'name_en',
            'notes',

        ])->get();

        $classrooms = Classroom::select([
            'id',
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'name_ar',//مررت االعربي والانجليزي تاني من غير اازز النييم عشان لما اجي استدعيهم من الداتا بيز في فورمة التعديل اعرف اجيم قيمة الانبوت العربي وقيمة الانبوت الانجليزي  ايا كان لغة الموقع الحالية
            'name_en',
            'grade_id'
            

        ])->get();
    
            return view('pages.myclassroom.classroom',compact(['grades','classrooms']));


    }

    public function store(ClassroomRequest $request)
    {


        try{
            $validate = $request->validated();

            Classroom::create([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'grade_id' => $request->grade_id

            ]);

            toastr()->success(__('messages.success'));
    
                return redirect()->back();  
        }catch(\Exception $e)
            {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update(ClassroomRequest $request)
    {
            try{
                $classroom = Classroom::find($request -> id);
                if(!$classroom)
                {
                toastr()->error(__('messages.error_classroom'));
        
                return redirect()->back();
                }else{
                $classroom->update([
                    'name_ar' => $request->name_ar, 
                    'name_en' => $request->name_en, 
                    'grade_id' => $request->grade_id,
            
                ]);
                toastr()->success(__('messages.success_edit'));
            
                return redirect()->back();    
                }
            }catch(\Exception $e)
            {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        
            }
    }

    public function destroy(Request $request)
    {
        try{

            $classroom = Classroom::find($request -> id);
            if(!$classroom)
            {
                toastr()->error(__('messages.error'));
                return redirect()->back();
            }else{

                $sections = Section::where('classroom_id',$request -> id)->pluck('classroom_id');
                if(count($sections) !== 0){
                    toastr()->error(__('messages.notcascde_classroom'));
                    return redirect()->back();
                }else{
                    $classroom->delete();
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
