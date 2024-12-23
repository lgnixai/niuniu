<?php
declare ( strict_types = 1 );

namespace addon\fengchao\app\listener\express;

use addon\fengchao\app\model\order\NotifyLog;
use addon\fengchao\app\model\order\OrderFee;
use addon\fengchao\app\service\admin\site\SiteAuthService;
use addon\fengchao\app\service\api\order\OrderCallBackLogService;

use addon\fengchao\app\service\core\common\CommonService;
use addon\fengchao\app\service\core\common\OrderDeliveryService;
use addon\fengchao\app\service\core\NotifyLogService;
use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;
use think\Exception;
use think\facade\Log;

class SendNotify
{

    public function handle($data)
    {
        $result = match ($data["State"]) {
            "301", "208","601" => true,
            default => false,
        };

        if($result){
            $fee=(new OrderFee())->where([["order_id","=",$data["FCOrderCode"]],["order_type","=",2]])->findOrEmpty()->toArray();




            $data["FirstWeightAmount"]=$fee["first_weight_amount"];
            $data["ContinuousWeightAmount"]=$fee["continuous_weight_amount"];
            $data["Cost"]=$fee["cost"];
            $data["InsureAmount"]=$fee["insure_amount"];
            $data["PackageFee"]=$fee["package_fee"];
            $data["OverFee"]=$fee["over_fee"];
            $data["OtherFee"]=$fee["other_fee"];
            $data["OtherFeeDetail"]=$fee["other_fee_detail"];
            $data["TotalFee"]=$fee["total_fee"];

            Log::write('下放消息价格更新有关的' . json_encode($fee, JSON_UNESCAPED_UNICODE));

        }

        $notify=[];

        $api=(new CommonService())->GetApiKeyByOrderId($data["FCOrderCode"]);

        $body=[];
        $body["RequestData"]=[
            "PushTime"=>date("Y-m-d H:i:s"),
            "EBusinessID"=>$api["api_key"],
            "Data"=>[$data],
            "Count"=>1,
        ];

        Log::write('api_secret' . $api['api_secret']);

        Log::write('需要给队列发送的body' . json_encode($body["RequestData"], JSON_UNESCAPED_UNICODE));
        $body["RequestData"]=( json_encode($body["RequestData"]));
        $body["DataSign"]= base64_encode(md5( json_encode($body["RequestData"]).$api['api_secret']));

        $body["RequestType"]= 103;
        $notify["body"]=($body);
        $notify["url"]=$api["callback_url"];

        Log::write('需要给队列发送的' . json_encode($notify, JSON_UNESCAPED_UNICODE));
        $res= $this->execute($notify);
        $res= $this->dev_execute($body);
        Log::write('发送给下游客户' . json_encode($res, JSON_UNESCAPED_UNICODE));

        $notify["body"]=json_encode($body, JSON_UNESCAPED_UNICODE);
        (new NotifyLogService())->add($notify);
        Log::write('保存日志' . json_encode($notify, JSON_UNESCAPED_UNICODE));


    }
    public function execute($body)
    {
        $timestamp = (string)intval(microtime((bool)1) * 1000);
         $url="http://127.0.0.1:8888/api/client/callback";
        $url="https://weidanyun-gpo-weidanyun-xuwjswesde.cn-shenzhen.fcapp.run/fengchao/notify";
        $header = ["Content-Type: application/json;charset=UTF-8"];
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body, JSON_UNESCAPED_UNICODE));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        $result = curl_exec($curl);
        $err = curl_error($curl);

      //  Log::write('发送给下游客户' . json_encode($result, JSON_UNESCAPED_UNICODE));

        curl_close($curl);
        if ($err) {
            throw new Exception($err);
        } else {
            return json_decode($result, true);
        }
    } public function dev_execute($body)
    {
        $timestamp = (string)intval(microtime((bool)1) * 1000);
         $url="http://127.0.0.1:8888/api/client/callback";
        $url="http://kd.fengchao100.com:8888/api/tk_jhkd/kdniaonotice";
        $header = ["Content-Type: application/json;charset=UTF-8"];
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body, JSON_UNESCAPED_UNICODE));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        $result = curl_exec($curl);
        $err = curl_error($curl);

      //  Log::write('发送给下游客户' . json_encode($result, JSON_UNESCAPED_UNICODE));

        curl_close($curl);
        if ($err) {
            throw new Exception($err);
        } else {
            return json_decode($result, true);
        }
    }
}
