<?php

namespace App\Http\Controllers;

use App\models\ParentsAttachments;
use App\Traits\SaveImgTrait;
use Illuminate\Http\Request;

class TestController extends Controller
{

    use SaveImgTrait;

    public function store(Request $request){



        $name_photo = $this->saveimg($request->name,'images/offer2');

        ParentsAttachments::create([
            'name' => $name_photo,
            'parents_id' => 5
        ]);
        return 'true';
    }
}
