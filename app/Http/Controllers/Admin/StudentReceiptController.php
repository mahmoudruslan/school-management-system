<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\repositories\FundAccountRepositoryInterface;
use App\repositories\StudentAccountRepositoryInterface;
use App\repositories\StudentReceiptRepositoryInterface;
use App\repositories\StudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentReceiptController extends Controller
{
    private $studentReceipt;
    public function __construct(StudentReceiptRepositoryInterface $studentReceipt)
    {
        $this->studentReceipt = $studentReceipt;
    }

    public function index()
    {
        $receipts = $this->studentReceipt->getData();
        return view('admin_dashboard.pages.student_receipt.index', compact(['receipts']));
    }

    public function store(Request $request, FundAccountRepositoryInterface $f, StudentAccountRepositoryInterface $sa)
    {

        $where = $sa->where('student_id', $request->student_id);
        $debit = $where->sum('debit'); //student debit
        $credit = $where->sum('credit'); //student credit

        //number of student bills
        $countStudent = $where->pluck('student_id');

        if (!count($countStudent) > 0 || $debit - $credit == 0) {
            toastr()->error(__('This student does not owe any money'));
            return redirect()->route('students.index');
        } elseif ($request->debit > $debit - $credit) //check if the amount bigger than debit account
        {
            toastr()->error(__('This student owes only ') . ($debit - $credit) . __(' pounds'));
            return redirect()->back();
        }
        //create in student_receipt table
        $receipt_id = $this->studentReceipt->create($request->all());
        //create in fund_account table
        $f->create([
            'receipt_id' => $receipt_id->id,
            'debit' => $request->debit,
            'description' => $request->description
        ]);
        //create in student_account table
        $sa->create([
            'student_id' => $request->student_id,
            'receipt_id' => $receipt_id->id,
            'type' => 'receipt',
            'credit' => $request->debit,
        ]);
        return redirect()->route('studentReceipt.index');
    }

    //create function
    public function show($id, StudentRepositoryInterface $s)
    {
        $student = $s->getById($id);
        return view('admin_dashboard.pages.student_receipt.create', compact('student'));
    }

    public function edit($id)
    {
        $receipt = $this->studentReceipt->getById($id);
        return view('admin_dashboard.pages.student_receipt.edit', compact('receipt'));
    }

    public function update(Request $request, $id, FundAccountRepositoryInterface $f, StudentAccountRepositoryInterface $sa)
    {

        //update in student_receipt table
        $this->studentReceipt->update($request->all(), $id);

        $fund_id = $f->getData(['id', 'receipt_id'])->where('receipt_id', $id)->first()->id;

        //update in fund_account table
        $f->update([
            'debit' => $request->debit,
            'description' => $request->description
        ], $fund_id);

        //update in student_account table
        $sa_id = $sa->where('receipt_id', $id)->first()->id;
        $sa->update([
            'credit' => $request->debit,
        ], $sa_id);

        return redirect()->route('studentReceipt.index');
    }

    public function destroy($id)
    {
        $this->studentReceipt->destroy($id);
        return redirect()->back();
    }
}
