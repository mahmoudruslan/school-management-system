<?php

namespace App\Http\Controllers\FeeProcessing;

use App\Http\Controllers\Controller;
use App\models\StudentAccount;
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
        $feeProcessing = $this->feeProcessing->getAll();
        return view('pages.fee_processing.index',compact('feeProcessing'));
    }




    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $debit = StudentAccount::where('student_id',$request->student_id)->sum('debit');
            $credit = StudentAccount::where('student_id',$request->student_id)->sum('credit');
            $countStudent = StudentAccount::where('student_id',$request->student_id)->pluck('student_id');
            if(!count($countStudent) > 0 || $debit - $credit == 0)
            {
                toastr()->error(__('This student does not owe any money'));
                return redirect()->back();
            }elseif ($request->amount + $credit > $debit)
            {
                toastr()->error(__('This student owes only ') .($debit - $credit). __(' pounds'));
                return redirect()->back();
            }
            $feeProcessing = $this->feeProcessing->create([
                'date' => date('y-m-d'),
                'student_id' => $request->student_id,
                'amount' => $request->amount,
                'description' => $request->description,
            ]);

            StudentAccount::create([
                'student_id' => $request->student_id,
                'fee_processing_id' => $feeProcessing->id,
                'type' => 'Fee exclusion',
                'debit' => '00.0',
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
    public function show($student_id,StudentsRepository $s)
    {
        $student = $s->getById($student_id);
        return view('pages.fee_processing.create',compact('student'));
    }


    public function edit($id)
    {
        $feeProcessing = $this->feeProcessing->getById($id);
        return view('pages.fee_processing.edit',compact('feeProcessing'));
    }


    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $debit = StudentAccount::where('student_id',$request->student_id)->sum('debit');
            $credit = StudentAccount::where('student_id',$request->student_id)->sum('credit');
            $currentAmount = $this->feeProcessing->getById($id);
            $countStudent = StudentAccount::where('student_id',$request->student_id)->pluck('student_id');
            if(!count($countStudent) > 0)
            {
                toastr()->error(__('This student does not owe any money'));
                return redirect()->back();
            }elseif ($request->amount + $credit > $debit + $currentAmount->amount)
            {
                toastr()->error(__('This student owes only ') .($debit - $credit + $currentAmount->amount). __(' pounds'));
                return redirect()->back();
            }
            $this->feeProcessing->update([
                'date' => date('y-m-d'),
                'amount' => $request->amount,
                'description' => $request->description,
            ],$id);
            $studentAccount = StudentAccount::where('fee_processing_id',$id);
            $studentAccount->update([
                'credit' => $request->amount,
            ]);
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
