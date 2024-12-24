<?php


namespace addon\fengchao\app\listener\order;
use addon\fengchao\app\service\api\OrderService as ApiOrderService;
use addon\fengchao\app\service\core\CoreOrderService;

/**
 * 订单关闭
 */
class OrderCancelListener
{
    public function handle($data)
    {
        (new CoreOrderService())->RefundOrder($data);
    }
}
