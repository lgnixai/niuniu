<?php

namespace addon\fengchao\app\listener\order\delivery;

use addon\fengchao\app\model\order\OrderFee;
use addon\fengchao\app\service\admin\site\SiteAccountService;
use addon\fengchao\app\service\core\CommonService;
use addon\fengchao\app\service\core\delivery\DeliveryLoader;
use Exception;

/**
 * 预下单事件
 */
class CalcPriceOrderListener
{
    /**
     * @Notes:多渠道预下单公共处理
     * handle
     * @param $data
     * 2024/12/12  08:59
     * author:TK
     */
    public function handle($params)
    {
        $drivers = (new CommonService())->getSiteDriver($params['site_id']);

        $data = $params['data'];
        $data['site_id'] = $params['site_id'];

        $shipper_code = $data['ShipperCode'];

        $pre_data = [];

        foreach ($drivers as $k => $v) {
            $pre = (new DeliveryLoader($v['type'], $v['params']))->preOrder($data);

            foreach ($pre as $k1 => $v1) {

                $price = $v1;
                $price["driver"] = $v['type'];
                $pre_data[] = $price;
            }
        }


        $priceList = array_filter($pre_data, function ($item) use ($shipper_code) {

            return $item['shipperCode'] === $shipper_code;
        });
        usort($priceList, function ($a, $b) {
            return $a['totalFee'] <=> $b['totalFee'];
        });
        // 获取价格最便宜的数据
        $cheapest = reset($priceList); // 使用 reset 获取第一个元素


        $res = [];
        if ($cheapest) {
            // 计算折扣

            switch ($cheapest['driver']) {
                case 'kdniao':

                    $res['platform'] = 'kdniao';

                    $res['totalFee'] = $cheapest["totalFee"];

                    break;
                case 'yunjie':
                    $res['platform'] = 'yunjie';
                    $res['totalFee'] = $cheapest["totalFee"];
                    break;
                default:

                    break;
            }
            $cheapest['result'] = $res;


            $ofdata = [];

            $ofdata['order_id'] = $data['order_id'];
            $ofdata['fee_type'] = $cheapest['price']['calcFeeType'];
            $ofdata['platform'] = $cheapest['driver'];
            $ofdata['site_id'] = $params['site_id'];
            $ofdata['official_fee'] = $cheapest['price']['cost'];
            $ofdata['discount'] = $cheapest['price']['discount'];
            $ofdata['total_fee'] = $cheapest['totalFee'];
            $ofdata['weight'] = $cheapest['weight'];

            $ofdata['first_weight'] = $cheapest['firstWeight'];
            $ofdata['first_weight_price'] = $cheapest['firstWeightPrice'];
            $ofdata['first_weight_amount'] = $cheapest['firstWeightAmount'];
            $ofdata['continuous_weight'] = $cheapest['continuousWeight'];
            $ofdata['continuous_weight_price'] = $cheapest['continuousWeightPrice'];
            $ofdata['continuous_weight_amount'] = $cheapest['continuousWeightAmount'];


            (new OrderFee())->create($ofdata);

        } else {

        }

        return $cheapest;

    }

}


