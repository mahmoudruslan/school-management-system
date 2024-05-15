<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\repositories\Eloquent\SectionRepository;
use App\repositories\Eloquent\GradeRepository;
use App\repositories\Eloquent\StudentRepository;
use App\repositories\Eloquent\AdminRepository;
use Illuminate\Http\Request;


class SectionController extends Controller
{
    private $section;
    public function __construct(SectionRepository $section)
    {
        $this->section = $section;
    }

    public function index(GradeRepository $grade)
    {
        $sections = $this->section->all(['grade', 'classroom']);
        return view('admin_dashboard.pages.sections.index', compact(['sections']));
    }

    public function create(GradeRepository $grade, AdminRepository $admin)
    {
        $grades = $grade->all([]);
        $admins = $admin->all([] ,['name_ar', 'name_en', 'id']);
        return view('admin_dashboard.pages.sections.create', compact(['grades', 'admins']));
    }

    public function store(SectionRequest $request)
    {
        $Section = $this->section->create($request->all());
        $sectionFind = $this->section->getById($Section->id);
        $sectionFind->admins()->attach($request->admin_id);
        return redirect()->back();
    }

    public function edit($id, GradeRepository $grade, AdminRepository $admin)
    {
        
        $section = $this->section->getById($id);
        // dd($section->admins->pluck('id'));
        $grades = $grade->all([]);
        $admins = $admin->all([], ['name_ar', 'name_en', 'id']);
        return view('admin_dashboard.pages.sections.edit', compact(['grades', 'admins', 'section']));
    }

    public function update(SectionRequest $request)
    {
        $Section = $this->section->update($request->all(), $request->id);
        $sectionFind = $this->section->getById($Section->id);
        $sectionFind->admins()->sync($request->admin_id);
        return redirect()->route('sections.index');
    }

        //Show students
        public function show($section_id, StudentRepository $student)
        {
            $students = $student->all(['grade', 'classroom', 'section'])->where('section_id',$section_id);        
            return view('admin_dashboard.pages.sections.show',compact(['students']));
        }

    public function destroy(Request $request, StudentRepository $student)
    {
        $sections = $student->all([], 'section_id')->where('section_id', $request->id)->pluck('section_id');
        if (count($sections) > '0') {
            toastr()->error(__('Student related to this section must be deleted first'));
            return redirect()->back();
        }
        $this->section->destroy($request->id);
        return redirect()->back();
    }


    


}
