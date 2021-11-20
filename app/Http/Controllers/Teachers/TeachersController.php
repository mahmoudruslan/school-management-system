<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Http\interfaces\Repositoryinterface;
use App\Http\Requests\TeachersRequest;
use App\models\Specialization;
use App\models\Teacher;
use Illuminate\Http\Request;
use Hash;

class TeachersController extends Controller
{
    protected $teacher;
    public function __construct(Repositoryinterface $teacher)
    {
        $this->teacher = $teacher;
    }


    public function index()
    {
        $teachers = $this->teacher->index();

        return view('pages.teachers.teachers',compact('teachers'));
    }


    public function create()
    {

        $specializations = $this->teacher->getSpecializations();
        return view('pages.teachers.create',compact('specializations'));
    }


    public function store(TeachersRequest $request)
    {

        return $this->teacher->store($request);
    }


    public function edit($id)
    {
        $specializations = $this->teacher->getSpecializations();
        $teacher = $this->teacher->edit($id);
        return view('pages.teachers.edit',compact(['specializations','teacher']));
    }


    public function update(TeachersRequest $request)
    {
        return $this->teacher->update( $request);

    }


    public function destroy(Request $request)
    {
        return $this->teacher->delete($request);
    }
}
