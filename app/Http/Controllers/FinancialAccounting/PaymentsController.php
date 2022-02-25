<?php

namespace App\Http\Controllers\FinancialAccounting;

use App\Http\Controllers\Controller;
use App\repositories\Eloquent\FundAccountsRepository;
use App\repositories\Eloquent\StudentAccountsRepository;
use App\repositories\Eloquent\StudentsRepository;
use App\repositories\PaymentsRepositoryInterface;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    private $payment;
    public function __construct(PaymentsRepositoryInterface $payment)
    {
        $this->payment = $payment;
    }


    public function index()
    {
        $payments = $this->payment->getData();
        return view('pages.payments.index', compact('payments'));
    }



    public function store(Request $request, FundAccountsRepository $f, StudentAccountsRepository $sa)
    {
        $payment = $this->payment->create($request->all());
        $f->create([
            'payment_id' => $payment->id,
            'credit' => $request->amount,
            'description' => $request->description,
        ]);
        $sa->create([
            'student_id' => $request->student_id,
            'payment_id' => $payment->id,
            'type' => 'payment',
            'debit' => $request->amount,
        ]);
        return  redirect()->route('Payments.index');
    }


    public function show($id, StudentsRepository $s)
    {
        $student = $s->getById($id);
        return view('pages.payments.create', compact('student'));
    }


    public function edit($id)
    {
        $payment = $this->payment->getById($id);
        return view('pages.payments.edit', compact('payment'));
    }


    public function update(Request $request, $id, FundAccountsRepository $f, StudentAccountsRepository $sa)
    {

        $this->payment->update($request->all(), $id);

        $fund_id = $f->getData(['id', 'payment_id'])->where('payment_id', $id)->first()->id;

        $f->update([
            'credit' => $request->amount,
            'description' => $request->description
        ], $fund_id);

        $sa_id = $sa->where('payment_id', $id)->first()->id;
        $sa->update([
            'debit' => $request->amount,
        ], $sa_id);

        return  redirect()->route('Payments.index');
    }


    public function destroy($id)
    {
        $this->payment->destroy($id);
        return  redirect()->back();
    }
}
