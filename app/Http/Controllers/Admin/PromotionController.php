<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\repositories\GradeRepositoryInterface;
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

    public function store(Request $request, StudentRepositoryInterface $s)
    {
        $students = $s->getData(['id', 'grade_id', 'classroom_id'])
            ->where('grade_id', $request->grade_id)
            ->where('classroom_id', $request->classroom_id);
        if (count($students) > 0) {
            foreach ($students as $student) {
                $s->update([
                    'grade_id' => $request->grade_id_new,
                    'classroom_id' => $request->classroom_id_new,
                    'entry_status' => 1
                ], $student->id);

                $this->promotion->create([
                    'student_id' => $student->id,
                    'from_grade_id' => $request->grade_id,
                    'from_classroom_id' => $request->classroom_id,
                    'to_grade_id' => $request->grade_id_new,
                    'to_classroom_id' => $request->classroom_id_new,
                ]);
            }
            return redirect()->back();
        }
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
