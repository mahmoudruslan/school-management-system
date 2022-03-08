<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\repositories\Eloquent\ClassroomsRepository;
use App\repositories\Eloquent\GradesRepository;
use App\repositories\Eloquent\TeachersRepository;
use App\repositories\SectionsRepositoryInterface;
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

    public function index(GradesRepository $g)
    {
        $grades = $g->getData();
        return view('pages.sections.index', compact(['grades']));
    }

    public function create(GradesRepository $g, TeachersRepository $t)
    {
        $grades = $g->getData();
        $teachers = $t->getData('admin_id');
        return view('pages.sections.create', compact(['grades', 'teachers']));
    }

    public function store(SectionRequest $request)
    {
        $Section = $this->section->create($request->all());
        $sectionFind = $this->section->getById($Section->id);
        $sectionFind->teachers()->attach($request->teacher_id);
        return redirect()->back();
    }

    public function edit($id, GradesRepository $g, TeachersRepository $t)
    {
        $section = $this->section->getById($id);
        $grades = $g->getData();
        $teachers = $t->getData(['admin_id', 'id']);
        return view('pages.sections.edit', compact(['grades', 'teachers', 'section']));
    }

    public function update(SectionRequest $request)
    {
        $Section = $this->section->update($request->all(), $request->id);
        $sectionFind = $this->section->getById($Section->id);
        $sectionFind->teachers()->sync($request->teacher_id);
        return redirect()->route('Sections.index');
    }

    public function destroy(Request $request, StudentsRepository $s)
    {
        $sections = $s->getData('section_id')->where('section_id', $request->id)->pluck('section_id');
        if (count($sections) > '0') {
            toastr()->error(__('Student related to this section must be deleted first'));
            return redirect()->back();
        }
        $this->section->destroy($request->id);
        return redirect()->back();
    }

    public function getClassrooms($id, ClassroomsRepository $c) //related ajax code
    {
        $list_classes = $c->getData()->where("grade_id", $id)->pluck("name_" . LaravelLocalization::getCurrentLocale(), "id");
        return $list_classes;
    }
}
