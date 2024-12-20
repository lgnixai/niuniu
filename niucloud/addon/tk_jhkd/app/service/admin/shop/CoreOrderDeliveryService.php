<?php
// +----------------------------------------------------------------------
// | Niucloud-admin 企业快速开发的多应用管理平台
// +----------------------------------------------------------------------
// | 官方网址：https://www.niucloud.com
// +----------------------------------------------------------------------
// | niucloud团队 版权所有 开源版本可自由商用
// +----------------------------------------------------------------------
// | Author: Niucloud Team
// +----------------------------------------------------------------------

namespace addon\tk_jhkd\app\service\admin\shop;

use addon\shop\app\dict\goods\GoodsDict;
use addon\shop\app\dict\order\OrderDeliveryDict;
use addon\shop\app\dict\order\OrderDict;
use addon\shop\app\dict\order\OrderGoodsDict;
use addon\shop\app\model\order\Order;
use addon\shop\app\model\order\OrderDelivery;
use addon\shop\app\model\order\OrderGoods;
use addon\shop\app\service\core\order\CoreOrderEventService;
use addon\tk_jhkd\app\model\order\ShopOrder;
use addon\tk_jhkd\app\model\shop_address\ShopAddress;
use addon\tk_jhkd\app\model\TkjhkdBrand;
use addon\tk_jhkd\app\service\core\CommonService;
use core\base\BaseCoreService;
use core\exception\CommonException;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use addon\tk_jhkd\app\model\shop_order\ShopOrder as YdShopOrder;
/**
 *  订单配送服务层
 */
class CoreOrderDeliveryService extends BaseCoreService
{

    public function __construct()
    {
        parent::__construct();
        $this->model = new Order();
        $this->sendAddressModel = new ShopAddress();
        $this->shopOrderModel = new ShopOrder();
    }


    /**
     * 发货入口
     * @param $data
     * @return true
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public function delivery($data)
    {
        $order_id = $data['order_id'];
        $site_id = $data['site_id'];
        $order_goods_ids = $data['order_goods_ids'];//订单项id
        //查询订单
        $where = array(
            ['order_id', '=', $order_id],
            ['site_id', '=', $site_id]
        );
        $order = $this->model->where($where)->findOrEmpty();
        if ($order->isEmpty()) throw new CommonException('SHOP_ORDER_NOT_FOUND');//订单不存在

        if ($order['status'] != OrderDict::WAIT_DELIVERY) throw new CommonException('SHOP_ONLY_WAIT_DELIVERY_CAN_BE_DELIVERY');//只有待收货的订单才可以收货

        //配送
        $delivery_type = $data['delivery_type'];
        //不用的订单项针对的发货方式不同
        $order_goods_where = [
            [
                'order_id', '=', $order_id
            ],
            [
                'order_goods_id', 'in', $order_goods_ids
            ],
            [
                'status', '=', OrderGoodsDict::NORMAL
            ],
            [
                'delivery_status', '=', OrderDeliveryDict::WAIT_DELIVERY
            ]
        ];
        $order_goods_data = (new OrderGoods())->where($order_goods_where)->select();
        if ($order_goods_data->count() != count($order_goods_ids)) throw new CommonException('SHOP_ORDER_DELIVERY_NOT_ALLOW_REFUND_OR_DELIVERY_FINISH');//存在退款的商品不能发货
        $has_goods_type_array = [];
        foreach ($order_goods_data as $v) {
            if (!in_array($v['goods_type'], $has_goods_type_array)) {
                $has_goods_type_array[] = $v['goods_type'];
            }
        }
        if (count($has_goods_type_array) != 1) throw new CommonException('SHOP_ORDER_DELIVERY_ALLOW_ONE_GOODSTYPE');//一次发货只能发送一种商品类型的订单项
        $goods_type = $has_goods_type_array[0];

        $delivery_param = [
            'order_data' => $order,
            'order_goods_data' => $order_goods_data,
            'param' => $data
        ];
        switch ($goods_type) {
            case GoodsDict::VIRTUAL://只要有虚拟商品,就可以使用虚拟发货
                if ($delivery_type != OrderDeliveryDict::VIRTUAL) throw new CommonException('SHOP_ORDER_DELIVERY_VIRTUAL_ALLOW_VIRTUAL_DELIVERY');//虚拟商品只支持虚拟发货
                //虚拟发货
                $this->virtual($delivery_param);
                break;
            case GoodsDict::REAL:
                if (in_array($delivery_type, OrderDeliveryDict::getChildType($order['delivery_type']))) throw new CommonException('SHOP_ORDER_DELIVERY_TYPE_NOT_ORDER_DELIVERY_TYPE');//不支持的配送方式
                switch ($order['delivery_type']) {
                    case OrderDeliveryDict::EXPRESS://快递
                        $this->express($delivery_param);
                        break;
                    case OrderDeliveryDict::LOCAL_DELIVERY://配送
                        $this->localDelivery($delivery_param);
                        break;
                    case OrderDeliveryDict::STORE://自提
                        $this->store($delivery_param);
                        break;
                }
                break;
        }
        //校验是否全部发放完毕
        $this->checkFinish($data);

        return true;
    }

    /**
     * 虚拟发货
     * @param $data
     * @return void
     */
    public function virtual($data)
    {
        $order_data = $data['order_data'];
        $order_goods_data = $data['order_goods_data'];
        $param = $data['param'];
        $delivery_type = $param['delivery_type'];
        $insert_data = array(
            'order_id' => $order_data['order_id'],
            'site_id' => $order_data['site_id'],
            'delivery_type' => $order_data['delivery_type'],
            'sub_delivery_type' => $delivery_type,
            'remark' => $param['remark'],
        );
        $delivery_id = $this->package($insert_data);
        $order_goods_data->update([
            'delivery_status' => OrderDeliveryDict::DELIVERY_FINISH,
            'delivery_id' => $delivery_id
        ]);

        //日志
//        (new CoreOrderLogService())->add([
//            'order_id' => $order_data['order_id'],
//            'status' => $order_data['status'],
//            'main_type' => $param['main_type'],
//            'main_id' => $param['main_id'],
//            'type' => OrderDict::ORDER_DELIVERY_PART_ACTION,
//            'content' => ''
//        ]);
        return true;
    }

