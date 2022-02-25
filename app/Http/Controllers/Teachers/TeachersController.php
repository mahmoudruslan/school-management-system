<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeachersRequest;
use App\models\Specialization;
use App\repositories\TeachersRepositoryInterface;
use Illuminate\Http\Request;

class TeachersController extends Controller
{

    protected $teacher;
    public function __construct(TeachersRepositoryInterface $teacher)
    {
        $this->teacher = $teacher;
    }


    public function index()
    {
        $teachers = $this->teacher->getData();
        return view('pages.teachers.index', compact('teachers'));
    }


    public function create()
    {
        $specializations = Specialization::all();
        return view('pages.teachers.create', compact('specializations'));
    }


    public function store(TeachersRequest $request)
    {
        $this->teacher->create($request->all());
        return redirect()->back();
    }


    public function edit($id)
    {

        $specializations = Specialization::all();
        $teacher = $this->teacher->getById($id);
        return view('pages.teachers.edit', compact(['specializations', 'teacher']));
    }


    public function update(TeachersRequest  $request)
    {
        $this->teacher->update($request->only(
            'name_ar',
            'name_en',
            'email',
            'password',
            'specialization_id',
            'joining_date',
            'address'
        ), $request->id);
        return redirect()->route('Teachers.index');
    }


    public function destroy(Request $request)
    {
        $this->teacher->destroy($request->id);
        return redirect()->back();
    }
}
