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
        $promotions = $this->promotion->getData();
        return view('admin_dashboard.pages.promotions.index', compact(['promotions']));
    }

    public function create(GradeRepositoryInterface $g)
    {
        $grades = $g->getData();
        return view('admin_dashboard.pages.promotions.create', compact('grades'));
    }

    public function store(PromotionRequest $request, StudentRepositoryInterface $s)
    {
            $students = $s->myModel()->select(['id', 'grade_id', 'classroom_id', 'section_id'])
            ->where('grade_id', $request->grade_id)
            ->where('classroom_id', $request->classroom_id)
            ->where('section_id', $request->section_id)->get();
        if (count($students) > 0) {
            foreach ($students as $student) {
                $s->update([
                    'grade_id' => $request->to_grade_id,
                    'classroom_id' => $request->to_classroom_id,
                    'section_id' => $request->to_section_id,
                    'entry_status' => 1
                ], $student->id);

                $this->promotion->create([
                    'student_id' => $student->id,
                    'grade_id' => $request->grade_id,
                    'classroom_id' => $request->classroom_id,
                    'section_id' => $request->section_id,
                    'to_grade_id' => $request->to_grade_id,
                    'to_classroom_id' => $request->to_classroom_id,
                    'to_section_id' => $request->to_section_id,
                ]);
            }
            return redirect()->back();
        }
        toastr()->success(__('There are no students'));
        return redirect()->back();
    }


    public function destroy(Request $request, StudentRepositoryInterface $s)
    {

        $ids = explode(",", $request->ids);
        foreach ($ids as $id) {
            $promotion = $this->promotion->getById($id);
            $student = $s->getById($promotion->student_id);
            $student->update([
                'grade_id' => $promotion->from_grade_id,
                'classroom_id' => $promotion->from_classroom_id,
                'entry_status' => 0
            ]);
            $this->promotion->destroy($promotion->id);
            //}
        }
        return redirect()->back();
    }
}
