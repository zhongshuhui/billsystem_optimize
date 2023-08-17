<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class KillController extends Controller
{
    /**
     * @param Request $request
     * @return bool
     */
    public function test(Request $request): bool
    {
        $userId = rand(10000000,99999999);
        //1. 判断是否有库存
        $sumStock = Cache::get('sumStock',-1);
        var_dump($sumStock);
        if($sumStock=='-1'){
            $goods = Goods::find(1);
            Cache::set('sumStock',$goods->num);
        }
        if ($sumStock<1) {
            return false;
        }
        //3. 减库存  num>0
        $flag = DB::update("update ku_goods set num = num - 1 where num>0 AND id = 1");
        if (!$flag) {
            return false;
        }else{
            Cache::set('sumStock',$sumStock-1);
        }
        //4. 添加订单信息
        $order = new Order();
        $order->user_id = $userId;
        $order->goods_id = 1;
        $order->save();
        return true;
    }


    public function redis(){
    }
}