    /**
     * 订单配送包裹(order_delivery)
     * @param $data
     * @return mixed
     */
    public function package($data)
    {
        $delivery = (new OrderDelivery())->create($data);
        return $delivery->id;
    }

    public function sendOrder($data)
    {
        $order_info = $this->shopOrderModel
            ->where(['site_id' => $data['site_id'], 'order_id' => $data['order_id']])
            ->with(
                [
                    'order_goods' => function ($query) {
                        $query->field('order_goods_id, order_id, member_id, goods_id, sku_id, goods_name, sku_name, goods_image, sku_image, price, num, goods_money, is_enable_refund, goods_type, delivery_status, status')->append(['delivery_status_name']);
                    }
                ])
            ->findOrEmpty()->append(['province_name', 'city_name', 'district_name']);
        if ($order_info->isEmpty()) throw new \Exception('订单不存在');
        $sendaddress = $this->sendAddressModel->where(['site_id' => $data['site_id'], 'id' => $data['send_id']])->findOrEmpty()->append(['province_name', 'city_name', 'district_name']);
        if (empty($sendaddress)) throw new \Exception('收货地址不存在');
        //易达需要查询省市区的地址name
        $goods_name = $order_info['order_goods'][0]['goods_name'];
        $encoding = mb_detect_encoding($goods_name, 'UTF-8, ISO-8859-1', true);
        if ($encoding != 'UTF-8') {
            $goods_name = mb_convert_encoding($goods_name, 'UTF-8', $encoding);
        }
        $length = mb_strlen($goods_name, 'UTF-8'); // 使用 mb_strlen() 获取 UTF-8 编码下的字符串长度
        if ($length >30) {
            $goods_name = mb_substr($goods_name, 0, 30, 'UTF-8'); // 使用 mb_substr() 截取 UTF-8 编码下的字符串
        }
        $params = [
            "deliveryType" => $data['predata']['deliveryType'],
            "customer_type" => 'kd',
            "thirdNo" => $order_info['order_no'],
            "receiveAddress" =>  $order_info['taker_address'],
            "receiveMobile" => $order_info['taker_mobile'],
            "receiveTel" => "",
            "receiveName" => $order_info['taker_name'],
            "receiveProvince" =>  $order_info['province_name'],
            "receiveCity" => $order_info['city_name'],
            "receiveDistrict" =>$order_info['district_name'] ,
            "senderAddress" => $sendaddress['address'],
            "senderMobile" => $sendaddress['mobile'],
            "senderTel" => "",
            "senderName" =>  $sendaddress['contact_name'],
            "senderProvince" => $sendaddress['province_name'],
            "senderCity" => $sendaddress['city_name'],
            "senderDistrict" => $sendaddress['district_name'],
            "goods" => $goods_name,
            "packageCount" => 1,
            "weight" => $data['weight'],
            "vloumLong" => '10',
            "vloumWidth" => '10',
            "vloumHeight" =>'10',
            "guaranteeValueAmount"=>$data['bj_price'],
            "customerType" => 'kd',
            "vloum" => '1000',
            "remark" => '',
            "deliveryBusiness" => $data['predata']['deliveryBusiness'],
            "onlinePay" => '',
            "payMethod" => '',
        ];
        $submitInfo = event('DeliverySendOrder', ['site_id' => $data['site_id'], 'data' =>  $params]);
        $submitInfo = $submitInfo [0];
        $submitInfo['order_no']=$order_info['order_no'];
//        $order_no = $submitInfo['orderNo'];   //易达订单号
//        $delivery_id = $submitInfo['deliveryId'] ?? '';   //运单号
        return $submitInfo;
    }

