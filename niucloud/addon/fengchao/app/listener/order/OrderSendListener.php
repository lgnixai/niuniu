<?php


namespace addon\fengchao\app\listener\order;
use addon\fengchao\app\service\core\OrderService;
use think\facade\Log;

/**
 * 发单三方平台
 */
class OrderSendListener
{
    public function handle($order_id)
    {

        Log::write("订单发货事件---".$order_id.'---'.date("Y-m-d H:i:s").'------');
       (new OrderService())->sendOrder($order_id);
       return true;
    }
}

