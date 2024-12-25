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
        $site=(new SiteAccountService())->getInfo($params['site_id']);
        $discount=$site['yunjie_discount'];
        $data=$params['data'];
        $shipper_code = $data['ShipperCode'];

        $pre_data = [];

        foreach ($drivers as $k => $v) {
            $pre = (new DeliveryLoader($v['type'], $v['params']))->preOrder($data);

            foreach ($pre as $k1 => $v1) {

                $price=$v1;
                $price["driver"]=$v['type'];
                $pre_data[] = $price;
            }
        }



        $priceList = array_filter($pre_data, function ($item)use($shipper_code) {

            return $item['shipperCode'] === $shipper_code;
        });
        usort($priceList, function ($a, $b) {
                return $a['totalFee'] <=> $b['totalFee'];
        });
        // 获取价格最便宜的数据
        $cheapest = reset($priceList); // 使用 reset 获取第一个元素


        $res=[];
        if ($cheapest) {
            // 计算折扣

            switch ($cheapest['driver']){
                case 'kdniao':

                    $res['platform']='kdniao';

                    $res['totalFee']=$cheapest["cost"];

                    break;
                case 'yunjie':
                    $res['platform']='yunjie';
                    $res['totalFee']=$cheapest["cost"]*$discount/10;
                    break;
                default:

                    break;
            }
            $cheapest['result']=$res;


            $ofdata=[];

            $ofdata['order_id']=$data['order_id'];
            $ofdata['fee_type']=$cheapest['price']['calcFeeType'];
            $ofdata['platform']=$cheapest['driver'];
            $ofdata['site_id']=$params['site_id'];
            $ofdata['official_price']=$cheapest['price']['cost'];
            $ofdata['discount']=$cheapest['price']['discount'];
            $ofdata['total_fee']=$cheapest['totalFee'];
            $ofdata['weight']=$cheapest['weight'];

            $ofdata['first_weight']=$cheapest['firstWeight'];
            $ofdata['first_weight_price']=$cheapest['firstWeightPrice'];
            $ofdata['first_weight_amount']=$cheapest['firstWeightAmount'];
            $ofdata['continuous_weight']=$cheapest['continuousWeight'];
            $ofdata['continuous_weight_price']=$cheapest['continuousWeightPrice'];
            $ofdata['continuous_weight_amount']=$cheapest['continuousWeightAmount'];


            (new OrderFee())->create($ofdata);

        }else{

        }

        return $cheapest;


    }

