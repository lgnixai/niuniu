<?php

namespace addon\fengchao\app\service\core;


use addon\fengchao\app\dict\order\OrderDict;
use addon\fengchao\app\service\api\order\OrderCallBackLogService;
use addon\fengchao\app\service\core\common\OrderDeliveryService;
use addon\fengchao\app\service\core\common\PriceService;
use addon\fengchao\app\model\order\FengChaoOrder;
use addon\fengchao\app\model\order\OrderDelivery;
use addon\fengchao\app\model\pay\FengChaoPay;
use addon\fengchao\app\service\admin\site\BalanceService;
use addon\fengchao\app\service\api\common\Utils;
use addon\fengchao\app\service\api\express\ExpressService;
use addon\fengchao\app\service\core\order\OrderService;
use addon\fengchao\app\model\OrderDeliveryReal;
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
class CoreOrderService extends BaseApiService
{
    protected $deliveryModel;
    protected $model;
    protected $payModel;

    public function __construct()
    {
        parent::__construct();
        $this->model = new FengChaoOrder();
        $this->deliveryModel = new OrderDelivery();
        $this->payModel = new FengChaoPay();
    }


    public function ChangeAppId($params)
    {
        $params["EBusinessID"] = $this->member_id;


        return $params;
    }

    public function checkBalance($params)
    {
        $balance = (new BalanceService())->getInfo();
        if (empty($balance))
            throw new CommonException('查询余额出错');

        $linePrice = (new LinePriceService())->getOrderLinePrice($params);
        if (empty($linePrice))
            throw new CommonException('线路报价出错');

        if ($balance["balance"] < $linePrice['totalFee']) {
            throw new CommonException('余额不足，请充值');
        };
        return true;
    }

    //预下单
    public function PreOrder($params)
    {
        $params['site_id']=$this->site_id;
        $resInfo = event('DeliveryPreOrder', [ 'data' => $params]);
        $dataInfo = $resInfo[0];

        return $dataInfo;
    }

    //主动取消退款
    public function CancelOrder($data)
    {
        Db::startTrans();
        try {

            $order = (new OrderDeliveryService())->getOrderInfoByClient($data["OrderCode"]);

            $res = event('DeliveryCancelOrder', ['site_id' => $this->site_id, 'data' => [

                'order_id' => $order['order_id'],
                'platform' => $order['platform'],
            ]]);


            event('CancelOrder', [
                'id' => $order['order_id'],
                'close_reason' => "用户主动退款",
            ]);

            Db::commit();
            return $res[0];
        } catch (Exception $e) {
            Db::rollback();
            Log::write('===聚合快递退款失败===' . date('Y-m-d H:i:s'));
            Log::write($e->getMessage());
            throw new CommonException($e->getMessage());
        }
    }

    //查看订单
    public function ViewOrder($data)
    {
        Db::startTrans();
        try {

            $order = (new OrderDeliveryService())->getOrderInfoByClient($data["OrderCode"]);

            $res = event('DeliveryViewOrder', ['site_id' => $this->site_id, 'data' => [

                'service_order_code' => $order['service_order_code'],
                'client_order_code' => $order['client_order_code'],

                'order_id' => $order['order_id'],
                'platform' => $order['platform'],
            ]]);
            Db::commit();
            return $res[0];
        } catch (Exception $e) {
            Db::rollback();
            Log::write('===聚合快递退款失败===' . date('Y-m-d H:i:s'));
            Log::write($e->getMessage());
            throw new CommonException($e->getMessage());
        }
    }

    //工单投诉
    public function ComplaintOrder($data)
    {
        Db::startTrans();
        try {

            $order = (new OrderDeliveryService())->getOrderInfoByClient($data["OrderCode"]);
            $arr = array_merge($data, [

                'service_order_code' => $order['service_order_code'],
                'client_order_code' => $order['client_order_code'],
                'order_id' => $order['order_id'],
                'platform' => $order['platform'],
            ]);

            $res = event('DeliveryComplaintOrder', ['site_id' => $this->site_id, 'data' => $arr]);
            Db::commit();
            return $res[0];
        } catch (Exception $e) {
            Db::rollback();
            Log::write('===聚合快递退款失败===' . date('Y-m-d H:i:s'));
            Log::write($e->getMessage());
            throw new CommonException($e->getMessage());
        }
    }

