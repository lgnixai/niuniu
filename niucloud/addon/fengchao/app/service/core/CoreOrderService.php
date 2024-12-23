<?php

namespace addon\fengchao\app\service\core;


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


    public function ChangeAppId($params){
        $params["EBusinessID"]=$this->member_id;
        return $params;
    }
    public function checkBalance($params)
    {
        $balance = (new BalanceService())->getInfo();
        if (empty($balance))
            throw new CommonException('查询余额出错');

        $linePrice=(new LinePriceService())->getOrderLinePrice($params);
        if (empty($linePrice))
            throw new CommonException('线路报价出错');

        if ($balance["balance"]<$linePrice['totalFee']){
            throw new CommonException('余额不足，请充值');
        };
        return true;
    }

    public function preOrder($params)
    {
        $dataInfo=(new LinePriceService())->getLinePrice($params);
        usort($dataInfo, function ($a, $b) {
            return $a['totalFee'] <=> $b['totalFee'];
        });

        return $dataInfo;
    }
    //下单
    public function createOrder($data)
    {

        Log::write("下单---".json_encode($data,true).'---'.date("Y-m-d H:i:s").'------');

        try {
            Db::startTrans();

            $linePrice=(new LinePriceService())->getOrderLinePrice($data);

            $order = [
                "site_id" => $this->site_id,
                'ip' => request()->ip() ?? '',
                "order_id" => $data["result"]["OrderCode"],
            ];
            $this->model->save($order);

            $order_delivery = [
                "site_id" => $this->site_id,
                "app_id" => $this->member_id,
                "order_id" => $order["order_id"],
                "line_price_id" => $linePrice["id"],
                "client_order_code" => $data["OrderCode"],
                "service_order_code" => $data["result"]["KDNOrderCode"],
                "order_info"=>$data
            ];

            $this->deliveryModel->save($order_delivery);


            $pay_data = [
                "order_id" => $order["order_id"],
                "site_id" => $this->site_id,
                "trade_type" => 1,
                "money" => $linePrice["totalFee"],
                "status" => PayDict::STATUS_WAIT,
            ];
            $this->payModel->save($pay_data);
            $pay_data['pay_id']=$this->payModel->id;
            $pay_data['memo']="下单预扣费";
            event('PayCreate', $pay_data);
            Db::commit();
            return true;
        } catch (Exception $e) {
            Db::rollback();
            Log::write('下单失败' . date('Y-m-d H:i:s'));
            Log::write($e->getMessage());
            throw new CommonException($e->getMessage());
        }

        return true;
    }
    //回调
    public function ConfirmOrder($data)
    {

        Log::write("回调---".json_encode($data,true).'---'.date("Y-m-d H:i:s").'------');
        $order_id=$data["OrderCode"];
        $client_id= (new OrderDeliveryService())->getClientIdById($data["OrderCode"]);
        $server_order_id=$data["KDNOrderCode"];

        $state=$data["State"];
        try {
            Db::startTrans();

            $order_info= (new OrderService())->getInfo($order_id);
            if (empty($order_info))
                throw new CommonException('订单获取失败');

            if($order_info['add_price_status']==1){
                throw new CommonException('此订单已补完差价');
            }

            //获取支付息
            $pay_info= (new FengChaoPayService())->getInfoByOrderId($order_id);
            if (empty($pay_info))
                throw new CommonException('支付订单获取失败');

            $params=$data;
            $params["order_id"]=$order_id;

            $total_fee= (new PriceService())->PriceAndRule($params);



            $money=sprintf("%.2f",$total_fee-$pay_info["money"]);



            $pay_data = [
                "order_id" => $order_id,
                "site_id" => $this->site_id,
                "trade_type" =>  3,
                "money" => $money,
                "status" => PayDict::STATUS_WAIT,
            ];
            $this->payModel->save($pay_data);

            $pay_data['pay_id']=$this->payModel->id;
            $pay_data['memo']="订单补差价";

            event('PayCreate', $pay_data);

            $change_data=[
                'add_price_status'=>1,
                'order_id'=>$order_id
            ];
            (new OrderService())->update($change_data);
            //修改订单明细
            $odi= (new OrderDelivery())
                ->where([['order_id', '=', $order_id]])->find( );
            if (empty($odi))
                throw new CommonException('订单获取失败');
            $odi->weight=$data["Weight"];
            $odi->total_fee=$total_fee;
            $odi->volume=$data["Volume"];
            $odi->volume_weight=$data["VolumeWeight"];
            $odi->update_time=time();
            $odi->save($odi);



            Db::commit();
            return true;
        } catch (Exception $e) {
            Db::rollback();
            Log::write('订单确认费用失败' . date('Y-m-d H:i:s'));
            Log::write($e->getMessage());
            throw new CommonException($e->getMessage());
        }

        return true;
    }
//回调
    public function CancelOrder($data)
    {

        Log::write("回调---".json_encode($data,true).'---'.date("Y-m-d H:i:s").'------');
        $order_id=$data["OrderCode"];
        $client_id= (new OrderDeliveryService())->getClientIdById($data["OrderCode"]);

        $server_order_id=$data["KDNOrderCode"];
        $state=$data["State"];
        try {
            Db::startTrans();
            //检查是否已经退过款

            $order_info= (new OrderService())->getInfo($order_id);
            if (empty($order_info))
                throw new CommonException('订单获取失败');

            if($order_info['refund_status']==1){
                throw new CommonException('此订单已退款');
            }


            //获取支付息
            $pay_info= (new FengChaoPayService())->getInfoByOrderId($order_id);


            if (empty($pay_info))
                throw new CommonException('支付订单获取失败');

            $pay_data = [
                "order_id" => $order_id,
                "trade_type" => 2,
                "money" => $pay_info["money"],
                "status" => PayDict::STATUS_WAIT,
            ];
            $this->payModel->save($pay_data);
            $pay_data['pay_id']=$this->payModel->id;
            $pay_data['memo']="取消订单退款";

            event('PayCreate', $pay_data);

            $change_data=[
                'refund_status'=>1,
                'order_id'=>$order_id
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

        Log::write("回调处理---".json_encode($data,true).'---'.date("Y-m-d H:i:s").'------');

        $order_id=$data["OrderCode"];
        $client_id= (new OrderDeliveryService())->getClientIdById($data["OrderCode"]);
        $server_order_id=$data["KDNOrderCode"];
        $state=$data["State"];


        try {
            Db::startTrans();
            //检查是否已经退过款

            $odi= (new OrderDelivery())
                ->where([['order_id', '=', $order_id]])->find( );
            if (empty($odi))
                throw new CommonException('订单获取失败');

            $odi->order_status=$state;
            $odi->order_status_desc=$data["Reason"];
            $odi->logistic_order_code=$data["LogisticCode"]??"";
            $odi->picker_info=$data["PickerInfo"]??"{}";
            $odi->update_time=time();
            $odi->save($odi);
            $order=[
                "order_id"=>$data["OrderCode"],
                "state"=>$state,
                "server_data"=>$data,
            ];
            (new OrderCallBackLogService())->add($order);

            $data["OrderCode"]=$client_id;
            $data["FCOrderCode"]=$order_id;
            event('SendNotify',$data );

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