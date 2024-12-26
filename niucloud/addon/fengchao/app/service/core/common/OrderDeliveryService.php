<?php

namespace addon\fengchao\app\service\core\common;

use addon\fengchao\app\model\order\OrderDelivery;
use addon\fengchao\app\model\order\OrderFee;
use addon\fengchao\app\model\site\LinePrice;
use core\base\BaseApiService;
use core\exception\CommonException;
use Exception;

use think\facade\Cache;

/**
 * 计算费用
 */
class OrderDeliveryService extends BaseApiService
{
    public function __construct()
    {
        parent::__construct();
        $this->model=new OrderDelivery();
    }
    public function getOrderIdByClient($order_id)
    {

        $info = $this->model->where([["site_id","=",$this->site_id],['client_order_code', '=', $order_id]])->findOrEmpty()->toArray();

        if (empty($info))
            throw new CommonException('获取客户订单号失败'.$order_id);

        return $info["order_id"];
    }
    public function getOrderInfoByClient($order_id)
    {

        $info = $this->model->where([["site_id","=",$this->site_id],['client_order_code', '=', $order_id]])->field('order_id,platform,client_order_code,service_order_code')->findOrEmpty()->toArray();

        if (empty($info))
            throw new CommonException('获取客户订单号失败'.$order_id);

        return $info;
    }
    public function getClientIdById($order_id)
    {

        $info = $this->model->where([['order_id', '=', $order_id]])->findOrEmpty()->toArray();


        if (empty($info))
            throw new CommonException('获取客户订单号失败'.'--'.$order_id);

        return $info["client_order_code"];
    }

    public function getLinePriceByOrderId($order_id)
    {

        $info = $this->model->where([['order_id', '=', $order_id]])->findOrEmpty()->toArray();
        $res = (new LinePrice())->where([['id', '=', $info['line_price_id']]])->findOrEmpty()->toArray();

        return $res;
    }


}