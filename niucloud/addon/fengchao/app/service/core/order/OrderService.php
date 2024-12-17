<?php

namespace addon\fengchao\app\service\core\order;



use addon\fengchao\app\model\order\FengChaoOrder;


use core\base\BaseApiService;


/**
 *  订单服务层
 */
class OrderService extends BaseApiService
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new FengChaoOrder();
    }
    public function add(array $data)
    {

        $data['create_time'] = time();


        $res = $this->model->create($data);
        return $res->id;
    }
    public function update(array $data)
    {

        $data['update_time'] = time();
        $this->model->where([['order_id', '=', $data["order_id"]]])->update($data);
        return true;
    }

    public function getInfo(string $order_id)
    {
        $field = '*';

        $info = $this->model->field($field)->where([['order_id', '=', $order_id]])->findOrEmpty()->toArray();
        return $info;

    }









}
