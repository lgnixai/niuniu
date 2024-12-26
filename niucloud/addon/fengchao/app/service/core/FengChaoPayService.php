<?php

namespace addon\fengchao\app\service\core;

use addon\fengchao\app\model\pay\FengChaoPay;
use core\base\BaseApiService;
use core\exception\CommonException;
use think\Exception;
use function Symfony\Component\Translation\t;
use addon\fengchao\app\model\site\LinePrice;
/**
 *  快递鸟询价
 */
class FengChaoPayService extends BaseApiService
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new   FengChaoPay();
    }


    public function changeStatus($data)
    {

        $data['update_time'] = time();
        $this->model->where([['id', '=', $data["id"]]])->update($data);
        return true;
    }
    //获取支付订单信息
    public function  getInfoByOrderId($order_id)
    {
        $info=$this->model->where([['order_id', '=', $order_id],['trade_type', '=',1],['status', '=',2]])->findOrEmpty()->toArray();
        return $info;
    }




}