    public function ComplaintViewOrder($data)
    {
        Db::startTrans();
        try {

            $order = (new OrderDeliveryService())->getOrderInfoByClient($data["OrderCode"]);
            $arr = array_merge($data, [

                'service_order_code' => $order['service_order_code'],
                'client_order_code' => $order['client_order_code'],
                'order_id' => $order['order_id'],
                'platform' => $order['platform'],
            ]);

            $res = event('DeliveryComplaintViewOrder', ['site_id' => $this->site_id, 'data' => $arr]);
            Db::commit();
            return $res[0];
        } catch (Exception $e) {
            Db::rollback();
            Log::write('===聚合快递退款失败===' . date('Y-m-d H:i:s'));
            Log::write($e->getMessage());
            throw new CommonException($e->getMessage());
        }
    }

    //订单路由轨迹
    public function RouteOrder($data)
    {
        Db::startTrans();
        try {

            $order = (new OrderDeliveryService())->getOrderInfoByClient($data["OrderCode"]);

            $res = event('DeliveryRouteOrder', ['site_id' => $this->site_id, 'data' => [

                'service_order_code' => $order['service_order_code'],
                'client_order_code' => $order['client_order_code'],
                'order_id' => $order['order_id'],
                'platform' => $order['platform'],
            ]]);

            Db::commit();
            return $res[0];
        } catch (Exception $e) {
            Db::rollback();
            Log::write('===聚合快递退款失败===' . date('Y-m-d H:i:s'));
            Log::write($e->getMessage());
            throw new CommonException($e->getMessage());
        }
    }

    //下单
    public function CreateOrder($data)
    {
        //不足 1 公斤按 1 公斤
        if ($data['Weight'] < 1) {
            $data['Weight'] = 1;
        }

        Log::write("下单---" . json_encode($data, true) . '---' . date("Y-m-d H:i:s") . '------');

        try {
            Db::startTrans();
            //第一步获取订单价格和渠道
            $priceInfo = event('CalcPriceOrder', ['site_id' => $this->site_id, 'data' => $data]);
            $priceInfo = $priceInfo [0];

            Log::write("获取此订单下单渠道及价格" . json_encode($priceInfo, true) . '---' . date("Y-m-d H:i:s") . '------');
            if (!$priceInfo) {
                throw new CommonException("暂不支持此渠道的业务");
            }

            $data['platform'] = $priceInfo["result"]['platform'];


            $submitInfo = event('DeliverySendOrder', ['site_id' => $this->site_id, 'data' => $data]);
            //var_dump($submitInfo);
            $submitInfo = $submitInfo [0];
            if (isset($submitInfo['type']) && $submitInfo['type'] == 'error') {
                Db::commit();

                $result = [];
                $result["EBusinessID"] = 0;
                $result["Data"] = [];
                $result["ResultCode"] = 10004;
                $result["Reason"] = $submitInfo['msg'];
                $result["Success"] = false;
                return ['result' => $result];
            }

            Log::write("向第三方下单" . json_encode($submitInfo, true) . '---' . date("Y-m-d H:i:s") . '------');

            $order_delivery = [
                "site_id" => $this->site_id,
                "app_id" => $this->member_id,
                "platform" => $data['platform'],
                "order_id" => $submitInfo['order_id'],
                "delivery_id" => $submitInfo['delivery_id'],
                "client_order_code" => $submitInfo["client_order_code"],
                "service_order_code" => $submitInfo["service_order_code"],
                "delivery_type" => $data["ShipperCode"],
                "weight" => $data["Weight"],
                "goods" => $data['Commodity'][0]['GoodsName'],
                "package_count" => $data['Quantity'],
                "order_info" => $data
            ];

            $this->deliveryModel->save($order_delivery);
            (new OrderDeliveryReal())->create([
                'order_id' => $submitInfo['order_id'],
                "weight" => $data['Weight'],
            ]);

            $pay_data = [
                "order_id" => $data["order_id"],
                "site_id" => $this->site_id,
                "trade_type" => 1,
                "money" => $priceInfo['result']['totalFee'],
                "status" => PayDict::STATUS_WAIT,
            ];
            $this->payModel->save($pay_data);
            $pay_data['pay_id'] = $this->payModel->id;
            $pay_data['memo'] = "下单预扣费";
            event('PayCreate', $pay_data);

            $order_data = [
                'pay_time' => time(),
                'order_status' => OrderDict::FINISH_PAY,
                'is_enable_refund' => 1, // 是否允许退款
            ];
            $this->model->update($order_data, [
                'order_id' => $data["order_id"],
            ]);

            Db::commit();
            return $submitInfo;
        } catch (Exception $e) {
            Db::rollback();
            Log::write('下单失败' . date('Y-m-d H:i:s'));
            Log::write(json_encode($e));
            throw new CommonException($e->getMessage());
        }

        return true;
    }

