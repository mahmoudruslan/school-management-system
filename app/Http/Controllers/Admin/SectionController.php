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

    public function index(GradeRepositoryInterface $g)
    {
        $grades = $g->getData();
        return view('admin_dashboard.pages.sections.index', compact(['grades']));
    }

    public function create(GradeRepositoryInterface $g, AdminRepositoryInterface $a)
    {
        $grades = $g->getData();
        $admins = $a->getData(['name_ar', 'name_en', 'id']);
        return view('admin_dashboard.pages.sections.create', compact(['grades', 'admins']));
    }

    public function store(SectionRequest $request)
    {
        $Section = $this->section->create($request->all());
        $sectionFind = $this->section->getById($Section->id);
        $sectionFind->teachers()->attach($request->admin_id);
        return redirect()->back();
    }

    public function edit($id, GradeRepositoryInterface $g, AdminRepositoryInterface $a)
    {
        $section = $this->section->getById($id);
        $grades = $g->getData();
        $admins = $a->getData(['name_ar', 'name_en', 'id']);
        return view('admin_dashboard.pages.sections.edit', compact(['grades', 'admins', 'section']));
    }

    public function update(SectionRequest $request)
    {
        $Section = $this->section->update($request->all(), $request->id);
        $sectionFind = $this->section->getById($Section->id);
        $sectionFind->admins()->sync($request->admin_id);
        return redirect()->route('sections.index');
    }

    public function destroy(Request $request, StudentRepositoryInterface $s)
    {
        $sections = $s->getData('section_id')->where('section_id', $request->id)->pluck('section_id');
        if (count($sections) > '0') {
            toastr()->error(__('Student related to this section must be deleted first'));
            return redirect()->back();
        }
        $this->section->destroy($request->id);
        return redirect()->back();
    }


    


}
