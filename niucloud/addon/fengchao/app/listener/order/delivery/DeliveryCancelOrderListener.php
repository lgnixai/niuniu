<?php


namespace addon\fengchao\app\listener\order\delivery;

use addon\fengchao\app\service\core\CommonService;
use addon\fengchao\app\service\core\delivery\DeliveryLoader;
use app\service\core\sys\CoreConfigService;
use Exception;

/**
 * 取消订单事件
 */
class DeliveryCancelOrderListener
{
    public function handle($data)
    {
        $config = (new commonService())->getSiteDriver($data['data']['platform'])['params'];

        return (new DeliveryLoader($data['data']['platform'], $config))->cancelOrder($data['data']);
    }
}

