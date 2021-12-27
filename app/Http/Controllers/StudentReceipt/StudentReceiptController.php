<?php

namespace App\Http\Controllers\StudentReceipt;

use App\Http\Controllers\Controller;
use App\models\StudentAccount;
use App\repositories\Eloquent\FundAccountsRepository;
use App\repositories\Eloquent\StudentsRepository;
use App\repositories\StudentReceiptRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentReceiptController extends Controller
{
    private $studentReceipt;
    public function __construct(StudentReceiptRepositoryInterface $studentReceipt)
    {
        $this->studentReceipt = $studentReceipt;
    }

    public function index()
    {
        $receipts = $this->studentReceipt->getAll();
        return view('pages.student_receipt.index',compact(['receipts']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

//        return StudentAccount::select('debit')->sum('debit');//الجملة دي بتجيب مجموع قيم العمود كله
//        $debit = StudentAccount::where('student_id',4)->sum('debit');//مجموع المدين للطالب رقم 4
//        $credit = StudentAccount::where('student_id',4)->sum('credit');//مجموع الدائن للطالب رقم 4
//        return $debit - $credit;//الدئن ناقص المدين يعطيني الطالب عليه كام لسه
    public function store(Request $request,FundAccountsRepository $f)
    {
        DB::beginTransaction();
        $debit = StudentAccount::where('student_id',$request->student_id)->sum('debit');
        $credit = StudentAccount::where('student_id',$request->student_id)->sum('credit');
        $countStudent = StudentAccount::where('student_id',$request->student_id)->pluck('student_id');
        if(!count($countStudent) > 0 || $debit - $credit == 0)
        {
            toastr()->error(__('This student does not owe any money'));
            return redirect()->back();
        }else {
            try {
                $receipt_id = $this->studentReceipt->create($request->all());
                $f->create([
                    'date' => date('y-m-d'),
                    'receipt_id' => $receipt_id->id,
                    'debit' => $request->debit,
                    'credit' => '00.0',
                    'description' => $request->description
                ]);
                StudentAccount::create([
                    'student_id' => $request->student_id,
                    'receipt_id' => $receipt_id->id,
                    'type' => 'receipt',
                    'debit' => 00.0,
                    'credit' => $request->debit,
                ]);
                DB::commit();
                toastr()->success(__('Data saved successfully'));
                return redirect()->back();
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
        }
    }

    //create
    public function show($id,StudentsRepository $s)
    {
        $student = $s->getById($id);
        return view('pages.student_receipt.create',compact('student'));
    }


    public function edit($id)
    {
        $receipt = $this->studentReceipt->getById($id);
        return view('pages.student_receipt.edit',compact('receipt'));
    }


    public function update(Request $request, $id,FundAccountsRepository $f)
    {

        DB::beginTransaction();
        try {
            $this->studentReceipt->update($request->all(),$id);
            $fund_id = $f->getAll()->where('receipt_id',$id)->first()->id;
            $f->update([
                'debit' => $request->debit,
                'description' => $request->description
            ],$fund_id);

            $studentAccount = StudentAccount::where('receipt_id',$id);
            $studentAccount->update([
                'credit' => $request->debit,
            ]);
            DB::commit();
            toastr()->success(__('Data updated successfully'));
            return redirect()->back();
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try {
            $this->studentReceipt->destroy($id);
            toastr()->success(__('Data deleted successfully'));
            return redirect()->back();
        }catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
