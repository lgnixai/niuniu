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


use addon\fengchao\app\model\order\FengChaoOrder;

use think\db\Query;

/**
 * 订单导出数据源查询
 * Class fengchaoOrderExportDataListener
 * @package addon\fengchao\app\listener\order_export
 */
class OrderExportDataListener
{

    public function handle($param)
    {
        $data = [];
        if ($param['type'] == 'fengchao_order') {
            $model = new FengChaoOrder();
            $order = 'id desc';
            $search_model=$model
                ->alias('o')
                ->join('fengchao_order_delivery od', 'o.order_id = od.order_id')
                ->where([ [ 'o.site_id', '=',  $param['site_id'] ] ])
                ->where('od.order_id|od.logistic_order_code|od.client_order_code', 'like', '%' . $param['where']['order_code'] . '%')
                ->withSearch(['create_time' ], $param['where'])
                ->field('o.*,od.*')->order($order);

//            //查询导出订单数据
//            $search_model = $model->withSearch(["create_time"], $param['where'])
//                ->with([
//
//                ])
//                ->where([['site_id', '=', $param['site_id']]])->field('*')->order($order);
            if ($param['page']['page'] > 0 && $param['page']['limit'] > 0) {
                $data = $search_model->page($param['page']['page'], $param['page']['limit'])->select()->toArray();
            } else {
                $data = $search_model->select()->toArray();
            }
            foreach ($data as $key => $val) {

                $data[$key]['order_id'] = !empty($val['order_id']) ? $val['order_id'] : '';
                $data[$key]['client_order_code'] = !empty($val['client_order_code']) ? $val['client_order_code'] : '';
               // logistic_order_code
                $data[$key]['logistic_order_code'] = !empty($val['logistic_order_code']) ? $val['logistic_order_code'] : '';
                $order_info = json_decode($val['order_info'], true);
                $data[$key]['receiver_province_name']=$order_info["Receiver"]["ProvinceName"];
                $data[$key]['receiver_name']=$order_info["Receiver"]["Name"];
                $data[$key]['send_province_name']=$order_info["Sender"]["ProvinceName"];
                $data[$key]['send_name']=$order_info["Sender"]["Name"];
                $data[$key]['weight'] = !empty($val['weight']) ? $val['weight'] : '';
                //total_fee
                $data[$key]['total_fee'] = !empty($val['total_fee']) ? $val['total_fee'] : '';
                $data[$key]['order_status_desc'] = !empty($val['order_status_desc']) ? $val['order_status_desc'] : '';



                $data[$key]['create_time'] = !empty($val['create_time']) ? $val['create_time'] : '';
            }
        }


        return $data;
    }
}