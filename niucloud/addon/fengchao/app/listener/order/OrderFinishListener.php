<?php


namespace addon\fengchao\app\listener\order;
use addon\fengchao\app\service\core\OrderFinishService;
/**
 * 订单关闭
 */
class OrderFinishListener
{
    public function handle($data)
    {
        (new OrderFinishService())->orderFinish($data);
        return true;
    }
}
