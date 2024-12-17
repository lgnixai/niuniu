<?php
declare ( strict_types = 1 );

namespace addon\fengchao\app\listener\order;

use addon\fengchao\app\service\admin\site\OrderLogService;
use addon\fengchao\app\service\api\common\Utils;
use think\facade\Log;

class CreateOrderLog
{
//
//    public function handle($data)
//    {
//        Log::write('订单CreateOrderLog' . json_encode($data));
//        try {
//            $log = new OrderLogService();
//            $logdata = [];
//            $logdata["site_id"] = $data['site_id'];
//            $logdata["code"] = $data['code'];
//            $logdata["request_type"] = $data['request_type'];
//            $logdata["request_data"] = Utils::getJson($data['request']);
//            $logdata["response_data"] =Utils::getJson($data['response']);
//            $log->add($logdata);
//
//        } catch (\Exception $e) {
//            Log::write('订单CreateOrderLog失败' . $e->getMessage() . $e->getFile() . $e->getLine());
//        }
//    }
}
