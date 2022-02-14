<?php

namespace App\Http\Controllers\FinancialAccounting;

use App\Http\Controllers\Controller;
use App\repositories\Eloquent\FeesInvoicesRepository;
use App\repositories\Eloquent\StudentAccountsRepository;
use App\repositories\Eloquent\StudentsRepository;
use App\repositories\FeeProcessingRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeeProcessingController extends Controller
{
    private $feeProcessing;
    public function __construct(FeeProcessingRepositoryInterface $feeProcessing)
    {
        $this->feeProcessing = $feeProcessing;
    }

    public function index()
    {
        $feeProcessing = $this->feeProcessing->getData();
        return view('pages.fee_processing.index',compact('feeProcessing'));
    }

    public function store(Request $request,StudentAccountsRepository $sa)
    {
        DB::beginTransaction();
        try {
            $where = $sa->where('student_id',$request->student_id);
            $debit = $where->sum('debit');//student debit
            $credit = $where->sum('credit');//student credit

            //number of student bills
            $countStudent = $where->pluck('student_id');
            if(!count($countStudent) > 0 || $debit - $credit == 0)
            {
                toastr()->error(__('This student does not owe any money'));
                return redirect()->back();
            }elseif ($request->amount + $credit > $debit)
            {
                toastr()->error(__('This student owes only ') .($debit - $credit). __(' pounds'));
                return redirect()->back();
            }
            $feeProcessing = $this->feeProcessing->create($request->all());
            $sa->create([
                'student_id' => $request->student_id,
                'fee_processing_id' => $feeProcessing->id,
                'type' => 'Fee exclusion',
                'credit' => $request->amount,
            ]);

            DB::commit();
            toastr()->success(__('Data saved successfully'));
             return  redirect()->route('FeeProcessing.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    //create
    public function show($student_id,StudentsRepository $s,FeesInvoicesRepository $f)
    {
        $feeInvoices = $f->getData('student_id')->where('student_id',$student_id);
        $student = $s->getById($student_id);
        return view('pages.fee_processing.create',compact('student','feeInvoices'));
    }


    public function edit($id)
    {
        $feeProcessing = $this->feeProcessing->getById($id);
        return view('pages.fee_processing.edit',compact('feeProcessing'));
    }


    public function update(Request $request, $id,StudentAccountsRepository $sa)
    {
        DB::beginTransaction();
        try {
            $where = $sa->where('student_id',$request->student_id);
            $debit = $where->sum('debit');//student debit
            $credit = $where->sum('credit');//student credit
            //number of student bills
            $countStudent = $where->pluck('student_id');
            $currentAmount = $this->feeProcessing->getById($id);
            if(!count($countStudent) > 0)
            {
                toastr()->error(__('This student does not owe any money'));
                return redirect()->back();
            }elseif ($request->amount + $credit > $debit + $currentAmount->amount)
            {
                toastr()->error(__('This student owes only ') .($debit - $credit + $currentAmount->amount). __(' pounds'));
                return redirect()->back();
            }
            $this->feeProcessing->update($request->all(),$id);

            $sa_id = $sa->where('fee_processing_id',$id)->first()->id;
            $sa->update([
                'credit' => $request->amount,
            ],$sa_id);

            DB::commit();
            toastr()->success(__('Data updated successfully'));
            return  redirect()->route('FeeProcessing.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try {
            $this->feeProcessing->destroy($id);
            toastr()->success(__('Data deleted successfully'));
            return  redirect()->route('FeeProcessing.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
