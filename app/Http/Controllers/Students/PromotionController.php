<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\models\Promotion;
use App\models\Student;
use App\repositories\Eloquent\GradesRepository;
use App\repositories\Eloquent\StudentsRepository;
use App\repositories\PromotionsRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class PromotionController extends Controller
{
    private $promotion;

    public function __construct(PromotionsRepositoryInterface $promotion)
    {
        $this->promotion = $promotion;
    }

    public function index()
    {
        $promotions = $this->promotion->getAll();
        return view('pages.students.promotions.promotions', compact(['promotions']));
    }


    public function create(GradesRepository $g)
    {
        $grades = $g->getAll();
        return view('pages.students.promotions.create', compact('grades'));
    }


    public function store(Request $request, StudentsRepository $s)
    {
        //DB::beginTransaction();
        try {

            $students = $s->getAll()
                ->where('grade_id', $request->grade_id)
                ->where('classroom_id', $request->classroom_id)
                ->where('section_id', $request->section_id);
            if (count($students) > 0) {
                foreach ($students as $student) {
                    $s->update([
                        'grade_id' => $request->grade_id_new,
                        'classroom_id' => $request->classroom_id_new ?? null,
                        'section_id' => $request->section_id_new ?? null,
                        'entry_status' => 1
                    ],$student->id);

                    $this->promotion->create([
                        'student_id' => $student->id,
                        'from_grade_id' => $request->grade_id,
                        'from_classroom_id' => $request->classroom_id,
                        'from_section_id' => $request->section_id,
                        'to_grade_id' => $request->grade_id_new,
                        'to_classroom_id' => $request->classroom_id_new,
                        'to_section_id' => $request->section_id_new
                        ]);
                }
                toastr()->success(__('Data saved successfully'));
                return redirect()->back();
            }
            //DB::commit();
                toastr()->error(__('There are no students at the stage'));
                return redirect()->back();

        } catch (\Exception $e) {
            //DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy(Request $request,StudentsRepository $s)
    {
        DB::beginTransaction();
        try {
            $ids = explode(",", $request->ids);
            foreach ($ids as $id) {
                $promotion = $this->promotion->getById($id);
                //foreach ($promotions as $promotion) {
                    $student = $s->getById($promotion->student_id);
                    $student->update([
                        'grade_id' => $promotion->from_grade_id,
                        'classroom_id' => $promotion->from_classroom_id,
                        'section_id' => $promotion->from_section_id,
                        'entry_status' => 0
                    ]);
                    $this->promotion->destroy($promotion->id);
                //}
            }
            DB::commit();
            toastr()->success(__('Data deleted successfully'));
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

}
