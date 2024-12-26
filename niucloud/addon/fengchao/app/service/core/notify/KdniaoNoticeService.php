<?php

namespace addon\fengchao\app\service\core\notify;

use addon\fengchao\app\dict\order\OrderDict;
use addon\fengchao\app\model\order\FengChaoOrder;


use addon\fengchao\app\model\order\OrderDelivery;
use addon\fengchao\app\model\OrderDeliveryReal;
use addon\fengchao\app\model\pay\FengChaoPay;

use addon\fengchao\app\service\core\CommonService;
use addon\fengchao\app\service\core\FengChaoPayService;
use addon\fengchao\app\service\core\order\OrderService;
use app\dict\pay\PayDict;
use app\service\core\notice\NoticeService;
use core\base\BaseApiService;
use core\exception\CommonException;
use think\db\exception\DbException;
use think\Exception;
use think\facade\Db;
use think\facade\Log;
use think\Response;

/**
 * 快递鸟回调对接
 */
class KdniaoNoticeService extends BaseApiService
{
    public function __construct()
    {
        parent::__construct();
        $this->orderModel = new FengChaoOrder();
        $this->deliveryModel = new OrderDelivery();
        $this->payModel = new FengChaoPay();

        $this->deliveryRealModel = new OrderDeliveryReal();
    }

    public function notice($data)
    {
        Log::write('=====快递鸟回调信息=====' . date('Y-m-d H:i:s', time()));
        Log::write($data);
        if ($data['RequestType'] != 103) return Response::create(['EBusinessID' => $data['RequestData']['EBusinessID'] ?? '100000', 'UpdateTime' => date('Y-m-d H:i:s', time()), 'Success' => true]);
        $requestData = json_decode($data['RequestData'], true);//请求的DATA
        $params = $requestData['Data'];
        $sign = $data['DataSign'];

        foreach ($params as $k => $v) {

            $this->sub($v, $requestData, $sign);
        }
        Log::write('=====快递鸟业务执行完成=====' . date('Y-m-d H:i:s', time()));

        return Response::create(['EBusinessID' => $data['RequestData']['EBusinessID'] ?? '100000', 'UpdateTime' => date('Y-m-d H:i:s', time()), 'Success' => true]);
    }

    public function sub($params, $requestData, $sign)
    {


        $order_id = $params['OrderCode'];
        $order_s = $this->orderModel->where(['order_id' => $order_id])->findOrEmpty();
        Log::write('=====快递鸟订单信息====='.json_encode($order_s) . date('Y-m-d H:i:s', time()));

        if ($order_s->isEmpty()) return;
        $order_info = $this->deliveryModel->where(['order_id' => $order_id])->findOrEmpty();

        Log::write('=====快递鸟物流单====='.json_encode($order_info)  . date('Y-m-d H:i:s', time()));

        if ($order_info->isEmpty()) return;
        $config = (new CommonService())->getSiteDriver('kdniao')['params'];
        if (!isset($config['api_key']) || $config['api_key'] == '') return;
        //if ($this->encrypt($requestData, $config['api_key']) != $sign) return;
        //参数验证完成具体业务封装
        $state = $params['State'];
        Log::write('=====快递鸟回调进入业务执行====='.json_encode($params) . date('Y-m-d H:i:s', time()));

        //订单调度失败/取消推送/虚假揽件 进行订单取消
        if ($state == 99 || $state == 203 || $state == 206) $this->closeOrder($order_id, $params);
        //推送网点/快递员信息
        if ($state == 102 || $state == 103) $this->changePick($order_id, $params);
        //推送取件状态
        if ($state == 104) $this->pickPackage($order_id, $params);
        //推送揽收状态改变重量
        if ($state == 301 || $state == 601 || $state == 208) $this->changeWeight($order_id, $params);
        //推送更换运单信息
        if ($state == 302) $this->changeDelivery($order_id, $params);
        //推送签收状态
        if ($state == 3) $this->signPackage($order_id, $params);
    }

