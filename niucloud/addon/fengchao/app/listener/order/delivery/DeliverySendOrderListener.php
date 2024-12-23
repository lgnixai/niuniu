<?php


namespace addon\fengchao\app\listener\order\delivery;

use addon\fengchao\app\service\core\CommonService;
use addon\fengchao\app\service\core\delivery\DeliveryLoader;
/**
 * 提交订单事件
 */
class DeliverySendOrderListener
{
    public function handle($data)
    {
        $config = (new commonService())->getSiteDriver($data['data']['platform'])['params'];
        return (new DeliveryLoader($data['data']['platform'], $config))->sendOrder($data['data']);
    }
}

