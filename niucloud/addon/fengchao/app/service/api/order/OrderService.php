<?php

namespace addon\fengchao\app\service\api\order;

use addon\fengchao\app\dict\delivery\DeliveryDict;
use addon\fengchao\app\dict\order\OrderDict;
use addon\fengchao\app\model\delivery\Store;
use addon\fengchao\app\model\order\FengChaoOrder;
use addon\fengchao\app\model\order\Order;
use addon\fengchao\app\model\order\OrderFee;
use app\model\pay\Pay;
use core\base\BaseApiService;
use think\db\Query;

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
        $this->model->where([['order_code', '=', $data["order_code"]]])->update($data);
        return true;
    }

    public function getInfo(string $order_code)
    {
        $field = 'id,site_id,price_data';

        $info = $this->model->field($field)->where([['order_code', '=', $order_code]])->findOrEmpty()->toArray();
        return $info;

    }
    /**
     * 分页列表
     * @param array $where
     * @return array
     */
    public function getPage(array $where)
    {
        $order = 'create_time desc';
        $field = 'id,order_id,order_money,order_status';

        $search_model=(new FengChaoOrder())
            ->alias('o')
            ->join('fengchao_order_delivery od', 'o.order_id = od.order_id')
            ->where([ [ 'o.site_id', '=', $this->site_id ] ])
            ->where('od.order_id|od.logistic_order_code|od.client_order_code', 'like', '%' . $where['order_code'] . '%')
            ->withSearch(['create_time' ], $where)
             ->field('o.*,od.*');

        $list = $this->pageQuery($search_model);

        foreach ($list['data'] as $key => $item) {
            if (isset($item['order_info'])) {

                $list['data'][$key]['order_info']  = json_decode($item['order_info'], true);
            }
        }

        return $list;
    }

    /**
     * 详情
     * @param int $order_id
     * @return array
     */
    public function getDetail(string $order_id)
    {
        $field = '*';
        $info = $this->model->where([ [ 'order_id', '=', $order_id ], [ 'site_id', '=', $this->site_id ] ])
            ->with(['deliveryInfo'])
            ->field($field)
            ->findOrEmpty()->toArray();
        $pay_info = ( new OrderFee() )->where([["order_id","=",$order_id],["order_type","=","2"]])->findOrEmpty()->toArray();
        $info['pay_info']=$pay_info;

        return $info;
    }






}
