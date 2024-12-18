<?php
// +----------------------------------------------------------------------
// | Niucloud-admin 企业快速开发的saas管理平台
// +----------------------------------------------------------------------
// | 官方网址：https://www.niucloud.com
// +----------------------------------------------------------------------
// | niucloud团队 版权所有 开源版本可自由商用
// +----------------------------------------------------------------------
// | Author: Niucloud Team
// +----------------------------------------------------------------------

namespace addon\fengchao\app\listener\export;

/**
 * 发票导出数据类型查询
 * Class MemberExportTypeListener
 * @package app\listener\member
 */
class OrderExportTypeListener
{

    public function handle()
    {


        return [
            'fengchao_order' => [
                'name' => '订单导出',
                'column' => [
                    'order_id' => ['name' => '平台订单号'],
                    'client_order_code' => ['name' => '客户订单号'],
                    'logistic_order_code' => ['name' => '物流订单号'],
                    'send_province_name' => ['name' => '发货人省份'],
                    'send_name' => ['name' => '发货人'],
                    'receiver_province_name' => ['name' => '收件省份'],
                    'receiver_name' => ['name' => '收件人'],
                    'weight' => ['name' => '重量'],
                    'total_fee' => ['name' => '费用'],
                    'order_status_desc' => ['name' => '订单状态'],
                    'create_time' => ['name' => '时间'],

                ],
            ]
        ];
    }
}