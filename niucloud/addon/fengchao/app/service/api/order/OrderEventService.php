<?php

namespace addon\fengchao\app\service\api\order;
use addon\fengchao\app\job\order_event\OrderCreateAfter;
use addon\fengchao\app\model\order\Order;
use addon\fengchao\app\service\admin\site\OrderLogService;
use addon\fengchao\app\service\api\common\Utils;
use core\base\BaseApiService;
use think\facade\Log;

/**
 * 订单事件服务层
 */
class OrderEventService extends BaseApiService
{

    public function __construct()
    {
        parent::__construct();
        $this->model = new Order();
    }

    /**
     * 订单创建事件
     * @param $data
     * @return true
     */
    public static function orderCreate($data){
        event('orderCreate', $data);
        return true;
    }

    /**
     * 订单创建后事件
     * @param $data
     * @return true
     */
    public static function orderCreateAfter($data){
        OrderCreateAfter::dispatch(['data' => $data]);
        return true;
    }

    //接口请求日志
    public static function createOrderLog($data){
        //event('CreateOrderLog', $data);

        Log::write('订单日志' . json_encode($data));
        try {
            $log = new OrderLogService();
            $logdata = [];
            $logdata["site_id"] = $data['site_id'];
          //  $logdata["code"] = $data['code'];
            $logdata["request_type"] = $data['request_type'];
            $logdata["request_data"] = Utils::getJson($data['request']);
            $logdata["response_data"] =Utils::getJson($data['response']);
            $log->add($logdata);

        } catch (\Exception $e) {
            Log::write('添加订单日志失败' . $e->getMessage() . $e->getFile() . $e->getLine());
        }


        return true;
    }



}
