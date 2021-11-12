<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\models\Grade;
use App\models\Classroom;
use App\models\Section;
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
        

        return view('pages.sections.sections',compact(['grades']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'create function';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SectionRequest $request)
    {
        try{
            if(!$request->status){
                $request->status = 0;
            }
        Section::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'grade_id' => $request->grade_id,
            'status' => $request->status,
            'classroom_id' => $request->classroom_id,
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
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SectionRequest $request)
    {
        try{
            $sections = Section::find($request->id);

            if(!$sections){
                toastr()->error(__('messages.error'));
                return redirect()->back();
            }else{

                $sections->update([
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'grade_id' => $request->grade_id,
                    'status' => $request->status,
                    'classroom_id' => $request->classroom_id,
                ]);

                if(!$request->status){
                    $request->status = 0;
                }
            toastr()->success(__('messages.success_edit'));
            return redirect()->back();  
            }
            
        }catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
