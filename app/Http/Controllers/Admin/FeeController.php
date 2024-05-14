<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeeRequest;
use App\repositories\Eloquent\FeesInvoiceRepository;
use App\repositories\Eloquent\GradeRepository;
use App\repositories\Eloquent\StudentAccountRepository;
use App\repositories\FeeRepositoryInterface;
use App\repositories\GradeRepositoryInterface;
use App\repositories\StudentRepositoryInterface;


class FeeController extends Controller
{
    private $fee;
    public function __construct(FeeRepositoryInterface $fee)
    {
        $this->fee = $fee;
    }

    public function index()
    {
        $fees = $this->fee->all([]);
        return view('admin_dashboard.pages.fees.index', compact('fees'));
    }

    public function create(GradeRepositoryInterface $g)
    {
        $grades = $g->all([]);
        return view('admin_dashboard.pages.fees.create', compact('grades'));
    }

    public function store(
        FeeRequest $request, 
        StudentAccountRepository $stu_a, 
        FeesInvoiceRepository $fee_i, 
        StudentRepositoryInterface $stu)
    {
        $fee = $this->fee->create($request->all());
            if ($request->all_student == '1') //if you want add the fee to all students
            {
                $student_ids = $stu->myModel()
                    ->where('grade_id', $request->grade_id)
                    ->where('classroom_id', $request->classroom_id)
                    ->select('id')->pluck('id');

                foreach ($student_ids as $student_id) {
                    $fee_invoice = $fee_i->create([ //insert in fee_invoices table
                        'date' => date('Y-m-d'),
                        'student_id' => $student_id,
                        'grade_id' => $request->grade_id,
                        'classroom_id' => $request->classroom_id,
                        'fee_id' => $fee->id,
                    ]);
                    $stu_a->create([ //insert in student_account table
                        'student_id' => $student_id,
                        'type' => 'invoice',
                        'fee_id' => $fee->id,
                        'debit' => $request->amount,
                        'fee_invoice_id' => $fee_invoice->id
                    ]);
                }
            } 
            return redirect()->route('fees.index');
    }


    public function edit($id, GradeRepository $grade)
    {
        $grades = $grade->all([]);
        $fee = $this->fee->getById($id);
        return view('admin_dashboard.pages.fees.edit', compact(['fee', 'grades']));
    }

    public function update(FeeRequest $request, $id)
    {
            $this->fee->update($request->all(), $id);
            return redirect()->route('fees.index');
    }

    public function destroy($id, FeesInvoiceRepository $fee_invoice)
    {
        try {
            $feeInvoices = $fee_invoice->all([],'fee_id')->where('fee_id', $id)->pluck('id');
            if (count($feeInvoices) > 0) {// لو كانت الرسوم دي اتضافت فى فواتير على الطلاب مش هتتمسح
                toastr()->error(__('These fees have been added to some students before, so they cannot be deleted '));
                return redirect()->back();
            }
            $this->fee->destroy($id);
            toastr()->success(__('Data deleted successfully'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
