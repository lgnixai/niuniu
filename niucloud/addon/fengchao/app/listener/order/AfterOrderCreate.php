<?php
declare ( strict_types = 1 );

namespace addon\fengchao\app\listener\order;

 use addon\fengchao\app\service\api\order\OrderService;
 use addon\fengchao\app\service\api\common\Utils;
use addon\fengchao\app\service\api\order\OrderPrice;

use think\facade\Log;

class AfterOrderCreate
{

    public function handle($data)
    {
        Log::write('订单AfterOrderCreate' . json_encode($data));
        if ($data['Success']==false){

        }


//        //先询价
//       $price= (new OrderPrice())->ask_price($data);
//       $order=[];
//
//       $request_data = Utils::getJson($data['request']);
//       $response_data = ($data['response']);
//
//       Log::write('快递鸟接口2' . json_encode($response_data,JSON_UNESCAPED_UNICODE));
//       $order["client_data"]=$request_data;
//       $order["site_id"]=$data['site_id'];
//       $order["order_code"]=$request_data["OrderCode"];
//       $order["kdn_code"]=$response_data["Order"]["KDNOrderCode"];
//       $order["server_data"]=$data['response'];
//       $order["price_data"]=$price;
//       $order["result_price"]=$price;
//       $order["user_price"]=$price;
//       $id=(new OrderService())->add($order);

    }
}
