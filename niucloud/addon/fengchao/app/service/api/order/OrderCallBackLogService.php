<?php

namespace addon\fengchao\app\service\api\order;

use addon\fengchao\app\model\order\Order;
use addon\fengchao\app\model\order\OrderCallBackLog;
use core\base\BaseApiService;

/**
 *  订单服务层
 */
class OrderCallBackLogService extends BaseApiService
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new OrderCallBackLog();
    }
    public function add(array $data)
    {

        $data['create_time'] = time();
        $res = $this->model->create($data);
        return $res->id;
    }






}
