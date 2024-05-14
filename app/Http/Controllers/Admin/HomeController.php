<?php

namespace App\Http\Controllers\Admin;

use App\Traits\SaveImgTrait;
use App\Http\Controllers\Controller;
use App\Models\SchoolData;
use App\repositories\GraduatedRepositoryInterface;
use App\repositories\StudentAccountRepositoryInterface;
use App\repositories\StudentRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use SaveImgTrait;

    public function admin(GraduatedRepositoryInterface $g,StudentAccountRepositoryInterface $s_a, StudentRepositoryInterface $student)
    {
        $g_count = $g->all([])->count();
        $school = SchoolData::all('name_ar','name_en');
        
        $sum = 0;
        foreach($student->myModel()->select('id')->get() as $student)
        {
            $debit = $student->StudentAccount->sum('debit');
            $credit = $student->StudentAccount->sum('credit');
            if($debit > $credit)
            {
                $sum += 1;
            }
        }
        return view('admin_dashboard.admin',compact('g_count','school','sum'));
        
    }


}
