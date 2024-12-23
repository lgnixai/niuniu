<?php
/**
 * 作者: TK  微信：addon888
 * 日期: 2024/12/3
 * 时间: 上午8:05
 */
namespace addon\fengchao\app\listener\order\delivery;
use addon\fengchao\app\service\core\WeappDeliveryService;

class DeliveryUploadAddListener{
    public function handle($data)
    {
        //order_id  site_id
        return (new WeappDeliveryService())->uploadShippingInfoAdd($data);
    }
}