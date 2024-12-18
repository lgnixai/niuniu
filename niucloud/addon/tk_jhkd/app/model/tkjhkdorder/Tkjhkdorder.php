<?php

namespace addon\tk_jhkd\app\model\tkjhkdorder;

use addon\tk_jhkd\app\model\order\OrderAdd;
use addon\tk_jhkd\app\service\core\CommonService;
use core\base\BaseModel;
use think\model\concern\SoftDelete;
use think\model\relation\HasMany;
use think\model\relation\HasOne;
use app\service\admin\dict\DictService;
use addon\tk_jhkd\app\dict\order\JhkdOrderDict;
use app\model\member\Member;

/**
 * 订单列模型
 * Class Tkjhkdorder
 * @package addon\tk_jhkd\app\model\tkjhkdorder
 */
class Tkjhkdorder extends BaseModel
{

    use SoftDelete;

    /**
     * 数据表主键
     * @var string
     */
    protected $pk = 'id';

    /**
     * 模型名称
     * @var string
     */
    protected $name = 'tkjhkd_order';

    /**
     * 定义软删除标记字段.
     * @var string
     */
    protected $deleteTime = 'delete_time';

    /**
     * 定义软删除字段的默认值.
     * @var int
     */
    protected $defaultSoftDelete = 0;
    protected $appends = ['is_send_name'];

    public function getOrderStatusArrAttr($value, $data)
    {
     if(isset($data['order_status'])){
         return JhkdOrderDict::getStatus($data['order_status']);
     }
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
            $query->where("order_id", $value);
        }
    }

    /**
     * 搜索器:订单列是否发单1已发单0未发单
     * @param $value
     * @param $data
     */
    public function searchIsSendAttr($query, $value, $data)
    {
        if ($value) {
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
        if ($value) {
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

    /**
     * 订单状态
     * @param $value
     * @param $data
     * @return mixed|string
     */
    public function getIsSendNameAttr($value, $data)
    {
        return (new CommonService())->getDictName('jhkd_is_send', $data['is_send']);
    }


    public function payInfo()
    {
        return $this->hasOne(\app\model\pay\Pay::class, 'trade_id', 'id');
    }

    public function memberInfo()
    {
        return $this->hasOne(\app\model\member\Member::class, 'member_id', 'member_id');
    }

    public function orderInfo()
    {
        return $this->hasOne(\addon\tk_jhkd\app\model\orderdelivery\OrderDelivery::class, 'order_id', 'order_id');
    }

    public function deliveryRealInfo()
    {
        return $this->hasOne(\addon\tk_jhkd\app\model\OrderDeliveryReal::class, 'order_id', 'order_id');
    }
    public function addorderInfo()
    {
        return $this->hasOne(OrderAdd::class, 'order_id', 'order_id');
    }
}