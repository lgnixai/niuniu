<?php
declare ( strict_types = 1 );

namespace addon\fengchao\app\listener\express;

use addon\fengchao\app\model\order\NotifyLog;
use addon\fengchao\app\model\order\OrderFee;
use addon\fengchao\app\service\admin\site\SiteAuthService;
use addon\fengchao\app\service\api\order\OrderCallBackLogService;

use addon\fengchao\app\service\core\common\OrderDeliveryService;
use addon\fengchao\app\service\core\NotifyLogService;
use think\facade\Log;

class SendNotify
{

    public function handle($data)
    {
        Log::write('需要给下游客户发送的' . json_encode($data, JSON_UNESCAPED_UNICODE));
        $result = match ($data["State"]) {
            "301", "208","601" => true,
            default => false,
        };

        if($result){
            $fee=(new OrderFee())->where([["order_id","=",$data["FCOrderCode"]],["order_type","=",2]])->findOrEmpty()->toArray();


            Log::write('需要给下游客户发送的333333' . json_encode($fee, JSON_UNESCAPED_UNICODE));


            $data["FirstWeightAmount"]=$fee["first_weight_amount"];
            $data["ContinuousWeightAmount"]=$fee["continuous_weight_amount"];
            $data["Cost"]=$fee["cost"];
            $data["InsureAmount"]=$fee["insure_amount"];
            $data["PackageFee"]=$fee["package_fee"];
            $data["OverFee"]=$fee["over_fee"];
            $data["OtherFee"]=$fee["other_fee"];
            $data["OtherFeeDetail"]=$fee["other_fee_detail"];
            $data["TotalFee"]=$fee["total_fee"];
         }
        $auth = (new SiteAuthService())->getByAppKey($data["EBusinessID"]);

        $notify=[];
        //$notify["site_id"]=$data["FCOrderCode"];
        $notify["body"]=json_encode($data, JSON_UNESCAPED_UNICODE);
        $notify["url"]=$auth["callback_url"];
        Log::write('需要给下游客户发送的555' . json_encode($notify, JSON_UNESCAPED_UNICODE));

         (new NotifyLogService())->add($notify);
        Log::write('需要给下游客户发送的66666' . json_encode($notify, JSON_UNESCAPED_UNICODE));



    }
}
