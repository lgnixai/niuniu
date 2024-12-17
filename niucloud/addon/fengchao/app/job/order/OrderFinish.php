<?php
// +----------------------------------------------------------------------
// | Niucloud-admin 企业快速开发的多应用管理平台
// +----------------------------------------------------------------------
// | 官方网址：https://www.niucloud.com
// +----------------------------------------------------------------------
// | niucloud团队 版权所有 开源版本可自由商用
// +----------------------------------------------------------------------
// | Author: Niucloud Team
// +----------------------------------------------------------------------
namespace addon\fengchao\app\job\order;

use addon\fengchao\app\dict\order\OrderDict;
use addon\fengchao\app\dict\order\OrderLogDict;
use addon\fengchao\app\model\order\Order;
use addon\fengchao\app\service\core\order\CoreOrderFinishService;
use core\base\BaseJob;

/**
 * 订单自动收货完成
 */
class OrderFinish extends BaseJob
{
    /**
     * 消费
     * @return true
     */
    public function doJob()
    {
        try {
            $data = [];
            $data['main_type'] = OrderLogDict::SYSTEM;
            $data['main_id'] = 0;
            $list = (new Order())->where([
                ['status', '=', OrderDict::WAIT_TAKE],
                ['timeout', '<=', time()],
                ['timeout', '>', 0]
            ])->select();
            if(!$list->isEmpty()){
                foreach($list as $v){
                    $data['order_id'] = $v['order_id'];
                    $data['site_id'] = $v['site_id'];
                    (new CoreOrderFinishService())->finish($data);
                }
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

}