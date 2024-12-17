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
use addon\fengchao\app\model\order\Order;
use addon\fengchao\app\model\order\OrderGoods;
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

                $data[$key]['order_code'] = !empty($val['order_code']) ? $val['order_code'] : '';
                $user_price=$val["user_price"];



                $data[$key]['Weight'] = ($user_price["weight"])??"" ;
                $data[$key]['Cost'] = ($user_price["Cost"])??"";
                $data[$key]['InsureAmount'] = ($user_price["InsureAmount"])??"";
                $data[$key]['PackageFee'] = ($user_price["PackageFee"])??"";
                $data[$key]['OverFee'] = ($user_price["OverFee"])??"";
                $data[$key]['OtherFee'] = ($user_price["OtherFee"])??"";
                $data[$key]['TotalFee'] =( $user_price["TotalFee"])??"";


                $data[$key]['Status'] = $val["status"];

                $data[$key]['create_time'] = !empty($val['create_time']) ? $val['create_time'] : '';
            }
        }


        return $data;
    }
}