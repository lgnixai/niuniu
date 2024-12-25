<?php

namespace addon\fengchao\app\service\core\delivery;

use addon\fengchao\app\dict\delivery\KdniaoBrandDict;
use addon\fengchao\app\model\order\Order;
use addon\fengchao\app\service\core\ExpressService;
use Exception;
use think\facade\Log;

/**
 * 快递鸟
 */
class Yunjie extends BaseDelivery
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
    public function preOrder($params)
    {
        $data = [
            'ShipperCode' => 'JD',
            'PayType' => 2,
            'TransportType' => 1,
            'ShipperType' => 5,
            'Weight' => $params['Weight'],
            'InsureAmount' => $params['InsureAmount'] ?? 0,
            'Receiver' => [
                'Name' => $params['Receiver']['Name'] ?? '张三',
                'Mobile' => $params['Receiver']['Mobile'] ?? '13888888888',
                'Tel' => $params['Receiver']['Tel'] ?? '',
                'ProvinceName' => $params['Receiver']['ProvinceName'],
                'CityName' => $params['Receiver']['CityName'],
                'ExpAreaName' => $params['Receiver']['ExpAreaName'],
                'Address' => $params['Receiver']['Address'] ?? "兴凯花园 3-101",
            ],
            'Sender' => [
                'Name' => $params['Sender']['Name'] ?? '李四',
                'Mobile' => $params['Sender']['Mobile'] ?? '13888888888',
                'Tel' => $params['Sender']['Tel'] ?? '',
                'ProvinceName' => $params['Sender']['ProvinceName'],
                'CityName' => $params['Sender']['CityName'],
                'ExpAreaName' => $params['Sender']['ExpAreaName'],
                'Address' => $params['Sender']['Address'] ?? "兴凯花园 3-101",
            ]
        ];

        Log::write('云杰询价发送数据：' . json_encode($data));

        $resInfo = $this->execute('1002', $data);
        Log::write('云杰询价返回信息：' . json_encode($resInfo));
        if (!isset($resInfo['ResultCode']) || $resInfo['ResultCode'] != 100) return [];
        $callbackData = [];
        $resInfo = $resInfo['data'];

        $item = [];

        $item["weight"] = $params['Weight'];
        $item["shipperCode"] = "JD";

        $item["firstWeight"] = $resInfo['upperGround'];
        $item["firstWeightPrice"] = $resInfo['groundPrice'];
        $item["firstWeightAmount"] = $resInfo['groundPrice'];
        $item["continuousWeight"] = 0;
        $item["continuousWeightPrice"] = $resInfo['rateOfStage'];
        $item["continuousWeightAmount"] = $resInfo['rateOfStage'];
        $item["cost"] = $resInfo['totalfee'];
        $item["isSubsectionContinuousWeightPrice"] = 0;
        $item["totalFee"] = $resInfo['discountfee'];
        $item["price"] = [
            "calcFeeType" => '2',
            "perAdd" => 0,
            "cost" => $resInfo['totalfee'],
            "discount" => $resInfo['discount'],
            "discountfee" => $resInfo['discountfee'],
        ];
        $item["insureAmount"] = $resInfo['InsureAmount'] ?? 0;
        $item["premiumFee"] = $resInfo['InsureValue'] ?? 0;

        $callbackData[] = $item;
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
        $data['PayType']=2;
        $data["OrderCode"]=$params["order_id"];
       // $data['ExpType']=$data['ShipperCode'];
        unset($data['order_id'],$data['platform']);

        Log::write('云杰下单发送数据：' . json_encode($data));

         $resInfo = $this->execute('1801', $data);
//        $resInfo =[
//            'ResultCode' => 110,
//            'Reason' => '下单失败抱歉，当前收件地址暂未开通服务，努力建设中',
//
//        ];

        Log::write('云杰下单反回发送数据：' . json_encode($resInfo));
        if ($resInfo['ResultCode'] != 100) {
            Log::write('提交运单失败：yunjie_error--' . $resInfo['Reason']);
            return ['type' => 'error', 'msg' => $resInfo['Reason'] ?? '三方平台下单失败，请重新下单！'];
        }

        $res = [
            'service_order_code' => $resInfo['Order']['PlatCode'],
            'client_order_code' => $params["OrderCode"],
            'delivery_id' => $resInfo['Order']['LogisticCode'],
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
        $resInfo['data'] = $resInfo['ResultCode'];
        $resInfo['msg'] = $resInfo['Reason'];
        if ($resInfo['ResultCode'] == 100) {
            $resInfo['code'] = 200;
        }
        return $resInfo ?? '';
    }

    public function viewOrder($data)
    {
        $params = [
            "OrderCode" => $data['order_id'],
        ];
        $resInfo = $this->execute('1804', $params);
        $resInfo['data'] = $resInfo['ResultCode'];
        $resInfo['msg'] = $resInfo['Reason'];
        if ($resInfo['ResultCode'] == 100) {
            $resInfo['code'] = 200;
        }
        return $resInfo ?? '';
    }

    public function routeOrder($data)
    {
        $params = [
            "OrderCode" => $data['order_id'],
        ];
        $resInfo = $this->execute('1802', $params);
        $resInfo['data'] = $resInfo['ResultCode'];
        $resInfo['msg'] = $resInfo['Reason'];
        if ($resInfo['ResultCode'] == 100) {
            $resInfo['code'] = 200;
        }
        return $resInfo ?? '';
    }

    public function complaintOrder($data)
    {
        $params = [
            "OrderCode" => $data['order_id'],
        ];
        $resInfo = $this->execute('1802', $params);
        $resInfo['data'] = $resInfo['ResultCode'];
        $resInfo['msg'] = $resInfo['Reason'];
        if ($resInfo['ResultCode'] == 100) {
            $resInfo['code'] = 200;
        }
        return $resInfo ?? '';
    }

    public function complaintViewOrder($data)
    {
        $params = [
            "OrderCode" => $data['order_id'],
        ];
        $resInfo = $this->execute('1802', $params);
        $resInfo['data'] = $resInfo['ResultCode'];
        $resInfo['msg'] = $resInfo['Reason'];
        if ($resInfo['ResultCode'] == 100) {
            $resInfo['code'] = 200;
        }
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


        $url = 'https://open.yuntongzy.com/express/api/OrderService';

        $business_id = $this->config['appid'];
        $api_key = $this->config['appkey'];
        $requestData = json_encode($requestData);
        $datas = array(
            'EBusinessID' => $business_id,
            'RequestType' => $type,
            'RequestData' => urlencode($requestData),
            'DataType' => '2',
        );
        $datas['DataSign'] = $this->encrypt($requestData, $api_key);

        Log::write('云杰发送数据：' . $type . ':' . json_encode($datas));
        Log::write('云杰发送数据 url：' . $url);

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

        Log::write('云杰返回信息：' . $result);

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