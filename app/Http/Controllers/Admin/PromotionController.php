<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\repositories\GradeRepositoryInterface;
use App\Http\Requests\PromotionRequest;
use App\repositories\PromotionRepositoryInterface;
use App\repositories\StudentRepositoryInterface;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    private $promotion;

    public function __construct(PromotionRepositoryInterface $promotion)
    {
        $this->promotion = $promotion;
    }

    public function index()
    {
        $promotions = $this->promotion->all(['f_grade','f_classroom','to_grade','to_classroom', 'student']);
        return view('admin_dashboard.pages.promotions.index', compact(['promotions']));
    }

    public function create(GradeRepositoryInterface $grade)
    {
        $grades = $grade->all([]);
        return view('admin_dashboard.pages.promotions.create', compact('grades'));
    }

    public function store(PromotionRequest $request, StudentRepositoryInterface $student)
    {
        //student only query to use update method to all data
        $students = $student->myModel()->select(['id', 'grade_id', 'classroom_id', 'section_id'])
            ->where('grade_id', $request->grade_id)
            ->where('classroom_id', $request->classroom_id)
            ->where('section_id', $request->section_id);
        //get all student to insert in promotion table 
        $student_collection = $students->get();
        if (count($student_collection) > 0) { // if students already exists
            // update grade , classroom and section for student existing in $students var 
            $students->update([
                'grade_id' => $request->to_grade_id,
                'classroom_id' => $request->to_classroom_id,
                'section_id' => $request->to_section_id,
                'entry_status' => 1
            ]);
            // insert student data in promotion table
            foreach ($student_collection as $student) {
                $this->promotion->create($request->validated()+[
                    'student_id' => $student->id,
                ]);
            }
            toastr()->success(__('The students were successfully promoted'));
            return redirect()->route('promotions.index');
        }
        toastr()->success(__('There are no students'));
        return redirect()->back();
    }


    public function destroy(Request $request, StudentRepositoryInterface $student)
    {
        $ids = explode(",", $request->ids);
        foreach ($ids as $id) {
            
            $promotion = $this->promotion->getById($id);
            $promotion_student = $student->getById($promotion->student_id);
            $promotion_student->update([
                'grade_id' => $promotion->grade_id,
                'classroom_id' => $promotion->classroom_id,
                'section_id' => $promotion->section_id,
                'entry_status' => 0
            ]);
            $this->promotion->destroy($promotion->id);
        }
        
        return redirect()->back();
    }
}
