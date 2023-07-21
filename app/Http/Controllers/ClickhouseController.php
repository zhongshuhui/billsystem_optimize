<?php

namespace App\Http\Controllers;

use App\Tool\Clickhouse;
use Illuminate\Http\Request;

class ClickhouseController extends Controller
{
    public function test(){
        $db = Clickhouse::getDb();
        print_r($db->ping());
    }
}
