<?php

namespace addon\fengchao\app\service\core;

use core\base\BaseApiService;
use core\exception\CommonException;
use think\Exception;
use function Symfony\Component\Translation\t;
use addon\fengchao\app\model\site\LinePrice;
/**
 *  快递鸟询价
 */
class LinePriceService extends BaseApiService
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new   LinePrice();
    }


    public function getLinePrice($data)
    {

        $sender_province=str_replace("省", "",$data["Sender"]["ProvinceName"]);
        $receive_province=str_replace("省", "",$data["Receiver"]["ProvinceName"]);
        $weight=$data["Weight"];

        $first_weight=1;
        $continuous_weight=abs($weight-1>0 ? $weight - 1 : 0);

        $order = 'create_time desc';
        $linePrice = $this->model
            ->where([ [ 'site_id', '=', $this->site_id ],
                [ 'sender_province', '=', $sender_province ],
                [ 'receive_province', '=', $receive_province ] ])
            ->order($order)->select()->toArray();


        $prices=[];
        foreach ($linePrice as $k => $v) {

            $t["weight"]=$weight;
            $t["shipperCode"]=$v["express_no"];
            $t["firstWeight"]=$first_weight;
            $t["firstWeightAmount"]=$v["first_weight"];
            $t["continuousWeight"]=$continuous_weight;
            $t["continuousWeightPrice"]=$v["continuous_weight"];
            $t["continuousWeightAmount"]= $continuous_weight*$v["continuous_weight"];
            $t["cost"]= sprintf("%.2f",$t["firstWeightAmount"]+$t["continuousWeightAmount"]);
            $t["isSubsectionContinuousWeightPrice"]=0;
            $t["totalFee"]=$t["cost"];
            //$t["delivery"]=$v["delivery"];
            array_push($prices,$t);
        }
        return $prices;

    }
    // 获取用户需要扣费的价格
    public function getOrderLinePrice($data)
    {

        $sender_province=str_replace("省", "",$data["Sender"]["ProvinceName"]);
        $receive_province=str_replace("省", "",$data["Receiver"]["ProvinceName"]);
        $shipper_code=$data["ShipperCode"];
        $weight=$data["Weight"];

        $first_weight=1;
        $continuous_weight=abs($weight-1>0 ? $weight - 1 : 0);

        $order = 'create_time desc';
        $linePrice = $this->model
            ->where([ [ 'site_id', '=', $this->site_id ],
                [ 'sender_province', '=', $sender_province ],
                [ 'receive_province', '=', $receive_province ] ,
                [ 'express_no', '=', $shipper_code ] ])
            ->order($order)->findOrEmpty()->toArray();


        if (empty($linePrice)) {
           // throw new CommonException('接口配置未完成，请先完成接口配置');
            throw new Exception('获取运单报价失败' );
        }

        $totalFee= sprintf("%.2f",$linePrice["first_weight"]+$continuous_weight*$linePrice["continuous_weight"]);


        return [
            'id'=>$linePrice["id"],
            'totalFee'=>$totalFee,
            'delivery_channel'=>$linePrice["delivery"]
       ];
    }



}