    //回调


    //退款
    public function RefundOrder($data)
    {

        Log::write("回调---" . json_encode($data, true) . '---' . date("Y-m-d H:i:s") . '------');
        $order_id = $data["id"];
        $reason = $data["close_reason"];

        try {
            Db::startTrans();
            //检查是否已经退过款

            $order_info = (new OrderService())->getInfo($order_id);
            if (empty($order_info))
                throw new CommonException('订单获取失败');

            if ($order_info['refund_status'] == 1) {
                throw new CommonException('此订单已退款',);
            }


            //获取支付息
            $pay_info = (new FengChaoPayService())->getInfoByOrderId($order_id);


            if (empty($pay_info))
                throw new CommonException('支付订单获取失败');

            $pay_data = [
                "order_id" => $order_id,
                "trade_type" => 2,
                "site_id" => $this->site_id,
                "money" => $pay_info["money"],
                "status" => PayDict::STATUS_WAIT,
            ];
            $this->payModel->save($pay_data);
            $pay_data['pay_id'] = $this->payModel->id;
            $pay_data['memo'] = $reason;


            event('PayCreate', $pay_data);

            $change_data = [
                'order_status' => -1,
                'refund_status' => 1,
                'order_id' => $order_id
            ];
            (new OrderService())->update($change_data);

            Db::commit();
            return true;
        } catch (Exception $e) {
            Db::rollback();
            Log::write('订单撤单退款失败' . date('Y-m-d H:i:s'));
            Log::write($e->getMessage());
            throw new CommonException($e->getMessage());
        }

        return true;
    }

    public function NotifyOrder($data)
    {

        Log::write("回调处理---" . json_encode($data, true) . '---' . date("Y-m-d H:i:s") . '------');

        $order_id = $data["OrderCode"];
        $client_id = (new OrderDeliveryService())->getClientIdById($data["OrderCode"]);

        $state = $data["State"];


        try {
            Db::startTrans();
            $odi = (new OrderDelivery())
                ->where([['order_id', '=', $order_id]])->find();
            if (empty($odi))
                throw new CommonException('订单获取失败');

//            $odi->order_status = $state;
//            $odi->order_status_desc = $data["Reason"];
//            $odi->logistic_order_code = $data["LogisticCode"] ?? "";
//            $odi->picker_info = $data["PickerInfo"] ?? "{}";
//            $odi->update_time = time();
//            $odi->save($odi);
            $order = [
                "order_id" => $order_id,
                "reason" => $data["Reason"],
                "state" => $state,
                "server_data" => $data,
            ];
            (new OrderCallBackLogService())->add($order);

            $data["order_id"] = $order_id;

            event('SendNotify', $data);

            Db::commit();
            return true;
        } catch (Exception $e) {
            Db::rollback();
            Log::write('更新订单状态失败' . date('Y-m-d H:i:s'));
            Log::write($e->getMessage());
            throw new CommonException($e->getMessage());
        }

        return true;
    }


}