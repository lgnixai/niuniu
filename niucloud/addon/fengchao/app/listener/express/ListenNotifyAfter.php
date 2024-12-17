<?php
declare ( strict_types = 1 );

namespace addon\fengchao\app\listener\express;

use addon\fengchao\app\service\api\order\OrderCallBackLogService;

use think\facade\Log;

class ListenNotifyAfter
{

    public function handle($data)
    {
        Log::write('收到消息' . json_encode($data, JSON_UNESCAPED_UNICODE));

        $code = $data['RequestType'] ;
        Log::write('收到消息' .$code);

        $request = json_decode($data['RequestData'], true);


         foreach ($request["Data"] as $key => $value){

             if (preg_match('/^(\d{6})_(.*)$/', $value["OrderCode"], $matches)) {
                 $before_colon = $matches[1]; // 冒号前的部分
                 $order_code = $matches[2]; // 冒号后的内容
                 $value["OrderCode"]=$order_code;

                 $order["order_code"]=$order_code;

                 $order["state"]=$value["State"];
                 $result = match ($value["State"]) {
                     "301", "208","601" => true,
                     default => false,
                 };
                 if($result){
                     event('OrderPriceConfirmAfter', json_encode($value, JSON_UNESCAPED_UNICODE));
                 }

                 $order["kdn_code"]=$value["KDNOrderCode"];
                 $order["server_data"]=$request;
                 $id=(new OrderCallBackLogService())->add($order);
             }


         }

    }
}