    /**
     * 物流发货
     * @param $data
     * @return true
     */
    public function express($data)
    {
        /*********进行易达发单操作开始*********/
        if($data['param']['delivery_type']=='express'){
            $resinfo=$this->sendOrder($data['param']);
            //写入发单表
            (new YdShopOrder())->insert([
                'site_id' => $data['param']['site_id'],
                'order_no' => $resinfo['order_no'],
                'delivery_id' => $resinfo['deliveryId'],
                'order_status_name'=>'待揽收',
                'yida_order_no'=>$resinfo['orderNo'],
                'create_time'=>time(),
                'is_send'=>1,
                'is_pick'=>0,
            ]);
        }else{
            $resinfo['deliveryId']='';
        }

        /*********进行易达发单操作结束*********/
        $order_data = $data['order_data'];
        $order_goods_data = $data['order_goods_data'];
        $param = $data['param'];
        $delivery_type = $param['delivery_type'];
        $order_goods_ids = $param['order_goods_ids'];//订单项id
        $insert_data = array(
            'order_id' => $order_data['order_id'],
            'site_id' => $order_data['site_id'],
            'delivery_type' => $order_data['delivery_type'],
            'sub_delivery_type' => $delivery_type,
            'express_company_id' => $param['express_company_id'],
            'express_number' => $resinfo['deliveryId'],
            'remark' => $param['remark'],
        );
        $delivery_id = $this->package($insert_data);
        $order_goods_data->update([
            'delivery_status' => OrderDeliveryDict::DELIVERY_FINISH,
            'delivery_id' => $delivery_id
        ]);
        //日志
//        $order_goods_column = [];
//        foreach($order_goods_data->toArray() as $v){
//            $order_goods_column = $v['goods_name'] . $v['sku_name'];
//        }
//        (new CoreOrderLogService())->add([
//            'order_id' => $order_data['order_id'],
//            'status' => $order_data['status'],
//            'main_type' => $param['main_type'],
//            'main_id' => $param['main_id'],
//            'type' => OrderDict::ORDER_DELIVERY_PART_ACTION,
//            'content' => implode(';', $order_goods_column)
//        ]);
        return true;
    }