//    /**
//     * @Notes:计算展示价格
//     * newPriceAndRule
//     * @param $data
//     * @param $weight
//     * 2024/12/12  08:45
//     * author:TK
//     */
//    public function newPriceAndRule($data, $weight, $site_id)
//    {
//        $this->config = (new CommonService())->getConfig($site_id);
//        $price = $data['preOrderFee'];
//        // 易达通票计算价格
//        if ($data['calcFeeType'] == 'profit') {
//            if (is_array($data['price'])) {
//                $pricerules = $data['price'];
//            } else {
//                $pricerules = json_decode($data['price'], true);
//            }
//            if (is_array($data['originalPrice'])) {
//                $original_price = $data['originalPrice'];
//            } else {
//                $original_price = json_decode($data['originalPrice'], true);
//            }
//            $selectedRule = null;
//            $index = 0;
//            // 遍历所有规则，找到适用于当前重量的规则
//            foreach ($pricerules as $k => $rule) {
//                if ($weight >= $rule['start'] && ($weight <= $rule['end'] || $rule['end'] == 0)) {
//                    $selectedRule = $rule;
//                    $index = $k;
//                    break;
//                }
//            }
//            if (!$selectedRule) {
//                $firstRule = reset($pricerules);
//                if ($weight < $firstRule['start']) {
//                    $selectedRule = $firstRule;
//                    $index = key($pricerules);
//                }
//            }
//            if ($this->config['floatWay'] == 'floatWayFixed') {
//                $selectedRule['first'] += $this->config['floatAmount'];
//                if ($selectedRule['add'] > 0) {
//                    $selectedRule['add'] += $this->config['floatAmount'];
//                } else {
//                    $selectedRule['add'] = 3;
//                }
//
//            }
//            if ($this->config['floatWay'] == 'floatWayRate') {
//                $selectedRule['first'] = $selectedRule['first'] * (1 + $this->config['floatRate'] / 100);
//                if ($selectedRule['add'] > 0) {
//                    $selectedRule['add'] = $selectedRule['add'] * (1 + $this->config['floatRate'] / 100);
//                } else {
//                    $selectedRule['add'] = 3;
//                }
//            }
//            if ($this->config['floatWay'] == 'floatWayBetwn') {
//                $selectedRule['first'] = $selectedRule['first'] + $this->config['firstAmount'];
//                if ($selectedRule['add'] > 0) {
//                    $selectedRule['add'] = $selectedRule['add'] + $this->config['secondAmount'];
//                } else {
//                    $selectedRule['add'] = 3;
//                }
//
//            }
//            $selectedRule['perAdd'] = 0;   // 单笔加收
//            $selectedRule['discount'] = 1;    // 折扣
//
//        } else {
//            if (is_array($data['price'])) {
//                $pricerules = $data['price'];
//            } else {
//                $pricerules = json_decode($data['price'], true);
//            }
//            if (is_array($data['originalPrice'])) {
//                $original_price = $data['originalPrice'];
//            } else {
//                $original_price = json_decode($data['originalPrice'], true);
//            }
//            $selectedRule = null;
//            $index = 0;
//            // 遍历所有规则，找到适用于当前重量的规则
//            foreach ($original_price as $k => $rule) {
//                if ($weight >= $rule['start'] && ($weight <= $rule['end'] || $rule['end'] == 0)) {
//                    $selectedRule = $rule;
//                    $index = $k;
//                    break;
//                }
//            }
//            if (!$selectedRule) {
//                $firstRule = reset($original_price);
//                if ($weight < $firstRule['start']) {
//                    $selectedRule = $firstRule;
//                    $index = key($original_price);
//                }
//            }
//            if ($this->config['floatWay'] == 'floatWayFixed') {
//                $selectedRule['first'] = $selectedRule['first'] * $pricerules['discount'] + $pricerules['perAdd'] + $this->config['floatAmount'];
//                $selectedRule['add'] = $selectedRule['add'] * $pricerules['discount'] + $this->config['floatAmount'];
//            }
//            if ($this->config['floatWay'] == 'floatWayRate') {
//                $selectedRule['first'] = ($selectedRule['first'] * $pricerules['discount'] + $pricerules['perAdd']) * (1 + $this->config['floatRate'] / 100);
//                $selectedRule['add'] = $selectedRule['add'] * $pricerules['discount'] * (1 + $this->config['floatRate'] / 100);
//            }
//            if ($this->config['floatWay'] == 'floatWayBetwn') {
//                $selectedRule['first'] = $selectedRule['first'] * $pricerules['discount'] + $pricerules['perAdd'] + $this->config['firstAmount'];
//                $selectedRule['add'] = $selectedRule['add'] * $pricerules['discount'] + $this->config['secondAmount'];
//            }
//            $selectedRule['perAdd'] = $pricerules['perAdd'];   // 单笔加收
//            $selectedRule['discount'] = $pricerules['discount'];    // 折扣
//        }
//        $selectedRule['first'] = round($selectedRule['first'], 2);
//        $selectedRule['add'] = round($selectedRule['add'], 2);
//        $weight_num = $weight - $selectedRule['start'];
//        if ($weight_num < 0) {
//            $weight_num = 0;
//        }
//        $price = $selectedRule['first'] + $weight_num * $selectedRule['add'];
//        $price = round($price, 2);
//        return ['price' => $price, 'price_rule' => $selectedRule, 'original_rule' => $original_price[$index]];
//    }

}


