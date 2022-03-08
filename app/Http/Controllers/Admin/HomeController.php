<?php

namespace App\Http\Controllers\Admin;

use App\Traits\SaveImgTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use SaveImgTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('dashboard');
    // }




    public function admin()
    {
        return view('dashboards.admin.admin');
        
    }



    //save parents and students attachment
    public function saveAttachments(Request $request,$id): RedirectResponse
    {
            $this->saveimg('attachments/'.$request->model .'s/'. $request->name_ar, $id, 'App\models\\'.$request->model, $request->photos);
            toastr()->success(__('success'));
            return redirect()->back();
    }

    //delete parents and students attachment
    public function deleteAttachments(Request $request,$id):RedirectResponse
    {
            $this->deleteFiles($request->model.'s/'.$request->name_ar,$request->filename,$id);
            toastr()->success(__('Deleted successfully'));
            return redirect()->back();
    }


}
