<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeeRequest;
use App\repositories\Eloquent\FeesInvoicesRepository;
use App\repositories\Eloquent\StudentAccountsRepository;
use App\repositories\FeesRepositoryInterface;
use App\repositories\GradesRepositoryInterface;
use App\repositories\StudentsRepositoryInterface;


class FeeController extends Controller
{
    private $fee;
    public function __construct(FeesRepositoryInterface $fee)
    {
        $this->fee = $fee;
    }

    public function index()
    {
        $fees = $this->fee->getData();
        return view('pages.fees.index', compact('fees'));
    }


    public function create(GradesRepositoryInterface $g)
    {
        $grades = $g->getData();
        return view('pages.fees.create', compact('grades'));
    }


    public function store(FeeRequest $request, StudentAccountsRepository $s_a, FeesInvoicesRepository $f_i, StudentsRepositoryInterface $s)
    {
            if ($request->all_student == '1') //if you want add the fee to all srudent
            {
                $fee = $this->fee->create($request->all()); //insert in fees table

                $students = $s->myModel()
                    ->where('grade_id', $request->grade_id)
                    ->where('classroom_id', $request->classroom_id)
                    ->select('id')->get();

                foreach ($students as $student) {
                    $fee_invoice = $f_i->create([ //insert in fee_incoices table
                        'date' => date('Y-m-d'),
                        'student_id' => $student->id,
                        'grade_id' => $request->grade_id,
                        'classroom_id' => $request->classroom_id,
                        'fee_id' => $fee->id,
                    ]);

                    $s_a->create([ //insert in student_account table
                        'student_id' => $student->id,
                        'type' => 'invoice',
                        'fee_id' => $fee->id,
                        'debit' => $request->amount,
                        'fee_invoice_id' => $fee_invoice->id
                    ]);
                }
                return redirect()->back();
            } else {
                $this->fee->create($request->all());
                return redirect()->back();
            }

    }


    public function edit($id, GradesRepository $g)
    {
        $grades = $g->getData();
        $fee = $this->fee->getById($id);
        return view('pages.fees.edit', compact(['fee', 'grades']));
    }


    public function update(FeeRequest $request, $id)
    {
            $this->fee->update($request->all(), $id);
            return redirect()->route('Fees.index');

    }



    public function destroy($id, FeesInvoicesRepository $fi)
    {
        try {
            $feeInvoices = $fi->getData('fee_id')->where('fee_id', $id)->pluck('id');
            if (count($feeInvoices) > 0) {
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
