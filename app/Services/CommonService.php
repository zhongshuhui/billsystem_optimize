<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class CommonService
{
    public function getPlats()
    {
        $sql = "SELECT `platform_code` FROM `config_close_account` WHERE `month`= '2023-02'";
        $accounts = DB::connection('billsystem')->select($sql);
        $platform_code_list = array_column($accounts, 'platform_code');
        foreach ($platform_code_list as $key => $platform) {
            if ($platform == 'EBAY,SHOPIFY,SHOPLINE,SHOPYY,XSHOPPY,SHOPLAZZA') {
                unset($platform_code_list[$key]);
            }
        }
        $platform_code_list[] = 'EBAY';
        $platform_code_list[] = 'SHOPIFY';
        $platform_code_list[] = 'SHOPLINE';
        $platform_code_list[] = 'SHOPYY';
        $platform_code_list[] = 'XSHOPPY';
        $platform_code_list[] = 'SHOPLAZZA';
        return $platform_code_list;
    }




    public function getTableSuffixByPlat($plat){
        if($plat=='亚马逊'){
            $table_plat='amazon';
        }elseif ($plat=='京东沃尔玛'){
            $table_plat='jw';
        }elseif ($plat=='速卖通'){
            $table_plat='smt';
        }elseif ($plat == '乐天') {
            $table_plat = 'rakuten';
        }elseif (strtolower($plat) == 'real.de') {
            $table_plat = 'realde';
        }else{
            $table_plat=trim(strtolower($plat));
        }
        return $table_plat;
    }
}
