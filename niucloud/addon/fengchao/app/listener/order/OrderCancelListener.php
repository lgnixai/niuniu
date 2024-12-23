<?php


namespace addon\fengchao\app\listener\order;
use addon\fengchao\app\service\api\OrderService as ApiOrderService;
/**
 * 订单关闭
 */
class OrderCancelListener
{
    public function handle($data)
    {
        (new ApiOrderService())->applyRefund($data);
    }
}
