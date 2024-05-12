<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\repositories\SectionRepositoryInterface;
use App\repositories\GradeRepositoryInterface;
use App\repositories\StudentRepositoryInterface;
use App\repositories\AdminRepositoryInterface;
use Illuminate\Http\Request;


class SectionController extends Controller
{
    private $section;
    public function __construct(SectionRepositoryInterface $section)
    {
        $this->section = $section;
    }

    public function index(GradeRepositoryInterface $grade)
    {
        $sections = $this->section->all(['grade', 'classroom']);
        return view('admin_dashboard.pages.sections.index', compact(['sections']));
    }

    public function create(GradeRepositoryInterface $grade, AdminRepositoryInterface $admin)
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

    public function edit($id, GradeRepositoryInterface $grade, AdminRepositoryInterface $admin)
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
        public function show($section_id, StudentRepositoryInterface $student)
        {
            $students = $student->all(['grade', 'classroom', 'section'])->where('section_id',$section_id);        
            return view('admin_dashboard.pages.sections.show',compact(['students']));
        }

    public function destroy(Request $request, StudentRepositoryInterface $student)
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
