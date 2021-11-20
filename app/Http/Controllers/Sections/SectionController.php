<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\models\Grade;
use App\models\Classroom;
use App\models\Section;
use App\models\Teacher;
use Exception;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $grades = Grade::select([
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'name_ar',//مررت االعربي والانجليزي تاني من غير اازز النييم عشان لما اجي استدعيهم من الداتا بيز في فورمة التعديل اعرف اجيم قيمة الانبوت العربي وقيمة الانبوت الانجليزي  ايا كان لغة الموقع الحالية
            'name_en',
            'notes',
            'id'

        ])->get();
        $teachers = Teacher::all();


        return view('pages.sections.sections',compact(['grades','teachers']));
    }



    public function create()
    {
        $grades = Grade::select([
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'name_ar',//مررت االعربي والانجليزي تاني من غير اازز النييم عشان لما اجي استدعيهم من الداتا بيز في فورمة التعديل اعرف اجيم قيمة الانبوت العربي وقيمة الانبوت الانجليزي  ايا كان لغة الموقع الحالية
            'name_en',
            'notes',
            'id'

        ])->get();
        $teachers = Teacher::all();
        return view('pages.sections.create',compact(['grades','teachers']));
    }



    public function store(SectionRequest $request)
    {

        try{
            if(!$request->status){
                $request->status = 0;
            }
            $sections = new Section();



                $sections->name_ar = $request->name_ar;
                $sections->name_en = $request->name_en;
                $sections->grade_id = $request->grade_id;
                $sections->status = $request->status;
                $sections->classroom_id = $request->classroom_id;
                $sections->save();

          $sections->teachers()->attach($request->teacher_id);

        toastr()->success(__('messages.success'));

        return redirect()->back();
      }catch(\Exception $e)
          {
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }
    }


    public function edit($id)
    {
        try{
            $section = Section::find($id);

            if(!$section){
                toastr()->error(__('messages.error_section'));
                return redirect()->back();
            }else{
                $grades = Grade::select([
                    'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
                    'name_ar',//مررت االعربي والانجليزي تاني من غير اازز النييم عشان لما اجي استدعيهم من الداتا بيز في فورمة التعديل اعرف اجيم قيمة الانبوت العربي وقيمة الانبوت الانجليزي  ايا كان لغة الموقع الحالية
                    'name_en',
                    'notes',
                    'id'

                ])->get();
                $teachers = Teacher::all();

                return view('pages.sections.edit', compact(['grades', 'teachers', 'section']));
            }
        }catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }


    public function update(SectionRequest $request)
    {

        try{
            $sections = Section::find($request->id);

            if(!$sections){
                toastr()->error(__('messages.error_section'));
                return redirect()->back();
            }else{
                if(empty($request->status)){
                    $request->status = 0;
                }
                $sections->update([
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'grade_id' => $request->grade_id,
                    'status' => $request->status,
                    'classroom_id' => $request->classroom_id,
                ]);

                $sections->teachers()->sync($request->teacher_id);
            toastr()->success(__('messages.success_edit'));
            return redirect()->back();
            }

        }catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }


    public function destroy(Request $request)
    {
        try {
            $sections = Section::find($request->id);

            if (!$sections) {
                toastr()->error(__('messages.error_section'));
                return redirect()->back();
            } else {
                $sections ->delete();
                toastr()->success(__('messages.success_delete'));
                return redirect()->back();

            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function getClassrooms($id)
    {
        $list_classes = Classroom::where("grade_id", $id)->pluck("name_".LaravelLocalization::getCurrentLocale(), "id");

        return $list_classes;
    }
}
