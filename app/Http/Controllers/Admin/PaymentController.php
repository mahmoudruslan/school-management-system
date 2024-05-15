<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\repositories\Eloquent\FundAccountRepository;
use App\repositories\Eloquent\StudentAccountRepository;
use App\repositories\Eloquent\StudentRepository;
use App\repositories\Eloquent\PaymentRepository;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $payment;
    public function __construct(PaymentRepository $payment)
    {
        $this->payment = $payment;
    }

    public function index()
    {
        $payments = $this->payment->all([]);
        return view('admin_dashboard.pages.payments.index', compact('payments'));
    }

    public function store(Request $request, FundAccountRepository $f, StudentAccountRepository $stu_account)
    {
        $payment = $this->payment->create($request->all());
        $f->create([
            'payment_id' => $payment->id,
            'credit' => $request->amount,
            'description' => $request->description,
        ]);
        $stu_account->create([
            'student_id' => $request->student_id,
            'payment_id' => $payment->id,
            'type' => 'payment',
            'debit' => $request->amount,
        ]);
        return  redirect()->route('payments.index');
    }


    public function show($id, StudentRepository $s)
    {
        $student = $s->getById($id);
        return view('admin_dashboard.pages.payments.create', compact('student'));
    }


    public function edit($id)
    {
        $payment = $this->payment->getById($id);
        return view('admin_dashboard.pages.payments.edit', compact('payment'));
    }


    public function update(Request $request, $id, FundAccountRepository $fund_account, StudentAccountRepository $stu_account)
    {

        $this->payment->update($request->all(), $id);

        $fund_id = $fund_account->all([],['id', 'payment_id'])->where('payment_id', $id)->first()->id;

        $fund_account->update([
            'credit' => $request->amount,
            'description' => $request->description
        ], $fund_id);

        $sa_id = $stu_account->where('payment_id', $id)->first()->id;
        $stu_account->update([
            'debit' => $request->amount,
        ], $sa_id);

        return  redirect()->route('payments.index');
    }

    public function destroy($id)
    {
        $this->payment->destroy($id);
        return  redirect()->back();
    }
}