    /**
     * @Notes:订单签收
     * signPackage
     * @param $order_id
     * @param $params
     * 2024/12/12  22:46
     * author:TK
     */
    public function signPackage($order_id, $params)
    {
        $orderInfo = $this->orderModel->where(['order_id' => $order_id])->findOrEmpty();
        if ($orderInfo['order_status'] == OrderDict::FINISH) return true;
        $orderInfo->save(['order_status' => OrderDict::FINISH]);
//        (new NoticeService())->send($orderInfo['site_id'], 'fengchao_order_sign', ['order_id' => $orderInfo['order_id']]);
//        event('JhkdOrderFinish', $orderInfo);
    }

    /**
     * @Notes:运单改变
     * changeDelivery
     * @param $order_id
     * @param $params
     * 2024/12/12  22:46
     * author:TK
     */
    public function changeDelivery($order_id, $params)
    {
        $deliveryInfo = $this->deliveryModel->where(['order_id' => $order_id])->findOrEmpty();
        Log::write('=====快递鸟changeDelivery====='.json_encode($deliveryInfo) . date('Y-m-d H:i:s', time()));

        if ($deliveryInfo->isEmpty()) return;
        $deliveryInfo->save([
            'delivery_id' => $params['LogisticCode'] ?? '',
            'delivery_type' => $params['ShipperCode'] ?? '',
        ]);
    }

    /**
     * @Notes:揽收计费
     * changeWeight
     * @param $order_id
     * @param $params
     * @throws \Exception
     * @throws \Exception
     * 2024/12/12  22:46
     * author:TK
     */

    public function changeWeight($order_id, $params)
    {
        Db::startTrans();

        try {
            $deliveryInfo = $this->deliveryModel->where(['order_id' => $order_id])->findOrEmpty();

            Log::write('=====快递鸟changeWeight====='.json_encode($deliveryInfo) . date('Y-m-d H:i:s', time()));

            if ($deliveryInfo->isEmpty()) {
                return Response::create(['msg' => '接受成功', 'code' => 200, 'success' => true], 'json', 200);
            }
            $realInfo = $this->deliveryRealModel->where(['order_id' => $deliveryInfo['order_id']])->findOrEmpty();
            $feeBlockList = [
                [
                    "fee" => $params['Cost'],
                    "type" => '0',
                    "name" => '重量计费'
                ],
                [
                    "fee" => $params['PackageFee'] ?? 0,
                    "type" => '1',
                    "name" => '包装费用'
                ],
                [
                    "fee" => $params['InsureAmount'] ?? 0,
                    "type" => '2',
                    "name" => '保价费用'
                ],
                [
                    "fee" => $params['OtherFee'] ?? 0,
                    "type" => '4',
                    "name" => '其他费用'
                ],
                [
                    "fee" => $params['OverFee'] ?? 0,
                    "type" => '5',
                    "name" => '超长超重费'
                ],
            ];

            $total_fee=0;
            foreach ($feeBlockList as $key => $value) {
                if (is_array($value)) {

                        $total_fee += $value['fee'];

                }
            }
            $total_fee=round($total_fee,2);

            Log::write('=====快递鸟changeWeight====='.json_encode($feeBlockList) . date('Y-m-d H:i:s', time()));

            Log::write('=====快递鸟changeWeight====='.json_encode($params) . date('Y-m-d H:i:s', time()));

            $feeWeight = $params['Weight'];
            $realInfo->where(['order_id' => $deliveryInfo['order_id']])->update([
                'order_id' => $deliveryInfo['order_id'],
                'weight' => $params['Weight'],
                'volume' => $params['Volume'] ?? 0,
                'fee_weight' => $feeWeight,
                'fee_blockList' => json_encode($feeBlockList),
                'total_fee' => $params['TotalFee'],
            ]);
            $orderInfo = $this->orderModel->where(['order_id' => $deliveryInfo['order_id']])->findOrEmpty();
            $orderInfo->save(['order_status' => OrderDict::FINISH_PICK]);


            //获取支付信息
            $pay_info= (new FengChaoPayService())->getInfoByOrderId($order_id);
            if (empty($pay_info))
                throw new CommonException('支付订单获取失败');




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

            $odi->weight=$params["Weight"];
            $odi->total_fee=$total_fee;
            $odi->volume=$params["Volume"];
            $odi->volume_weight=$params["VolumeWeight"];
            $odi->update_time=time();
            $odi->save($odi);

            Db::commit();


        } catch (Exception $e) {
            Db::rollback();
            throw new CommonException($e->getMessage());
        }
    }


