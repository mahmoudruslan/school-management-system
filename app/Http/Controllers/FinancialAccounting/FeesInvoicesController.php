<?php

namespace App\Http\Controllers\FinancialAccounting;

use App\Http\Controllers\Controller;
use App\repositories\Eloquent\FeesRepository;
use App\repositories\Eloquent\StudentAccountsRepository;
use App\repositories\Eloquent\StudentsRepository;
use App\repositories\FeesInvoicesRepositoryInterface;
use Illuminate\Http\Request;

class FeesInvoicesController extends Controller
{
    private $feesInvoices;
    public function __construct(FeesInvoicesRepositoryInterface $feesInvoices)
    {
        $this->feesInvoices = $feesInvoices;
    }

    public function index()
    {
        $feeInvoices = $this->feesInvoices->getData(['id', 'fee_id', 'description', 'date', 'student_id']);
        return view('pages.fee_invoices.index', compact('feeInvoices'));
    }

    public function store(Request $request, FeesRepository $f, StudentAccountsRepository $sa)
    {
        //create in feeInvoices table
        $list_feesInvoices = $request->list_feesInvoices;
        foreach ($list_feesInvoices as $list_feesInvoice) {
            $fee_invoice_id = $this->feesInvoices->create(
                $list_feesInvoice + ['grade_id' => $request->grade_id, 'classroom_id' => $request->classroom_id,]
            );
            $fee = $f->getById($list_feesInvoice['fee_id']); //to get fee amount
            //create in studentAccount table
            $sa->create([
                'student_id' => $list_feesInvoice['student_id'],
                'type' => 'invoice',
                'fee_id' => $list_feesInvoice['fee_id'],
                'debit' => $fee->amount,
                'fee_invoice_id' => $fee_invoice_id->id
            ]);
        }
        return redirect()->route('FeesInvoices.index');
    }


    public function show($id, StudentsRepository $s, FeesRepository $f)
    {
        $student = $s->getById($id);
        $fees = $f->getData()->where('grade_id', $student->grades->id)->where('classroom_id', $student->classrooms->id);
        return view('pages.fee_invoices.create', compact('student', 'fees'));
    }


    public function edit($id, StudentsRepository $s, FeesRepository $f)
    {
        $feesInvoice = $this->feesInvoices->getById($id);
        $student = $s->getById($feesInvoice->student_id);
        $fees = $f->getData(['name_ar', 'name_en', 'grade_id', 'classroom_id'])->where('grade_id', $student->grades->id)->where('classroom_id', $student->classrooms->id);
        return view('pages.fee_invoices.edit', compact(['student', 'fees', 'feesInvoice']));
    }


    public function update(Request $request, $id, FeesRepository $f, StudentAccountsRepository $sa)
    {

        //update in feeInvoices
        $this->feesInvoices->update([
            'fee_id' => $request->fee_id,
            'description' => $request->description
        ], $id);
        //update in studentAccount
        $sa_id = $sa->where('fee_invoice_id', $id)->first()->id;
        $fee = $f->getById($request->fee_id);
        $sa->update([
            'debit' => $fee->amount,
        ], $sa_id);
        return redirect()->back();
    }


    public function destroy($id)
    {
        $this->feesInvoices->destroy($id);
        return redirect()->back();
    }
}
