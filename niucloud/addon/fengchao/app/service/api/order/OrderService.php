<?php

namespace addon\fengchao\app\service\api\order;

use addon\fengchao\app\dict\delivery\DeliveryDict;
use addon\fengchao\app\dict\order\OrderDict;
use addon\fengchao\app\model\delivery\Store;
use addon\fengchao\app\model\order\FengChaoOrder;
use addon\fengchao\app\model\order\Order;
use addon\fengchao\app\model\order\OrderFee;

use addon\fengchao\app\service\core\CommonService;
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
    public function getPage(array $where = [])
    {
        $field = 'id,site_id,member_id,order_from,order_id,order_money,order_discount_money,is_send,is_pick,order_status,refund_status,out_trade_no,remark,pay_time,create_time,close_reason,is_enable_refund,close_time,ip,update_time,delete_time,send_log,remark';
        $order = 'id desc';
        $search_model = $this->model->where([['site_id', "=", $this->site_id]])
            ->withSearch(["member_id", "order_from", "order_id","out_trade_no", "is_send", "order_status", "refund_status", "remark", "create_time"], $where)
            ->with(
                [
                    'orderInfo',
                    'payInfo' => function ($query) {
                        $query->field('trade_id,status,pay_time,cancel_time,fail_reason,type,trade_type')
                            ->where(['trade_type' => OrderDict::getOrderType()['type']])
                            ->append(['status_name', 'type_name']);
                    },
                    'deliveryRealInfo','orderFee'

                ]
            )->field($field)->order($order);
        $list = $this->pageQuery($search_model);
        $commService=new CommonService();
        foreach ($list['data'] as $k=>$v){
         $list['data'][$k]['platform_name'] =$commService->getDriverByType($v['orderInfo']['platform'])['name']??'';
             $list['data'][$k]['delivery_name']=$commService->getBrand($v['orderInfo']['platform'],$v['orderInfo']['delivery_type'])['name']??'';
//            $list['data'][$k]['start_address']=json_decode($v['orderInfo']['start_address'],true);
//            $list['data'][$k]['end_address']=json_decode($v['orderInfo']['end_address'],true);
//
        }
        return $list;
    }


    public function getPage1(array $where)
    {
        $order = 'o.create_time desc';
        $field = 'id,order_id,order_money,order_status';

        $search_model=(new FengChaoOrder())
            ->alias('o')
            ->join('fengchao_order_delivery od', 'o.order_id = od.order_id')
            ->where([ [ 'o.site_id', '=', $this->site_id ] ])
            ->where('od.order_id|od.delivery_id|od.client_order_code', 'like', '%' . $where['order_code'] . '%')
            ->withSearch(['create_time' ], $where)
            ->field('o.*,od.*')->order($order);

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
    public function getDetail1(string $order_id)
    {
        $field = '*';
        $info = $this->model->where([ [ 'order_id', '=', $order_id ], [ 'site_id', '=', $this->site_id ] ])
            ->with(['deliveryInfo'])
            ->field($field)
            ->findOrEmpty()->toArray();
        $pay_info = ( new OrderFee() )->where([["order_id","=",$order_id]])->findOrEmpty()->toArray();
        $info['pay_info']=$pay_info;

        return $info;
    }

    /**
     * 获取订单列信息
     * @param int $id
     * @return array
     */
    public function getDetail(string $order_id)
    {
        $field = 'id,site_id,member_id,order_from,order_id,order_money,order_discount_money,is_send,is_pick,order_status,refund_status,out_trade_no,remark,pay_time,create_time,close_reason,is_enable_refund,close_time,ip,update_time,delete_time,send_log';
        $info = $this->model->field($field)
            ->where([['order_id', "=", $order_id]])
            ->with(
                [
                    'orderInfo','deliveryRealInfo','orderFee',
                    'payInfo' => function ($query) {
                        $query->field('trade_id,status,pay_time,cancel_time,fail_reason,type,trade_type')->append(['status_name', 'type_name']);
                    },

                ])
            ->findOrEmpty()->append(['order_status_arr'])->toArray();
        $info['is_send'] = strval($info['is_send']);
        $info['is_pick'] = strval($info['is_pick']);
       // $info['orderInfo']['price_rule'] = json_decode($info['orderInfo']['price_rule'], true);
       // $info['orderInfo']['original_rule'] = json_decode($info['orderInfo']['original_rule'], true);
        $info['orderInfo']['delivery_arry'] = (new CommonService())->getBrand($info['orderInfo']['platform'],$info['orderInfo']['delivery_type']);
        $fee_list=json_decode($info['deliveryRealInfo']['fee_blockList'],true);
        $new_fee_list=[];
        if($fee_list!=''){
            foreach ($fee_list as $fee){
                if($fee['type']!=0){
                    $new_fee_list[]=[
                        'fee'=>$fee['fee'],
                        'type'=>$fee['type'],
                        'name'=>$fee['name']
                    ];
                }
            }
        }

        $info['deliveryRealInfo']['fee_blockList']=$new_fee_list;
        return $info;
    }






}
