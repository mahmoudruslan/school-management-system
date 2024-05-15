<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\repositories\Eloquent\FeesInvoiceRepository;
use App\repositories\Eloquent\StudentAccountRepository;
use App\repositories\Eloquent\StudentRepository;
use App\repositories\Eloquent\FeeProcessingRepository;
use Illuminate\Http\Request;

class FeeProcessingController extends Controller
{
    private $feeProcessing;
    public function __construct(FeeProcessingRepository $feeProcessing)
    {
        $this->feeProcessing = $feeProcessing;
    }

    public function index()
    {
        $feeProcessing = $this->feeProcessing->all([]);
        return view('admin_dashboard.pages.fee_processing.index', compact('feeProcessing'));
    }

    public function store(Request $request, StudentAccountRepository $stu_account)
    {
        $student_account = $stu_account->where('student_id', $request->student_id);
        $debit = $student_account->sum('debit'); //student debit
        $credit = $student_account->sum('credit'); //student credit

        //number of student bills
        $countStudent = $student_account->pluck('student_id');
        if (count($countStudent) < 1|| $debit - $credit == 0) {//if student doesn't have accounts or is not in debit
            toastr()->error(__('This student does not owe any money'));
            return redirect()->back();
        } elseif ($request->amount + $credit > $debit) {// لو كان المبلغ الليي هيتم اسبعاده من على الطالب اكبر من اللى الطالب مدين بيه
            toastr()->error(__('This student owes only ') . ($debit - $credit) . __(' pounds'));
            return redirect()->back();
        }
        $feeProcessing = $this->feeProcessing->create($request->all());
        $student_account->create([
            'student_id' => $request->student_id,
            'fee_processing_id' => $feeProcessing->id,
            'type' => 'Fee exclusion',
            'credit' => $request->amount,
        ]);
        return  redirect()->route('feeProcessing.index');
    }

    //create
    public function show($student_id, StudentRepository $s, FeesInvoiceRepository $f)
    {
        $feeInvoices = $f->all([],'student_id')->where('student_id', $student_id);
        $student = $s->getById($student_id);
        return view('admin_dashboard.pages.fee_processing.create', compact('student', 'feeInvoices'));
    }


    public function edit($id)
    {
        $feeProcessing = $this->feeProcessing->getById($id);
        return view('admin_dashboard.pages.fee_processing.edit', compact('feeProcessing'));
    }


    public function update(Request $request, $id, StudentAccountRepository $sa)
    {
        $where = $sa->where('student_id', $request->student_id);
        $debit = $where->sum('debit'); //student debit
        $credit = $where->sum('credit'); //student credit
        //number of student bills
        $countStudent = $where->pluck('student_id');
        $currentAmount = $this->feeProcessing->getById($id);
        if (!count($countStudent) > 0) {
            toastr()->error(__('This student does not owe any money'));
            return redirect()->back();
        } elseif ($request->amount + $credit > $debit + $currentAmount->amount) {
            toastr()->error(__('This student owes only ') . ($debit - $credit + $currentAmount->amount) . __(' pounds'));
            return redirect()->back();
        }
        $this->feeProcessing->update($request->all(), $id);

        $sa_id = $sa->where('fee_processing_id', $id)->first()->id;
        $sa->update([
            'credit' => $request->amount,
        ], $sa_id);
        return  redirect()->route('feeProcessing.index');
    }


    public function destroy($id)
    {
        $this->feeProcessing->destroy($id);
        return  redirect()->route('feeProcessing.index');
    }
}
