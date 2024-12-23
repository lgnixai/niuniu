<?php
declare ( strict_types = 1 );

namespace addon\fengchao\app\listener\order;

use addon\fengchao\app\service\admin\site\OrderLogService;
use addon\fengchao\app\service\api\common\Utils;
use addon\fengchao\app\service\core\order\OrderService;
use core\util\Snowflake;
use think\facade\Cache;
use think\facade\Log;

class CreateOrder
{

    public function create_no(string $prefix = '', string $tag = '')
    {

        $data_center_id = 1;
        $machine_id = 2;
        $snowflake = new Snowflake($data_center_id, $machine_id);
        $id = $snowflake->generateId();
        $no = $prefix . date('Ymd') . $tag . $id;
        $cacheKey = 'unique_no_' . $no;
        if (Cache::get($cacheKey)) {
            return create_no($prefix, $tag);
        } else {
            Cache::set($cacheKey, true, 60); // 设置过期时间为 60 秒
            return $no;
        }
    }
    public function handle( $params)
    {
        Log::write('生成订单' . json_encode($params));
        try {
            $order_id=$this->create_no();
            $order = new OrderService();
            $data = [
                "site_id" => $params['site_id'],
                'ip' => request()->ip() ?? '',
                "order_id" => $order_id,
                "order_code" => $params['order_code'],
            ];
            $order->add($data);
            return $order_id;
        } catch (\Exception $e) {
            Log::write('订单CreateOrderLog失败' . $e->getMessage() . $e->getFile() . $e->getLine());
        }
    }
}
