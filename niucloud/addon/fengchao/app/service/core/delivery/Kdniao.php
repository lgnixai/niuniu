<?php

namespace addon\fengchao\app\service\core\delivery;

use addon\fengchao\app\dict\delivery\KdniaoBrandDict;
use addon\fengchao\app\model\order\Order;
use addon\fengchao\app\service\core\ExpressService;
use addon\fengchao\app\service\core\LinePriceService;
use Exception;
use think\facade\Log;

/**
 * 快递鸟
 */
class Kdniao extends BaseDelivery
{
    protected $config;

    /**
     * @param array $config
     * @return void
     */
    protected function initialize(array $config = [])
    {
        parent::initialize($config);
        $this->config = $config;
    }

    /**
     * @Notes:预下单
     * preOrder
     * @param $params
     * @throws Exception
     * @throws Exception
     * 2024/12/12  08:33
     * author:TK
     */
    public function preOrder($data)
    {

        $callbackData = (new LinePriceService())->getLinePrice($data);
        return $callbackData;
    }

    /**
     * @Notes:发送订单
     * sendOrder
     * @param $params
     * 2024/12/12  08:33
     * author:TK
     */
    public function sendOrder($params)
    {

        $data=$params;
        $data["OrderCode"]=$params["order_id"];
        $data['TransportType']=1;
        $data['ShipperType']=5;
        $resInfo = $this->execute('1801', $data);

        Log::write('快递鸟下单发送数据333：' . json_encode($resInfo));
        if ($resInfo['ResultCode'] != 100) {
            Log::write('提交运单失败：kdniao_error--' . $resInfo['Reason']);
            return ['type' => 'error', 'msg' => $resInfo['Reason'] ?? 'kdniao三方平台下单失败，请重新下单！'];
        }
        $resInfo['Order']['OrderCode']=$params["OrderCode"];
        $resInfo["Reason"] = "平台已接单";
        $res = [
            'service_order_code' => $resInfo['Order']['KDNOrderCode'],
            'client_order_code' => $params["OrderCode"],
            'delivery_id' => "",
            'order_id' => $params["order_id"],
            'result'=>$resInfo
        ];
        return $res;
    }

    public function callbackOrder($data)
    {

    }

    /**
     * @Notes:取消订单
     * cancelOrder
     * @param $data
     * 2024/12/12  08:32
     * author:TK
     */
    public function cancelOrder($data)
    {

        $params = [
            "OrderCode" => $data['order_id'],
        ];
        $resInfo = $this->execute('1802', $params);
//        $resInfo['data'] = $resInfo['ResultCode'];
//        $resInfo['msg'] = $resInfo['Reason'];
        return $resInfo ?? '';
    }

    public function viewOrder($data)
    {

        $params = [
            "OrderCode" => $data['order_id'],
        ];
        $resInfo = $this->execute('1804', $params);

        return $resInfo ?? '';
    }


    public function routeOrder($data)
    {

        $params = [
            "KdnOrderCode" => $data['service_order_code'],
        ];
        $resInfo = $this->execute('1816', $params);
//        $resInfo['data'] = $resInfo['ResultCode'];
//        $resInfo['msg'] = $resInfo['Reason'];
        return $resInfo ?? '';
    }

    public function complaintOrder($data)
    {

        $params = $data;
        $params["OrderCode"]=$data["order_id"];
        $resInfo = $this->execute('1807', $params);

        return $resInfo ?? '';
    }

    public function complaintViewOrder($data)
    {
        $params = [
            "kdnOrderCodes" => [$data['service_order_code']],
        ];
        $resInfo = $this->execute('1818', $params);

        return $resInfo ?? '';
    }

    /**
     * @Notes:轨迹查询
     * deliveryTrance
     * @param $params
     * @throws Exception
     * @throws Exception
     * 2024/12/12  08:32
     * author:TK
     */
    public function deliveryTrance($params)
    {
        //使用阿里云驱动查询
        if ($params['delivery_type'] == 'SF') {
            $params['mobile'] = json_decode($params['start_address'], true)['mobile'];
            $params['mobile'] = substr($params['mobile'], -4);
        }
        $order_info = (new Order())->where(['order_id' => $params['order_id']])->findOrEmpty();
        if ($order_info->isEmpty()) return [];
        $params['site_id'] = $order_info['site_id'];
        return (new ExpressService())->queryExpress($params['site_id'], $params);
    }


    public function getBalance()
    {
        return '请前往快递鸟开放平台查询';
    }

    /**
     * @Notes:公用执行
     * execute
     * @param $type
     * @param $requestData
     * 2024/12/12  00:09
     * author:TK
     */
    public function execute($type, $requestData)
    {


        //沙箱环境
        if (isset($this->config['is_test']) && $this->config['is_test'] == 1) {
            $url = 'http://183.62.170.46:8081/api/dist';
            //  $url = 'http://shop.fengchao100.com:8080/api/v1/order';
        } else {
            $url = 'https://api.kdniao.com/api/OOrderService';
        }
        $business_id = 350238;//$this->config['business_id'];
        $api_key = "082bff05-66ba-46b3-ae64-804c7cff990c";//$this->config['api_key'];
        //
        $business_id = $this->config['business_id'];
        $api_key = $this->config['api_key'];
        $requestData = json_encode($requestData);
        Log::write('快递鸟预下单发送数据1：' . $requestData);

        $datas = array(
            'EBusinessID' => $business_id,
            'RequestType' => $type,
            'RequestData' => urlencode($requestData),
            'DataType' => '2',
        );
        $datas['DataSign'] = $this->encrypt($requestData, $api_key);

        Log::write('快递鸟预下单发送数据2：' . $type . ':' . json_encode($datas));
        Log::write('快递鸟预下单发送数据：' . $url);

        $postdata = http_build_query($datas);
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type:application/x-www-form-urlencoded',
                'content' => $postdata,
                'timeout' => 15 * 60 // 超时时间（单位:s）
            )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        Log::write('快递鸟预下单返回信息：' . $result);

        return json_decode($result, true);
    }

    /**
     * @Notes:加签
     * encrypt
     * @param $data
     * @param $ApiKey
     * 2024/12/12  00:09
     * author:TK
     */
    public function encrypt($data, $ApiKey)
    {
        return urlencode(base64_encode(md5($data . $ApiKey)));
    }

}