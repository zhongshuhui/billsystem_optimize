<?php

namespace App\Services\Receive;

use Illuminate\Support\Facades\DB;

class AgeService
{

    protected $db;
    protected $minDlyDate = '2023-01-01';
    protected $minBillDate = '2022-01-01';
    protected $minHappenDate;
    protected $inventoryDate;

    function __construct($inventoryDate)
    {
        $this->inventoryDate = $inventoryDate.'-01';
        $this->db = DB::connection('billsystem');
        $this->minHappenDate = date('Y-m-01', strtotime($this->inventoryDate . ' -5 month'));
        if (strtotime($this->minHappenDate) < strtotime($this->minDlyDate)) {
            $this->minHappenDate = $this->minDlyDate;
        }
    }

    public function create()
    {
        $service = app('App\Services\CommonService');
        $plats = $service->getPlats();
        $nextMonthDay = date('Y-m-01', strtotime($this->inventoryDate . '+1 month'));
        foreach ($plats as $plat) {
            $tableSuffix = $service->getTableSuffixByPlat($plat);
            $sql = "
INSERT INTO `receivable_age`( `stop_date`, `platform`, `site`, `account_name`, `platform_order_sn`, `end_rmb_balance`, `age_of_delivery`)
SELECT '$nextMonthDay' `inventory_date`, `platform`, `site`, `account_name`, `platform_order_sn`, `end_rmb_balance`, `age_of_delivery`
FROM receivable_age_$tableSuffix
where inventory_date = '" . $this->inventoryDate . "' AND hade_delivery=1
AND platform_order_sn in (
SELECT platform_order_sn FROM event_flow_$tableSuffix WHERE happen_time>='" . $this->minHappenDate . "' AND happen_time<='$nextMonthDay' AND event_id=1)
AND platform_order_sn not in (
SELECT platform_order_sn FROM event_flow_$tableSuffix WHERE happen_time>='" . $this->minBillDate . "' AND happen_time<='$nextMonthDay' AND event_id IN (4,5,12)
    )";
            $this->db->select($sql);
        }
    }


}
