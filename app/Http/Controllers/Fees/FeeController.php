<?php

namespace App\Http\Controllers\Fees;

use App\Http\Controllers\Controller;
use App\repositories\Eloquent\GradesRepository;
use App\repositories\Eloquent\StudentsRepository;
use App\repositories\FeesRepositoryInterface;
use Illuminate\Http\Request;


class FeeController extends Controller
{
    private $fee;
    public function __construct(FeesRepositoryInterface $fee)
    {
        $this->fee = $fee;
    }

    public function index()
    {
        $fees = $this->fee->getAll();
        return view('pages.fees.fees',compact('fees'));
    }


    public function create(GradesRepository $g)
    {
        $grades = $g->getAll();
        return view('pages.fees.create',compact('grades'));
    }


    public function store(Request $request)
    {
        try {
            $this->fee->create($request->all());
            toastr()->success(__('Data saved successfully'));
            return redirect()->back();
        }catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function show($id,StudentsRepository $s)
    {
        $fee = $this->fee->getById($id);
        $students = $s->getAll()->where('grade_id',$fee->grade_id)->where('classroom_id',$fee->classroom_id);

        return view('pages.fees.show',compact(['students','fee']));
    }


    public function edit($id, GradesRepository $g)
    {
        $grades = $g->getAll();
        $fee = $this->fee->getById($id);
        return view('pages.fees.edit',compact(['fee','grades']));
    }


    public function update(Request $request, $id)
    {
        try {
            $this->fee->update($request->all(),$id);
            toastr()->success(__('Data updated successfully'));
            return redirect()->route('Fees.index');
        }catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }



    public function destroy($id)
    {
        try {
            $this->fee->destroy($id);
            toastr()->success(__('Data deleted successfully'));
            return redirect()->back();
        }catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }
}
