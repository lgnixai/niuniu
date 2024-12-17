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

namespace addon\fengchao\app\model\order;

use addon\fengchao\app\dict\order\OrderDeliveryDict;
use addon\fengchao\app\dict\order\OrderDict;
use addon\fengchao\app\model\delivery\Store;
use addon\fengchao\app\model\order\Invoice;
use addon\fengchao\app\model\order\OrderDelivery;
use addon\fengchao\app\model\order\OrderDiscounts;
use addon\fengchao\app\model\order\OrderGoods;
use app\dict\common\ChannelDict;
use app\model\member\Member;
use app\model\pay\Pay;
use core\base\BaseModel;
use think\db\Query;
use think\model\relation\HasMany;
use think\model\relation\HasOne;

/**
 * 订单模型
 */
class OrderCallBackLog extends BaseModel
{

    /**
     * 数据表主键
     * @var string
     */
    protected $pk = 'id';

    /**
     * 模型名称
     * @var string
     */
    protected $name = 'fengchao_order_callback_log';

    //类型
    protected $type = [

    ];
     // 设置json类型字段
    protected $json = [ 'server_data'];

    // 设置JSON数据返回数组
    protected $jsonAssoc = true;


}
