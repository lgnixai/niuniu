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
                    'order_code' => [ 'name' => '订单号'],
                    'Weight' => [ 'name' => '重量'],
                    'Cost'=> [ 'name' => '基础运费'],
                    'InsureAmount'=> [ 'name' => '保价费'],
                    'PackageFee'=> [ 'name' => '包装费'],
                    'OverFee'=> [ 'name' => '超长超重费'],
                    'OtherFee'=> [ 'name' => '其它'],
                    'TotalFee' => [ 'name' => '总费用'],
                    'Status' => [ 'name' => '状态'],
                    'create_time' => [ 'name' => '时间'],

                ],
            ]
        ];
    }
}