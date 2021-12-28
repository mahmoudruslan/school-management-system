<?php

namespace App\Http\Controllers\FinancialAccounting;

use App\Http\Controllers\Controller;
use App\models\StudentAccount;
use App\repositories\Eloquent\FundAccountsRepository;
use App\repositories\Eloquent\StudentAccountsRepository;
use App\repositories\Eloquent\StudentsRepository;
use App\repositories\PaymentsRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentsController extends Controller
{
    private $payment;
    public function __construct(PaymentsRepositoryInterface $payment)
    {
        $this->payment = $payment;
    }


    public function index()
    {
        $payments = $this->payment->getAll();
        return view('pages.payments.index',compact('payments'));
    }



    public function store(Request $request,FundAccountsRepository $f,StudentAccountsRepository $sa)
    {
        DB::beginTransaction();
        try {
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

            DB::commit();
            toastr()->success(__('Data saved successfully'));
            return  redirect()->route('Payments.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function show($id,StudentsRepository $s)
    {
        $student = $s->getById($id);
        return view('pages.payments.create',compact('student'));
    }


    public function edit($id)
    {
        $payment = $this->payment->getById($id);
        return view('pages.payments.edit',compact('payment'));
    }


    public function update(Request $request, $id,FundAccountsRepository $f,StudentAccountsRepository $sa)
    {

        DB::beginTransaction();
        try {

            $this->payment->update($request->all(),$id);

            $fund_id = $f->getAll()->where('payment_id',$id)->first()->id;

            $f->update([
                'credit' => $request->amount,
                'description' => $request->description
            ],$fund_id);

            $sa_id = $sa->where('payment_id',$id)->first()->id;
            $sa->update([
                'debit' => $request->amount,
            ],$sa_id);

            DB::commit();
            toastr()->success(__('Data updated successfully'));
            return  redirect()->route('Payments.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try {
            $this->payment->destroy($id);
            toastr()->success(__('Data deleted successfully'));
            return  redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
