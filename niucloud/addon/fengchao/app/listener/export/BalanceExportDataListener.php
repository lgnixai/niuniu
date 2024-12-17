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

use addon\fengchao\app\dict\order\InvoiceDict;
use addon\fengchao\app\model\order\Order;
use addon\fengchao\app\model\order\OrderGoods;
use addon\fengchao\app\model\site\SiteBalanceLog;
use think\db\Query;

/**
 * 订单导出数据源查询
 * Class fengchaoOrderExportDataListener
 * @package addon\fengchao\app\listener\order_export
 */
class BalanceExportDataListener
{

    public function handle($param)
    {
        $data = [];
        if ($param['type'] == 'fengchao_site_balance_log') {
            $model = new SiteBalanceLog();
            $order = 'id asc';

            //查询导出订单数据
            $search_model = $model->withSearch(["create_time"], $param['where'])
                ->with([

                ])
                ->where([['site_id', '=', $param['site_id']]])->field('*')->order($order);
            if ($param['page']['page'] > 0 && $param['page']['limit'] > 0) {
                $data = $search_model->page($param['page']['page'], $param['page']['limit'])->select()->toArray();
            } else {
                $data = $search_model->select()->toArray();
            }


            foreach ($data as $key => $val) {

                $data[$key]['account_data'] = !empty($val['account_data']) ? $val['account_data'] : '';
                $data[$key]['account_sum'] = !empty($val['account_sum']) ? $val['account_sum'] : '';
                $from_type="余额调整";
                if($val['from_type']=="order"){
                    $from_type="订单付款";
                }
                $data[$key]['from_type'] =$from_type;
                $data[$key]['memo'] = !empty($val['memo']) ? $val['memo'] : '';
                $data[$key]['create_time'] = !empty($val['create_time']) ? $val['create_time'] : '';
            }
        }

        return $data;
    }
}