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


use core\base\BaseModel;

/**
 * 订单模型
 */
class OrderDelivery extends BaseModel
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
    protected $name = 'fengchao_order_delivery';

    //类型
    protected $type = [

    ];

    // 设置json类型字段
    protected $json = [
        'order_info' ,
        "picker_info",
        "pay_info",];

    // 设置JSON数据返回数组
    protected $jsonAssoc = true;


}
