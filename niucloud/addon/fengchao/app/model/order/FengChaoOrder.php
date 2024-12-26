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


use addon\fengchao\app\model\OrderDeliveryReal;
use addon\fengchao\app\service\core\CommonService;
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
class FengChaoOrder extends BaseModel
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
    protected $name = 'fengchao_order';

    //类型
    protected $type = [

    ];

    // 设置json类型字段
    protected $json = [

    ];

    // 设置JSON数据返回数组
    protected $jsonAssoc = true;

    public function getOrderStatusArrAttr($value, $data)
    {
        return OrderDict::getStatus($data['order_status']);
    }

    /**
     * 搜索器:订单列会员id
     * @param $value
     * @param $data
     */
    public function searchMemberIdAttr($query, $value, $data)
    {
        if ($value) {
            $query->where("member_id", $value);
        }
    }

    /**
     * 搜索器:订单列订单来源
     * @param $value
     * @param $data
     */
    public function searchOrderFromAttr($query, $value, $data)
    {
        if ($value) {
            $query->where("order_from", $value);
        }
    }

    /**
     * 搜索器:订单列订单id
     * @param $value
     * @param $data
     */
    public function searchOrderIdAttr($query, $value, $data)
    {
        if ($value) {
            $query->where("order_id", "like", "%".$value."%");
        }
    }
    public function searchOutTradeNoAttr($query, $value, $data)
    {
        if ($value) {
            $query->where("out_trade_no", "like", "%".$value."%");
        }
    }
    /**
     * 搜索器:订单列是否发单1已发单0未发单
     * @param $value
     * @param $data
     */
    public function searchIsSendAttr($query, $value, $data)
    {
        if ($value != '') {
            $query->where("is_send", $value);
        }
    }

    /**
     * 搜索器:订单列订单状态
     * @param $value
     * @param $data
     */
    public function searchOrderStatusAttr($query, $value, $data)
    {
        if ($value != '') {
            $query->where("order_status", $value);
        }
    }

    /**
     * 搜索器:订单列退款状态
     * @param $value
     * @param $data
     */
    public function searchRefundStatusAttr($query, $value, $data)
    {
        if ($value != '') {
            $query->where("refund_status", $value);
        }
    }

    /**
     * 搜索器:订单列订单备注
     * @param $value
     * @param $data
     */
    public function searchRemarkAttr($query, $value, $data)
    {
        if ($value) {
            $query->where("remark", $value);
        }
    }

    /**
     * 搜索器:订单列创建时间
     * @param $value
     * @param $data
     */
    public function searchCreateTimeAttr($query, $value, $data)
    {
        $start = empty($value[0]) ? 0 : strtotime($value[0]);
        $end = empty($value[1]) ? 0 : strtotime($value[1]);
        if ($start > 0 && $end > 0) {
            $query->where([["create_time", "between", [$start, $end]]]);
        } else if ($start > 0 && $end == 0) {
            $query->where([["create_time", ">=", $start]]);
        } else if ($start == 0 && $end > 0) {
            $query->where([["create_time", "<=", $end]]);
        }
    }

    public function member()
    {
        return $this->hasOne(Member::class, 'member_id', 'member_id')->joinType('left')->withField('nickname,member_id')->bind(['member_id_name' => 'nickname']);
    }

    public function getIsSendNameAttr($value, $data)
    {
        return (new CommonService())->getDictName('jhkd_is_send', $data['is_send']);
    }

    public function deliveryRealInfo()
    {
        return $this->hasOne(OrderDeliveryReal::class, 'order_id', 'order_id');
    }
    public function orderFee()
    {
        return $this->hasOne(OrderFee::class, 'order_id', 'order_id');
    }
    public function payInfo()
    {
        return $this->hasOne(Pay::class, 'trade_id', 'id');
    }

    public function memberInfo()
    {
        return $this->hasOne(Member::class, 'member_id', 'member_id');
    }

    public function orderInfo()
    {
        return $this->hasOne( OrderDelivery::class, 'order_id', 'order_id');
    }
    public function addorderInfo()
    {
        return $this->hasOne(OrderAdd::class, 'order_id', 'order_id');
    }
}
