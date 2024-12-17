<?php

namespace addon\fengchao\app\service\core;

use addon\fengchao\app\model\order\FengChaoOrder;
use addon\fengchao\app\model\order\OrderDelivery;
use app\dict\pay\PayDict;
use app\model\pay\Pay;
use app\model\pay\Refund;
use app\service\core\notice\NoticeService;
use app\service\core\pay\CorePayService;
use app\service\core\sys\CoreConfigService;
use core\base\BaseApiService;
use core\exception\CommonException;
use core\util\Snowflake;
use Exception;
use think\facade\Cache;
use think\facade\Db;
use think\facade\Log;

/**
 * 聚合快递订单服务层
 * Class OrderService
 * @package addon\fcos\service\core\order
 */
class test extends BaseApiService
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new FengChaoOrder();
        $this->deliveryModel = new OrderDelivery();

        $this->config = $this->getConfig();
        if (!$this->config) throw new CommonException('基础配置未完成，请联系管理员2');
    }

    public function checkAddPay()
    {
        $orderModel = new OrderAdd();
        $res = $orderModel->where([['order_status', '=', JhkdOrderAddDict::WAIT_PAY]])
            ->where(['member_id' => $this->member_id])
            ->findOrEmpty();
        if ($res->isEmpty()) {
            return ['type' => 'success', 'page' => ''];
        } else {
            return ['type' => 'redirect', 'page' => '/addon/fcos/pages/orderaddlist'];
        }
    }

    /**
     * $order_id
     * 快递渠道发单，三方下单
     */
    public function sendOrder($order_id)
    {
        Db::startTrans();
        try {
            $order_model = $this->model;
            $order_info = $order_model->where([['order_id', '=', $order_id]])->findOrEmpty();
            if (empty($order_info))
                throw new CommonException('ORDER_NOT_EXIST');
            if ($order_info['is_send'] == 1) throw new CommonException('已经发单');
            $ordeDeliveryInfo = (new OrderDelivery())->where(['order_id' => $order_id])->findOrEmpty();
            if ($ordeDeliveryInfo->isEmpty()) throw new Exception('未找到运单数据');
            $params = $ordeDeliveryInfo;
            $send_address = json_decode($params['start_address'], true);
            $sendName = explode("-", $send_address['address']);
            $receive_address = json_decode($params['end_address'], true);
            $receiveName = explode("-", $receive_address['address']);
            $data = [
                "deliveryType" => $params['delivery_type'],
                "customer_type" => $params['customer_type'],
                "thirdNo" => $params['order_id'],
                "senderProvince" => $sendName[0],
                "senderCity" => $sendName[1],
                "senderDistrict" => $sendName[2],
                "senderAddress" => $send_address['full_address'],
                "senderName" => $send_address['name'],
                "senderMobile" => $send_address['mobile'],
                "senderTel" => $send_address['telephone'] ?? '',
                "receiveProvince" => $receiveName[0],
                "receiveCity" => $receiveName[1],
                "receiveDistrict" => $receiveName[2],
                "receiveAddress" => $receive_address['full_address'],
                "receiveName" => $receive_address['name'],
                "receiveMobile" => $receive_address['mobile'],
                "receiveTel" => $receive_address['telephone'] ?? '',
                "weight" => $params['weight'],
                "vloumLong" => $params['long'],
                "vloumWidth" => $params['width'],
                "vloumHeight" => $params['height'],
                "vloum" => $params['long'] * $params['width'] * $params['height'],
                "guaranteeValueAmount" => $params['bj_price'] > 0 ? $params['bj_price'] : null,
                "goods" => $params['goods'],
                "packageCount" => $params['package_count'],
                "remark" => $params['remark'],
                "deliveryBusiness" => $params['delivery_business'],
                "onlinePay" => $params['online_pay'],
                "payMethod" => $params['online_pay'] == 'N' ? 10 : '',
                "channelId" => $params['channel_id'] ?? ''
            ];
            $submitInfo = event('DeliverySendOrder', ['site_id' => $this->site_id, 'data' => $data]);
            $submitInfo = $submitInfo [0];
            if (isset($submitInfo['type']) && $submitInfo['type'] == 'error') {
                //下单失败主动发起退款
                $data = [
                    'id' => $order_info['id'],
                    'close_reason' => $submitInfo['msg'] ?? '三方平台下单失败，请重新下单'
                ];
                (new OrderLogService())->writeOrderLog(
                    $order_info['site_id'],
                    $order_info['order_id'],
                    JhkdOrderDict::REFUNDING,
                    $submitInfo['msg'] ?? '三方平台下单失败，发起退款'
                );
                event('CancelOrder', $data);
                Db::commit();
                return false;
            }
            $order_no = $submitInfo['orderNo'] ?? '';
            $delivery_id = $submitInfo['deliveryId'] ?? '';
            $orderDeliveryInfo = $this->deliveryModel->where(['order_id' => $order_id])->findOrEmpty();
            if ($orderDeliveryInfo->isEmpty()) {
                event('DeliveryCancelOrder', ['site_id' => $this->site_id, 'data' => [
                    'order_no' => $order_no,
                    'task_id' => $orderDeliveryInfo['task_id']
                ]]);
                //取消下单
            } else {
                $orderDeliveryInfo->save(['order_no' => $order_no, 'delivery_id' => $delivery_id]);
                $order_info->save(['is_send' => 1]);
                (new OrderLogService())->writeOrderLog(
                    $order_info['site_id'],
                    $order_info['order_id'],
                    JhkdOrderDict::FINISH_PICK,
                    '成功发单'
                );
                Db::commit();
            }

        } catch (Exception $e) {
            Db::rollback();
            throw new CommonException($e->getMessage());
        }
    }

    public function create_no(string $prefix = '', string $tag = '')
    {

        $data_center_id = 1;
        $machine_id = 2;
        $snowflake = new Snowflake($data_center_id, $machine_id);
        $id = $snowflake->generateId();
        $no = $prefix . date('Ymd') . $tag . $id;
        $cacheKey = 'unique_no_' . $no;
        if (Cache::get($cacheKey)) {
            return create_no($prefix, $tag);
        } else {
            Cache::set($cacheKey, true, 60); // 设置过期时间为 60 秒
            return $no;
        }
    }

    /**
     * 快递预下单
     * @param $params
     * @return array
     * @throws Exception
     */
    public function preOrder($params)
    {
        $startArr = explode("-", $params['startAddress']['address']);
        $endArr = explode("-", $params['endAddress']['address']);
        //必填参数校验
        $data = [
            "receiveAddress" => $params['endAddress']['full_address'],
            "receiveMobile" => $params['endAddress']['mobile'],
            "receiveTel" => "",
            "receiveName" => $params['endAddress']['name'],
            "receiveProvince" => $endArr[0],
            "receiveCity" => $endArr[1],
            "receiveDistrict" => $endArr[2],
            "senderAddress" => $params['startAddress']['full_address'],
            "senderMobile" => $params['startAddress']['mobile'],
            "senderTel" => "",
            "senderName" => $params['startAddress']['name'],
            "senderProvince" => $startArr[0],
            "senderCity" => $startArr[1],
            "senderDistrict" => $startArr[2],
            "goods" => $params['goods'],
            "packageCount" => $params['packageCount'],
            "weight" => $params['weight'],
            "vloumLong" => $params['vloumLong'],
            "vloumWidth" => $params['vloumWidth'],
            "vloumHeight" => $params['vloumHeight'],
            "guaranteeValueAmount" => $params['guaranteeValueAmount'],
            "customerType" => $params['customerType'],
            "onlinePay" => "ALL",
            "payMethod" => 10,
            "thirdNo" => "TD965412356"
        ];
        $resInfo = event('DeliveryPreOrder', ['site_id' => $this->site_id, 'data' => $data]);
        $resInfo = $resInfo[0];
        $url = (new CommonService())->getUrl();
        $dataInfo = [];
        foreach ($resInfo as $k1 => $v1) {
            $brand = (new TkjhkdBrand())->where(['express_no' => $v1['deliveryType']])->findOrEmpty();
            if (!$brand->isEmpty()) {
                $v1['logo'] = $url . '/' . $brand['logo'];
            }
            //$v1['showPrice'] = $this->showPrice($v1);
            $newPrice = $this->newPriceAndRule($v1, $params['weight']);
            $v1['showPrice'] = $newPrice['price'];
            $v1['price_rule'] = $newPrice['price_rule'];
            $v1['original_rule'] = $newPrice['original_rule'];
            if ($v1['showPrice'] > $v1['preOrderFee']) {
                $keysToRemove = ['preDeliveryFee', 'preOrderFee', 'price', 'originalFee', 'originalPrice'];
                $v1 = array_diff_key($v1, array_flip($keysToRemove));
                $dataInfo[] = $v1;
            }
        }
        //增加验证key
        $key = md5(create_no() . time());

        usort($dataInfo, function ($a, $b) {
            return $a['showPrice'] <=> $b['showPrice'];
        });
        Cache::set($key, $dataInfo, 180);
        $data = [
            'key' => $key,
            'list' => $dataInfo
        ];
        return $data;
    }

    /**
     * @param $params
     * 创建系统订单
     */
    public
    function createOrder($params)
    {
        if (!isset($params['delivery_info']['deliveryType'])) throw new Exception('请选择正确快递渠道');
        //进行订单验证
        $cacheData = Cache::get($params['key']);
        if (!$cacheData) {
            throw new Exception('报价失效,请重新获取运单报价');
        } else {
            $selectData = $cacheData[$params['delivery_index']];
            if ($selectData['showPrice'] != $params['showPrice']) {
                throw new Exception('非法的价格');
            } else {
                Cache::delete($params['key']);
            }
        }
        Db::startTrans();
        try {

            $orderData = [
                "site_id" => $this->site_id,
                "member_id" => $this->member_id,
                'ip' => request()->ip() ?? '',
                "order_from" => $this->channel,
                "order_id" => $this->create_no(),
                "order_money" => $params['showPrice'],
                "remark" => $params['remark']
            ];
            $deliveryData = [
                "start_address" => $params['startAddress'],
                "end_address" => $params['endAddress'],
                "member_id" => $this->member_id,
                "weight" => $params['weight'],
                "long" => $params['vloumLong'],
                "width" => $params['vloumWidth'],
                "height" => $params['vloumHeight'],
                "goods" => $params['goods'],
                "package_count" => $params['packageCount'],
                "bj_price" => $params['guaranteeValueAmount'],
                "order_id" => $orderData['order_id'],
                "delivery_status" => 1,
                "delivery_type" => $params['delivery_info']['deliveryType'],
                "delivery_business" => $params['delivery_info']['deliveryBusiness'],
                "online_pay" => $params['delivery_info']['onlinePay'],
                "customer_type" => $params['customerType'],
                "pay_method" => $params['pay_method'],
                "remark" => $params['remark'],
                "channel_id" => $params['delivery_info']['channelId'],
                "price_rule" => json_encode($selectData['price_rule']),
                "original_rule" => json_encode($selectData['original_rule']),
            ];
            (new OrderDelivery())->create($deliveryData);
            $info = $this->model->create($orderData);
            //添加订单支付表
            (new CorePayService())->create($orderData['site_id'], PayDict::MEMBER, $orderData['member_id'], $orderData['order_money'], JhkdOrderDict::getOrderType()['type'], $info['id'], "快递下单付款");
            //同步创建计费
            (new OrderDeliveryReal())->create([
                'order_id' => $info['order_id'],
                "weight" => $params['weight'],
            ]);
            (new OrderLogService())->writeOrderLog(
                $orderData['site_id'],
                $orderData['order_id'],
                JhkdOrderDict::WAIT_PAY,
                '订单创建',
                PayDict::MEMBER,
                $this->member_id
            );
            Db::commit();
            return [
                'trade_type' => 'jhkdOrderPay',//type
                'trade_id' => $info['id']//id
            ];
        } catch (Exception $e) {
            Db::rollback();
            throw new CommonException($e->getMessage());
        }
    }

    /**
     * 订单支付
     * @param array $pay_info
     * @return true
     */
    public function pay(array $pay_info)
    {
        try {
            Db::startTrans();
            $trade_id = $pay_info['trade_id'] ?? 0;
            $order_model = $this->model;
            $order_info = $order_model->where([['site_id', '=', $pay_info['site_id']], ['id', '=', $trade_id]])->findOrEmpty();
            if (empty($order_info))
                throw new CommonException('ORDER_NOT_EXIST');
            if ($order_info['order_status'] != JhkdOrderDict::WAIT_PAY) return true;
            $order_data = [
                'pay_time' => time(),
                'order_status' => JhkdOrderDict::FINISH_PAY,
                'is_enable_refund' => 1, // 是否允许退款
                'out_trade_no' => $pay_info['out_trade_no']//支付后的交易流水号
            ];
            $order_info->save($order_data);
            (new OrderLogService())->writeOrderLog(
                $order_info['site_id'],
                $order_info['order_id'],
                JhkdOrderDict::FINISH_PAY,
                '订单支付成功',
                PayDict::MEMBER,
                $this->member_id
            );
            Db::commit();
            (new NoticeService())->send($order_info['site_id'], 'fcos_order_pay', ['order_id' => $order_info['order_id']]);
            $sendauto = $this->getConfig()['autosend'];
            if ($sendauto == 1) {
                (new test())->sendOrder($order_info['order_id']);
            }
            $config = (new CommonService())->getConfig($order_info['site_id']);
            $text = '订单号：' . $order_info['order_id'] . ',已经支付成功，订单金额：' . $order_info['order_money'] . '元，请及时关注是否存在超重补差价';
            Webhook::dispatch(['config' => $config, 'text' => $text]);
            return true;
        } catch (Exception $e) {
            Db::rollback();
            Log::write('支付回调失败' . date('Y-m-d H:i:s'));
            Log::write($e->getMessage());
            throw new CommonException($e->getMessage());
        }
    }

    /**
     * 获取配置信息
     * @param $site_id
     * @param string $config_key
     */
    public function getConfig()
    {
        $info = (new CoreConfigService())->getConfig($this->site_id, 'fcos_config');
        if (empty($info)) {
            $info['value'] = ['autosend' => 0];
        }
        return $info['value'];
    }

    /**
     * 补单订单支付
     * @param array $pay_info
     * @return true
     */
    public
    function payAdd(array $pay_info)
    {
        Db::startTrans();
        try {
            $trade_id = $pay_info['trade_id'] ?? 0;
            $order_model = new OrderAdd();
            $order_info = $order_model->where([['site_id', '=', $pay_info['site_id']], ['id', '=', $trade_id]])->findOrEmpty();
            if (empty($order_info))
                throw new CommonException('ORDERADD_NOT_EXIST');
            if ($order_info['order_status'] != JhkdOrderAddDict::WAIT_PAY) return true;
            $order_data = [
                'pay_time' => time(),
                'order_status' => JhkdOrderAddDict::FINISH_PAY,
                'out_trade_no' => $pay_info['out_trade_no']//支付后的交易流水号
            ];
            $order_info->save($order_data);
            (new OrderLogService())->writeOrderLog(
                $order_info['site_id'],
                $order_info['order_id'],
                JhkdOrderDict::FINISH_PAY,
                '补差价支付成功',
                PayDict::MEMBER,
                $this->member_id
            );
            Db::commit();
            return true;
        } catch (Exception $e) {
            Db::rollback();
            throw new CommonException($e->getMessage());
        }
    }

    public
    function refund($data)
    {
        Db::startTrans();
        try {
            $this->model = new Refund();
            $this->OrderModel = new Tkjhkdorder();
            $this->PayModel = new Pay();
            $refund_no = $data['refund_no'];
            $trade_type = $data['trade_type'];
            $trade_id = $data['trade_id'];
            $site_id = $data['site_id'];
            $payInfo = $this->PayModel->where(['site_id' => $site_id, 'trade_id' => $trade_id, 'trade_type' => JhkdOrderDict::getOrderType()['type']])
                ->where([['status', '<>', -1]])->findOrEmpty();
            if ($payInfo->isEmpty()) throw new CommonException('select pay is empty');
            $this->PayModel->where(['site_id' => $site_id, 'trade_id' => $trade_id, 'trade_type' => JhkdOrderDict::getOrderType()['type']])
                ->update([
                'status' => -1,
                'type' => '',
                'pay_time' => ''
            ]);
            $refundInfo = $this->model->where(['site_id' => $site_id, 'refund_no' => $refund_no, 'trade_id' => $trade_id])->findOrEmpty();
            if ($refundInfo->isEmpty()) throw new CommonException('select refund is empty');
            $this->model->where(['site_id' => $site_id, 'refund_no' => $refund_no, 'trade_id' => $trade_id])->update(['trade_type' => $trade_type]);
            $orderInfo = $this->OrderModel->where(['site_id' => $site_id, 'id' => $trade_id])->findOrEmpty();
            if ($orderInfo->isEmpty()) throw new CommonException('select order is empty');
            $this->OrderModel->where(['site_id' => $site_id, 'id' => $trade_id])->update([
                'refund_status' => JhkdOrderDict::REFUND_COMPLETED,
                'is_enable_refund' => 0,
                'close_time' => time(),
                'pay_time' => '',
                'order_status' => JhkdOrderDict::CLOSE,
                'is_send' => 0,
            ]);
            Db::commit();
            $deliveryInfo = $this->deliveryModel->where(['order_id' => $orderInfo['order_id']])->findOrEmpty();
            $order_no = $deliveryInfo['order_no'];
            (new OrderLogService())->writeOrderLog(
                $orderInfo['site_id'],
                $orderInfo['order_id'],
                $orderInfo['order_status'],
                '订单退款成功',
                'member'
            );
            event('DeliveryCancelOrder', ['site_id' => $this->site_id, 'data' => [
                'order_no' => $order_no,
                'task_id' => $deliveryInfo['task_id']
            ]]);
            Db::commit();
        } catch (Exception $e) {
            Db::rollback();
            Log::write('===聚合快递退款失败===' . date('Y-m-d H:i:s'));
            Log::write($e->getMessage());
            throw new CommonException($e->getMessage());
        }
    }

    /**
     * @Notes:重新计算价格和规则
     * @Interface newPriceAndRule
     * @param $data
     * @author: TK
     * @Time: 2024/9/8   下午10:56
     */
    public function newPriceAndRule($data, $weight)
    {


        $price = $data['preOrderFee'];
        // 易达通票计算价格
        if ($data['calcFeeType'] == 'profit') {
            if (is_array($data['price'])) {
                $pricerules = $data['price'];
            } else {
                $pricerules = json_decode($data['price'], true);
            }
            if (is_array($data['originalPrice'])) {
                $original_price = $data['originalPrice'];
            } else {
                $original_price = json_decode($data['originalPrice'], true);
            }
            $selectedRule = null;
            $index = 0;
            // 遍历所有规则，找到适用于当前重量的规则
            foreach ($pricerules as $k => $rule) {
                if ($weight >= $rule['start'] && ($weight <= $rule['end'] || $rule['end'] == 0)) {
                    $selectedRule = $rule;
                    $index = $k;
                    break;
                }
            }
            if (!$selectedRule) {
                $firstRule = reset($pricerules);
                if ($weight < $firstRule['start']) {
                    $selectedRule = $firstRule;
                    $index = key($pricerules);
                }
            }
            if ($this->config['floatWay'] == 'floatWayFixed') {
                $selectedRule['first'] += $this->config['floatAmount'];
                if ($selectedRule['add'] > 0) {
                    $selectedRule['add'] += $this->config['floatAmount'];
                } else {
                    $selectedRule['add'] = 3;
                }

            }
            if ($this->config['floatWay'] == 'floatWayRate') {
                $selectedRule['first'] = $selectedRule['first'] * (1 + $this->config['floatRate'] / 100);
                if ($selectedRule['add'] > 0) {
                    $selectedRule['add'] = $selectedRule['add'] * (1 + $this->config['floatRate'] / 100);
                } else {
                    $selectedRule['add'] = 3;
                }
            }
            if ($this->config['floatWay'] == 'floatWayBetwn') {
                $selectedRule['first'] = $selectedRule['first'] + $this->config['firstAmount'];
                if ($selectedRule['add'] > 0) {
                    $selectedRule['add'] = $selectedRule['add'] + $this->config['secondAmount'];
                } else {
                    $selectedRule['add'] = 3;
                }

            }
            $selectedRule['perAdd'] = 0;   // 单笔加收
            $selectedRule['discount'] = 1;    // 折扣

        } else {
            if (is_array($data['price'])) {
                $pricerules = $data['price'];
            } else {
                $pricerules = json_decode($data['price'], true);
            }
            if (is_array($data['originalPrice'])) {
                $original_price = $data['originalPrice'];
            } else {
                $original_price = json_decode($data['originalPrice'], true);
            }
            $selectedRule = null;
            $index = 0;
            // 遍历所有规则，找到适用于当前重量的规则
            foreach ($original_price as $k => $rule) {
                if ($weight >= $rule['start'] && ($weight <= $rule['end'] || $rule['end'] == 0)) {
                    $selectedRule = $rule;
                    $index = $k;
                    break;
                }
            }
            if (!$selectedRule) {
                $firstRule = reset($original_price);
                if ($weight < $firstRule['start']) {
                    $selectedRule = $firstRule;
                    $index = key($original_price);
                }
            }
            if ($this->config['floatWay'] == 'floatWayFixed') {
                $selectedRule['first'] = $selectedRule['first'] * $pricerules['discount'] + $pricerules['perAdd'] + $this->config['floatAmount'];
                $selectedRule['add'] = $selectedRule['add'] * $pricerules['discount'] + $this->config['floatAmount'];
            }
            if ($this->config['floatWay'] == 'floatWayRate') {
                $selectedRule['first'] = ($selectedRule['first'] * $pricerules['discount'] + $pricerules['perAdd']) * (1 + $this->config['floatRate'] / 100);
                $selectedRule['add'] = $selectedRule['add'] * $pricerules['discount'] * (1 + $this->config['floatRate'] / 100);
            }
            if ($this->config['floatWay'] == 'floatWayFixed') {
                $selectedRule['first'] = $selectedRule['first'] * $pricerules['discount'] + $pricerules['perAdd'] + $this->config['firstAmount'];
                $selectedRule['add'] = $selectedRule['add'] * $pricerules['discount'] + $this->config['secondAmount'];
            }
            $selectedRule['perAdd'] = $pricerules['perAdd'];   // 单笔加收
            $selectedRule['discount'] = $pricerules['discount'];    // 折扣
        }
        $selectedRule['first'] = round($selectedRule['first'], 2);
        $selectedRule['add'] = round($selectedRule['add'], 2);
//        $selectedRule['first']=ceil($selectedRule['first']);
//        $selectedRule['add']=ceil($selectedRule['add']);
        $weight_num = $weight - $selectedRule['start'];
        if ($weight_num < 0) {
            $weight_num = 0;
        }
        $price = $selectedRule['first'] + $weight_num * $selectedRule['add'];
        $price = round($price, 2);
        return ['price' => $price, 'price_rule' => $selectedRule, 'original_rule' => $original_price[$index]];
    }

    /**
     * @param $price
     */
    public
    function showPrice($data)
    {
        $price = $data['preOrderFee'];
        if ($this->config['floatWay'] == 'floatWayFixed') {
            $price = $price + $this->config['floatAmount'];
        }
        if ($this->config['floatWay'] == 'floatWayRate') {
            $price = $price * (1 + $this->config['floatRate'] / 100);
        }
        if ($this->config['floatWay'] == 'floatWayBetwn') {
            $weight = $data['calcFeeWeight'];
            $rules = json_decode($data['originalPrice'], true)[0];
            if ($weight <= $rules['start']) {
                $price = $rules['first'] - $this->config['firstAmount'] + $data['preBjFee'];
            } else {
                $firstPrice = $rules['first'] - $this->config['firstAmount'];
                $secondPrice = ($rules['add'] - $this->config['secondAmount']) * ($weight - 1);
                $price = $firstPrice + $secondPrice + $data['preBjFee'];
            }

        }
//        if ($price >= ($data['originalFee'] + $data['preBjFee'])) {
//            $price = $data['originalFee'] - 0.02;
//        }
        if ($price < $data['preOrderFee']) {
            $price = $data['preOrderFee'] + 3;
        }
        return round($price, 2);
    }
}