    /**
     * 同城配送
     * @param $data
     * @return true
     */
    public function localDelivery($data)
    {
        $order_data = $data['order_data'];
        $order_goods_data = $data['order_goods_data'];
        $param = $data['param'];
        $delivery_type = $param['delivery_type'];
        $insert_data = array(
            'order_id' => $order_data['order_id'],
            'site_id' => $order_data['site_id'],
            'delivery_type' => $order_data['delivery_type'],
            'sub_delivery_type' => $delivery_type,
            'local_deliver_id' => $param['local_deliver_id'],
            'remark' => $param['remark'],
        );
        $delivery_id = $this->package($insert_data);
        $order_goods_data->update([
            'delivery_status' => OrderDeliveryDict::DELIVERY_FINISH,
            'delivery_id' => $delivery_id
        ]);
//        $order_goods_column = [];
//        foreach($order_goods_data->toArray() as $v){
//            $order_goods_column = $v['goods_name'] . $v['sku_name'];
//        }
        //日志
//        (new CoreOrderLogService())->add([
//            'order_id' => $order_data['order_id'],
//            'status' => $order_data['status'],
//            'main_type' => $param['main_type'],
//            'main_id' => $param['main_id'],
//            'type' => OrderDict::ORDER_DELIVERY_PART_ACTION,
//            'content' => implode(';', $order_goods_column)
//        ]);
        return true;
    }

    /**
     * 门店自提
     * @param $data
     * @return true
     */
    public function store($data)
    {
        $order_data = $data['order_data'];
        $order_goods_data = $data['order_goods_data'];
        $param = $data['param'];
        $delivery_type = $param['delivery_type'];
        $insert_data = array(
            'order_id' => $order_data['order_id'],
            'site_id' => $order_data['site_id'],
            'delivery_type' => $order_data['delivery_type'],
            'sub_delivery_type' => $delivery_type,
            'remark' => $param['remark'],
        );
        $delivery_id = $this->package($insert_data);
        $order_goods_data->update([
            'delivery_status' => OrderDeliveryDict::DELIVERY_FINISH,
            'delivery_id' => $delivery_id
        ]);

//        $order_goods_column = [];
//        foreach($order_goods_data->toArray() as $v){
//            $order_goods_column = $v['goods_name'] . $v['sku_name'];
//        }
        //日志
//        (new CoreOrderLogService())->add([
//            'order_id' => $order_data['order_id'],
//            'status' => $order_data['status'],
//            'main_type' => $param['main_type'],
//            'main_id' => $param['main_id'],
//            'type' => OrderDict::ORDER_DELIVERY_PART_ACTION,
//            'content' => implode(';', $order_goods_column)
//        ]);
        return true;
    }

    /**
     * 校验订单下的订单项是否全部发货
     * @param $data
     * @return void
     */
    public function checkFinish($data)
    {
        $order_id = $data['order_id'];
        //校验订单下的有效的订单项是否全部发货完毕
        $where = array(
            [
                'delivery_status', '=', OrderDeliveryDict::WAIT_DELIVERY
            ],
            [
                'order_id', '=', $order_id
            ],
            [
                'status', '<>', OrderGoodsDict::REFUND_FINISH,//不包含退款完毕的
            ]
        );
        $order_goods_count = (new OrderGoods())->where($where)->count();
        //完成
        if ($order_goods_count == 0) $this->finish($data);
        return true;
    }

    /**
     * 发货完成
     * @param $data
     * @return void
     */
    public function finish($data)
    {
        $order_id = $data['order_id'];
        //查询订单
        $where = array(
            ['order_id', '=', $order_id],
            ['site_id', '=', $data['site_id']],
            ['status', '=', OrderDict::WAIT_DELIVERY]
        );
        $order = $this->model->where($where)->findOrEmpty();
        if ($order->isEmpty()) throw new CommonException('SHOP_ORDER_NOT_FOUND');//订单不存在

        $order_data = array(
            'delivery_time' => time(),
            'status' => OrderDict::WAIT_TAKE,
            'timeout' => 0
        );
//        $this->model->where([
//            ['order_id', '=', $order_id],
//            ['status', '=', OrderDict::WAIT_DELIVERY]
//
//        ])->update($order_data);
        $order->save($order_data);
        //订单发货后操作
        $data['order_data'] = $order->toArray();
//        event('AfterShopOrderDelivery', $data);
        //订单发货操作
        CoreOrderEventService::orderDelivery($data);
        //订单发货后操作
        CoreOrderEventService::orderDeliveryAfter($data);
        return true;
    }
}
