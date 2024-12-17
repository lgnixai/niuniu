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
class BalanceExportTypeListener
{

    public function handle()
    {
        return [
            'fengchao_site_balance_log' => [
                'name' => '费用流水',
                'column' => [
                    'from_type' => [ 'name' => '类型'],
                    'account_data' => [ 'name' => '金额'],
                    'account_sum' => [ 'name' => '余额'],

                    'memo' => [ 'name' => '备注'],
                    'create_time' => [ 'name' => '时间'],

                ],
            ]
        ];
    }
}