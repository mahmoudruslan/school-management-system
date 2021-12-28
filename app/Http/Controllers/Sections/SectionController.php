<?php

namespace App\Http\Controllers\Sections;
use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\repositories\Eloquent\ClassroomsRepository;
use App\repositories\Eloquent\GradesRepository;
use App\repositories\Eloquent\TeachersRepository;
use App\repositories\SectionsRepositoryInterface;
use Exception;
use App\models\Student;
use App\repositories\Eloquent\StudentsRepository;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class SectionController extends Controller
{
    private $section;
    public function __construct(SectionsRepositoryInterface $section)
    {
        $this->section = $section;
    }



    public function index(GradesRepository $g,TeachersRepository $t)
    {

        $grades = $g->getAll();
        $teachers = $t->getAll();
        return view('pages.sections.index',compact(['grades','teachers']));
    }



    public function create(GradesRepository $g,TeachersRepository $t)
    {
        $grades = $g->getAll();
        $teachers = $t->getAll();
        return view('pages.sections.create',compact(['grades','teachers']));
    }



    public function store(SectionRequest $request)
    {
        try{
            $Section = $this->section-> create($request->all());
            $sectionFind = $this->section->getById($Section->id);
            $sectionFind->teachers()->attach($request->teacher_id);
            toastr()->success(__('Data saved successfully'));
            return redirect()->back();
        }catch(\Exception $e)
            {
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
    }


    public function edit($id,GradesRepository $g,TeachersRepository $t)
    {
        try{
            $section = $this->section->getById($id);
            $grades = $g->getAll();
            $teachers = $t->getAll();
            return view('pages.sections.edit', compact(['grades', 'teachers', 'section']));
        }catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function update(SectionRequest $request)
    {
        try{
            $Section = $this->section->update($request->all(),$request->id);
            $sectionFind = $this->section->getById($Section->id);
            $sectionFind->teachers()->sync($request->teacher_id);

            toastr()->success(__('Data updated successfully'));
            return redirect()->route('Sections.index');
        }catch(Exception $e){
            return redirect()->route('Sections.index')->with(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Request $request,StudentsRepository $s)
    {
        try {

            $sections = $s->getAll()->where('section_id', $request -> id)->pluck('section_id');
            if(count($sections) > '0'){
                toastr()->error(__('Student related to this section must be deleted first'));
                return redirect()->back();
            }
                $this->section->destroy($request->id);
                toastr()->success(__('Data deleted successfully'));
                return redirect()->back();


        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function getClassrooms($id,ClassroomsRepository $c)//related ajax code
    {
        $list_classes = $c->getAll()->where("grade_id", $id)->pluck("name_".LaravelLocalization::getCurrentLocale(), "id");
        return $list_classes;
    }
}

