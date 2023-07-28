<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\Order;
use App\Tool\Clickhouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ClickhouseController extends Controller
{
    public function test(){
        $db = Clickhouse::getDb();
        print_r($db->ping());
    }
}
