<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeeInvoiceRequest;
use App\repositories\Eloquent\FeeRepository;
use App\repositories\Eloquent\StudentAccountRepository;
use App\repositories\Eloquent\StudentRepository;
use App\repositories\Eloquent\FeesInvoiceRepository;

class FeesInvoiceController extends Controller
{
    private $feesInvoices;
    public function __construct(FeesInvoiceRepository $feesInvoices)
    {
        $this->feesInvoices = $feesInvoices;
    }

    public function index()
    {
        $feeInvoices = $this->feesInvoices->all([],['id', 'fee_id', 'description', 'date', 'student_id']);
        return view('admin_dashboard.pages.fee_invoices.index', compact('feeInvoices'));
    }

    public function store(FeeInvoiceRequest $request, StudentAccountRepository $stu_account)
    {
        $list_feesInvoices = $request->list_feesInvoices;
        foreach ($list_feesInvoices as $feesInvoice) {
            $fee_invoice = $this->feesInvoices->create(
                $feesInvoice + ['grade_id' => $request->grade_id, 'classroom_id' => $request->classroom_id,]
            );
            //create in studentAccount table
            $stu_account->create([
                'student_id' => $feesInvoice['student_id'],
                'type' => 'invoice',
                'fee_id' => $feesInvoice['fee_id'],
                'debit' => $fee_invoice->fees->amount,
                'fee_invoice_id' => $fee_invoice->id
            ]);
        }
        return redirect()->route('feesInvoices.index');
    }

    public function show($id, StudentRepository $s, FeeRepository $f)
    {
        $student = $s->getById($id);
        $fees = $f->all([])->where('grade_id', $student->grade->id)->where('classroom_id', $student->classroom->id);
        return view('admin_dashboard.pages.fee_invoices.create', compact('student', 'fees'));
    }

    public function edit($id, StudentRepository $s, FeeRepository $fee)
    {
        $feesInvoice = $this->feesInvoices->getById($id);
        $fees = $fee->all([],['id','name_ar', 'name_en', 'grade_id', 'classroom_id'])
        ->where('grade_id', $feesInvoice->grade_id)//grade fee
        ->where('classroom_id', $feesInvoice->classroom_id);//and classroom fee 
        return view('admin_dashboard.pages.fee_invoices.edit', compact(['feesInvoice', 'fees']));
    }

    public function update(FeeInvoiceRequest $request, $id, FeeRepository $fee, StudentAccountRepository $stu_account)
    {
        //update in feeInvoices
        $this->feesInvoices->update([
            'fee_id' => $request->fee_id,
            'description' => $request->description
        ], $id);
        //update in studentAccount
        $sa_id = $stu_account->where('fee_invoice_id', $id)->first()->id;
        $my_fee = $fee->getById($request->fee_id);
        $stu_account->update([
            'debit' => $my_fee->amount,
        ], $sa_id);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->feesInvoices->destroy($id);
        return redirect()->back();
    }
}
