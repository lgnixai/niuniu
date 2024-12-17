<?php
declare ( strict_types = 1 );

namespace addon\fengchao\app\listener\express;

use addon\fengchao\app\service\admin\site\SiteService;
use addon\fengchao\app\service\api\order\OrderCallBackLogService;

use addon\fengchao\app\service\api\order\OrderService;
use think\facade\Log;

class OrderPriceConfirmAfter
{

    public function handle($data)
    {
        Log::write('价格确认' . json_encode($data));
        $data=json_decode($data,true);




        $order["order_code"]=$data["OrderCode"];
        $order["result_price"]=$data;


        $order_info=(new OrderService())->getInfo($order["order_code"]);


        Log::write('订单信息' . json_encode($order_info));

        $info=$order_info["price_data"];

        $weight=max($data["Weight"],$data["VolumeWeight"]);

        // 续重*续重卖价
        $continuous_amount=$info["sellContinuousWeightPrice"]*ceil($weight-$info["firstWeight"]);


        $firstWeightAmount=max($info["sellFirstWeightAmount"],$data["FirstWeightAmount"]);
        $ContinuousWeightAmount=max($continuous_amount,$data["ContinuousWeightAmount"]);
        $cost=sprintf("%.2f",$firstWeightAmount+$continuous_amount);

        $TotalFee=sprintf("%.2f",$cost+$data["InsureAmount"]+$data["PackageFee"]+$data["OverFee"]+$data["OtherFee"]);


        // 重量取较大值
        $temp=[
            "Weight"=>$weight,
            "firstWeight"=>$info["firstWeight"],
            "continuousWeight"=>ceil($weight-$info["firstWeight"]),
            "firstWeightAmount"=>$firstWeightAmount,
            "ContinuousWeightAmount"=>$ContinuousWeightAmount,
            "Cost"=>sprintf("%.2f",$firstWeightAmount+$continuous_amount),

            "InsureAmount"=>$data["InsureAmount"],
            "PackageFee"=>$data["PackageFee"],
            "OverFee"=>$data["OverFee"],
            "OtherFee"=>$data["OtherFee"],
            "OtherFeeDetail"=>$data["OtherFeeDetail"],
            "TotalFee"=>max($TotalFee,$data["TotalFee"]),
            "Volume"=>$data["Volume"],
            "VolumeWeight"=>$data["VolumeWeight"]
        ];

        $order["user_price"]=$temp;


        $id=(new OrderService())->update($order);

        if (isset($temp["TotalFee"]) && is_numeric($temp["TotalFee"])) {
            // 将其转成负数
            $account_data = -abs(floatval($temp["TotalFee"]));
        } else {
            // 处理非数字情况
            $account_data = 0; // 或者根据需求处理
        }

        $balance["site_id"]=$order_info["site_id"];

        $balance["account_data"]=$account_data;
        $balance["from_type"]="order";
       // $balance["adjust_type"]=-1;
        $balance["memo"]=$data["OrderCode"]."扣费";

        // 余额调整
        $res = ( new SiteService() )->adjustBalance($balance);

    }
}
