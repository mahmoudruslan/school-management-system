<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\repositories\Eloquent\FundAccountRepository;
use App\repositories\Eloquent\StudentAccountRepository;
use App\repositories\Eloquent\StudentReceiptRepository;
use App\repositories\Eloquent\StudentRepository;
use Illuminate\Http\Request;

class StudentReceiptController extends Controller
{
    private $studentReceipt;
    public function __construct(StudentReceiptRepository $studentReceipt)
    {
        $this->studentReceipt = $studentReceipt;
    }

    public function index()
    {
        $receipts = $this->studentReceipt->all([]);
        return view('admin_dashboard.pages.student_receipt.index', compact(['receipts']));
    }

    public function store(Request $request, FundAccountRepository $fund_account, StudentAccountRepository $stu_account)
    {

        $student_account = $stu_account->where('student_id', $request->student_id);
        $debit = $student_account->sum('debit');
        $credit = $student_account->sum('credit'); 

        //number of student bills
        $countStudent = $student_account->count();

        if (!$countStudent > 0 || $debit - $credit == 0) {
            toastr()->error(__('This student does not owe any money'));
            return redirect()->back();
        } elseif ($request->debit > $debit - $credit) //check if the amount bigger than debit account
        {
            toastr()->error(__('This student owes only ') . ($debit - $credit) . __(' pounds'));
            return redirect()->back();
        }
        //create in student_receipt table
        $receipt_id = $this->studentReceipt->create($request->all());
        //create in fund_account table
        $fund_account->create([
            'receipt_id' => $receipt_id->id,
            'debit' => $request->debit,
            'description' => $request->description
        ]);
        //create in student_account table
        $stu_account->create([
            'student_id' => $request->student_id,
            'receipt_id' => $receipt_id->id,
            'type' => 'receipt',
            'credit' => $request->debit,
        ]);
        return redirect()->route('studentReceipt.index');
    }

    //create function
    public function show($id, StudentRepository $s)
    {
        $student = $s->getById($id);
        return view('admin_dashboard.pages.student_receipt.create', compact('student'));
    }

    public function edit($id)
    {
        $receipt = $this->studentReceipt->getById($id);
        return view('admin_dashboard.pages.student_receipt.edit', compact('receipt'));
    }

    public function update(Request $request, $id, FundAccountRepository $fund_account, StudentAccountRepository $stu_account)
    {

        //update in student_receipt table
        $this->studentReceipt->update($request->all(), $id);

        $fund_id = $fund_account->all([],['id', 'receipt_id'])->where('receipt_id', $id)->first()->id;

        //update in fund_account table
        $fund_account->update([
            'debit' => $request->debit,
            'description' => $request->description
        ], $fund_id);

        //update in student_account table
        $sa_id = $stu_account->where('receipt_id', $id)->first()->id;
        $stu_account->update([
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
