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

namespace addon\fengchao\app\validate\express;

use core\base\BaseValidate;

/**
 * 验证器
 * Class Company
 * @package addon\fengchao\app\validate\delivery
 */
class Kdn extends BaseValidate
{

    protected $rule = [
        'TransportType'          => 'require|in:1', // 假设 TransportType 有几个固定的枚举值
        'ShipperType'            => 'require|in:5', // 同上
        'OrderCode'              => 'require|max:50', // 订单编号，限制长度
        'ExpType'                => 'require|in:1', // 快递类型，假设有固定枚举值
        'PayType'                => 'require|in:3', // 支付方式
        'Receiver'               => 'require|array',
        'Receiver.ProvinceName'  => 'require',
        'Receiver.CityName'      => 'require',
        'Receiver.ExpAreaName'   => 'require',
        'Receiver.Address'       => 'require',
        'Receiver.Name'          => 'require',

        'Sender'                 => 'require|array',
        'Sender.ProvinceName'    => 'require',
        'Sender.CityName'        => 'require',
        'Sender.ExpAreaName'     => 'require',
        'Sender.Address'         => 'require',
        'Sender.Name'            => 'require',

        'Weight'                 => 'require|float|gt:0',
        'Quantity' => 'require|equal:1', // 添加对 Quantity 字段的等于1的验证
        //        'Remark'                 => 'max:200',
        'Commodity'              => 'require|array|min:1',
        'Commodity.*.GoodsName'    => 'require|max:100',
        'Commodity.*.GoodsQuantity'=> 'require|integer|gt:0',
        'Commodity.*.GoodsPrice'   => 'require|float|egt:0',


    ];

    protected $message = [
        'TransportType.require'        => 'validate_api.transport_type_require',
        'TransportType.in'             => 'validate_api.transport_type_invalid',
        'ShipperType.require'          => 'validate_api.shipper_type_require',
        'ShipperType.in'               => 'validate_api.shipper_type_invalid',
        'ShipperCode.requireIf'        => 'validate_api.shipper_code_require',
        'OrderCode.require'            => 'validate_api.order_code_require',
        'OrderCode.max'                => 'validate_api.order_code_max',
        'ExpType.require'              => 'validate_api.exp_type_require',
        'ExpType.in'                   => 'validate_api.exp_type_invalid',
        'PayType.require'              => 'validate_api.pay_type_require',
        'PayType.in'                   => 'validate_api.pay_type_invalid',

        'Receiver.require'             => 'validate_api.receiver_require',
        'Receiver.ProvinceName.require'=> 'validate_api.receiver_province_require',
        'Receiver.CityName.require'    => 'validate_api.receiver_city_require',
        'Receiver.ExpAreaName.require' => 'validate_api.receiver_area_require',
        'Receiver.Address.require'     => 'validate_api.receiver_address_require',
        'Receiver.Name.require'        => 'validate_api.receiver_name_require',



        'Sender.require'               => 'validate_api.sender_require',
        'Sender.ProvinceName.require'  => 'validate_api.sender_province_require',
        'Sender.CityName.require'      => 'validate_api.sender_city_require',
        'Sender.ExpAreaName.require'   => 'validate_api.sender_area_require',
        'Sender.Address.require'       => 'validate_api.sender_address_require',
        'Sender.Name.require'          => 'validate_api.sender_name_require',



        'Weight.require'               => 'validate_api.weight_require',
        'Weight.float'                 => 'validate_api.weight_invalid',
        'Weight.gt'                    => 'validate_api.weight_gt_zero',


        'Quantity.require' => 'validate_api.quantity_require',
        'Quantity.equal' => 'validate_api.quantity_equal', // 添加数量等于1的错误提示

        'Commodity.require'            => 'validate_api.commodity_require',
        'Commodity.array'              => 'validate_api.commodity_invalid',
        'Commodity.*.GoodsQuantity.require' => 'validate_api.commodity_goods_quantity_require',
        'Commodity.*.GoodsName.require'    => 'validate_api.commodity_goods_name_require',
        'Commodity.*.GoodsPrice.require'      => 'validate_api.commodity_goods_price_require',

    ];

    protected $scene = [
        "1801" => [
                "TransportType",
                "ShipperType",
                "OrderCode",
                "ExpType",
                "PayType",
                "Receiver",
                "Receiver.ProvinceName",
                "Sender",
                "Sender.ProvinceName",
                "Weight",
                "Quantity",

            ],
        "1802" => [
                "OrderCode",
            ],
        "1807" => [
            "Mobile",
            "Name",
            "ComplaintType",
            "OrderCode",
            "ComplaintContent",
            "Source",
        ],
        "1815"=> [
            "TransportType",
            "ShipperType",
            "Receiver",
            "Receiver.ProvinceName",
            "Receiver.CityName",
            "Sender",
            "Sender.ProvinceName",
            "Sender.CityName",
            "Weight",
        ],
    ];



}