    /**
     * @Notes:快递员操作揽收包裹  不返回重量
     * pickPackage
     * @param $order_id
     * @param $params
     * 2024/12/12  22:47
     * author:TK
     */
    public function pickPackage($order_id, $params)
    {
        //Log::write('快递鸟pickPackage'. json_encode($params). date('Y-m-d H:i:s', time()));

        $deliveryInfo = $this->deliveryModel->where(['order_id' => $order_id])->findOrEmpty();
        if ($deliveryInfo->isEmpty()) return;
        Log::write('快递鸟pickPackage'. json_encode($params). date('Y-m-d H:i:s', time()));

        $orderInfo = $this->orderModel->where(['order_id' => $deliveryInfo['order_id']])->findOrEmpty();
        $orderInfo->save(['order_status' => OrderDict::FINISH_PICK]);

        Log::write('快递鸟pickPackage'. json_encode($orderInfo). date('Y-m-d H:i:s', time()));

        //(new NoticeService())->send($orderInfo['site_id'], 'fengchao_order_pick', ['order_id' => $orderInfo['order_id']]);
    }

    /**
     * @Notes:推送网点或者揽件员
     * changePick
     * @param $order_id
     * @param $params
     * 2024/12/12  20:58
     * author:TK
     */
    public function changePick($order_id, $params)
    {
        $pickInfo = $params['PickerInfo'][0];
        $deliveryInfo = $this->deliveryModel->where(['order_id' => $order_id])->findOrEmpty();
        if ($deliveryInfo->isEmpty()) return;
        if ($params['State'] == 102) {
            $u_data = [
                'courierName' => $pickInfo['StationName'] ?? '',
                'courierPhone' => $pickInfo['StationTel'] ?? '',
                'pickUpCode' => $pickInfo['PickupCode'] ?? '',
            ];
        } else {
            $u_data = [
                'courierName' => $pickInfo['PersonName'] ?? '',
                'courierPhone' => $pickInfo['PersonTel'] ?? '',
                'pickUpCode' => $pickInfo['PickupCode'] ?? '',
            ];
        }

        Log::write('快递鸟changePick'. json_encode($u_data). date('Y-m-d H:i:s', time()));

        $deliveryInfo->save([
            'delivery_id' => $params['LogisticCode'] ?? '',
            'pickup_info' => json_encode($u_data)
        ]);
    }

    /**
     * @Notes:取消订单调度
     * closeOrder
     * @param $order_id
     * @param $params
     * 2024/12/12  15:02
     * author:TK
     */
    public function closeOrder($order_id, $params)
    {
        //$order_info = $this->orderModel->where(['order_id' => $order_id])->findOrEmpty();;
        event('CancelOrder', [
            'id' => $order_id,
            'close_reason' => $params['Reason'],
        ]);
        return;
    }

    /**
     * @Notes:封装签名
     * encrypt
     * @param $data
     * @param $ApiKey
     * 2024/12/12  15:02
     * author:TK
     */
    public function encrypt($data, $ApiKey)
    {
        $data = json_encode($data);
        $data = urlencode($data);
        return urlencode(base64_encode(md5($data . $ApiKey)));
    }

}