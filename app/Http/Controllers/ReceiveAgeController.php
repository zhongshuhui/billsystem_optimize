<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReceiveAgeController extends Controller
{
    public function create(Request $request){
        echo 'ReceiveAgeController start';
        echo date('Y-m-d H:i:s');
        $month = $request->input('month',date('Y-m',strtotime('-1 month')));
        app('App\Services\Receive\AgeService',['inventoryDate'=>$month])->create();
        echo "<br/>";
        echo date('Y-m-d H:i:s');
        echo 'ReceiveAgeController end';
    }
}
