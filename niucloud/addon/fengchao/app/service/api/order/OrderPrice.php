<?php

namespace addon\fengchao\app\service\api\order;

use addon\fengchao\app\model\order\Order;
use addon\fengchao\app\service\admin\site\PriceTemplateService;
use addon\fengchao\app\service\api\common\Utils;
use addon\fengchao\app\service\api\express\ExpressService;
use core\base\BaseApiService;
use function Symfony\Component\Translation\t;

/**
 *  快递鸟询价
 */
class OrderPrice extends BaseApiService
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new Order();
    }


    public function ask_price($data)
    {
        $request_data = Utils::getJson($data['request']);
        $site_id = $data["site_id"];

        $jsonInput = [
            "TransportType"=>1,
            "ShipperType" => 5, // 随机快递类型
            'Weight' => $request_data["Weight"],
            'Receiver' => [
                'ProvinceName' => $request_data["Sender"]["ProvinceName"],
                'CityName' => $request_data["Sender"]["CityName"],
                'ExpAreaName' => $request_data["Sender"]["ExpAreaName"],
            ],
            'Sender' => [
                'ProvinceName' => $request_data["Receiver"]["ProvinceName"],
                'CityName' => $request_data["Receiver"]["CityName"],
                'ExpAreaName' => $request_data["Receiver"]["ExpAreaName"],
            ]
        ];
        $temp_data = [];
        $temp_data["RequestType"] = "1815";
        $temp_data["RequestData"] = json_encode($jsonInput, JSON_UNESCAPED_UNICODE);
        //获取第三方报价
        $result = (new ExpressService())->Kdniao($temp_data);
        //获取当前快递公司
        $ShipperCode = $request_data["ShipperCode"];

        $price = (new PriceTemplateService())->setSiteFeePrice($site_id);
        $add_first_weight_price = 0;
        $add_continuous_weight_price = 0;

        foreach ($price["fee_data"] as $k => $v) {
            if ($v['express_no'] == $ShipperCode) {
                $add_first_weight_price = $v["sprice"];
                $add_continuous_weight_price = $v["xprice"];
            }
        }

        $res_data = ($result);




        //包含采购价和卖价
        $sell_price = [];
        foreach ($res_data["Data"] as $key => $val) {
           $v= ($val);

            if ($v["shipperCode"] == $ShipperCode) {
                $sell_price = $v;
                if ($price["fee_type"] == "percent") {
                    $sell_price["sellFirstWeightAmount"] = sprintf("%.2f", $v["firstWeightAmount"] *(1 + $add_first_weight_price / 100));
                    $sell_price["sellContinuousWeightPrice"] = sprintf("%.2f", $v["continuousWeightPrice"]*(1+$add_continuous_weight_price/100));
                } elseif ($price["fee_type"] == "weight") {
                    $sell_price["sellFirstWeightAmount"] = sprintf("%.2f", $v["firstWeightAmount"] + $add_first_weight_price);
                    $sell_price["sellContinuousWeightPrice"] = sprintf("%.2f", $v["continuousWeightPrice"] + $add_continuous_weight_price);
                }
            }
        }

        return $sell_price;


    }
    //获取加价之后的报价
    public function get_sell_price($data)
    {


        $price = (new PriceTemplateService())->setSiteFeePrice($this->request->siteId());
        $plusPrice = [];

        foreach ($price["fee_data"] as $k => $v) {
            $plusPrice[$v['express_no']]["sprice"] = $v["sprice"];
            $plusPrice[$v['express_no']]["xprice"] = $v["xprice"];
        }
        $price_data = [];
        $kdniao_result =  $data["response"];


        foreach ($kdniao_result["Data"] as $k => $v) {

            if (isset($plusPrice[$v["shipperCode"]])) {

                $temp = $v;
                $temp["weight"] = $v["weight"];
                $temp["shipperCode"] = $v["shipperCode"];
                $temp["firstWeight"] = $v["firstWeight"];
                $temp["continuousWeight"] = $v["continuousWeight"];

                if ($price["fee_type"] == "percent") {
                    $temp["firstWeightAmount"] = sprintf("%.2f", $v["firstWeightAmount"] * (1 + (($plusPrice[$v["shipperCode"]]["sprice"] ?? 0) / 100)));
                    $temp["continuousWeightPrice"] = sprintf("%.2f", $v["continuousWeightPrice"] * (1 + (($plusPrice[$v["shipperCode"]]["xprice"] ?? 0) / 100)));
                } elseif ($price["fee_type"] == "weight") {
                    $temp["firstWeightAmount"] = sprintf("%.2f", $v["firstWeightAmount"] + $plusPrice[$v["shipperCode"]]["sprice"] ?? 0);
                    $temp["continuousWeightPrice"] = sprintf("%.2f", $v["continuousWeightPrice"] + $plusPrice[$v["shipperCode"]]["xprice"] ?? 0);

                }

                $temp["continuousWeightAmount"] = sprintf("%.2f", $temp["continuousWeight"] * $temp["continuousWeightPrice"]);//$v["continuousWeightPrice"]+$plusPrice[$v["shipperCode"]]["xprice"];

                $temp["cost"] = sprintf("%.2f", $temp["firstWeightAmount"] + $temp["continuousWeightAmount"]);
                $temp["totalFee"] = sprintf("%.2f", $temp["cost"]);
                array_push($price_data, $temp);
            } else {
                array_push($price_data, $v);
            }
        }

            $kdniao_result["Data"] = $price_data;


            return $kdniao_result;



    }


}
