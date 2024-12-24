<?php


namespace addon\fengchao\app\listener\order\delivery;

use addon\fengchao\app\service\core\CommonService;
use addon\fengchao\app\service\core\delivery\DeliveryLoader;
use app\service\core\sys\CoreConfigService;
use Exception;

/**
 * 查询订单事件
 */
class DeliveryComplaintViewOrderListener
{
    public function handle($data)
    {
        $config = (new commonService())->getSiteDriver($data['data']['platform'])['params'];

        return (new DeliveryLoader($data['data']['platform'], $config))->complaintViewOrder($data['data']);
    }
}

