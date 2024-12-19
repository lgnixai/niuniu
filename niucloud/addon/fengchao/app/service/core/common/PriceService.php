<?php

namespace addon\fengchao\app\service\core\common;

use addon\fengchao\app\model\order\OrderFee;
use core\base\BaseApiService;
use core\exception\CommonException;
use Exception;

use think\facade\Cache;
use think\facade\Db;
use think\facade\Log;

/**
 * 计算费用
 */
class PriceService extends BaseApiService
{
    public function __construct()
    {
        parent::__construct();
        $this->model=new OrderFee();
    }

    public function PriceAndRule($params)
    {

        $defaultParams = [
            'Weight' => 0,
            'FirstWeightAmount' => 0,
            'ContinuousWeightAmount' => 0,
            'Cost' => 0,
            'InsureAmount' => 0,
            'PackageFee' => 0,
            'OverFee' => 0,
            'OtherFee' => 0,
            'OtherFeeDetail' => null,
            'TotalFee' => 0,
            'Volume' => 0,
            'VolumeWeight' => 0,
        ];

        // 合并参数
        $params = array_merge($defaultParams, $params);

        try {
            Db::startTrans();
            $data = [
                'order_id'=>$params['order_id'],
                'order_type'=>1,
                'weight' => $params['Weight'],
                'first_weight_amount' => $params['FirstWeightAmount'],
                'continuous_weight_amount' => $params['ContinuousWeightAmount'],
                'cost' => $params['Cost'],
                'insure_amount' => $params['InsureAmount'],
                'package_fee' => $params['PackageFee'],
                'over_fee' => $params['OverFee'],
                'other_fee' => $params['OtherFee'],
                'other_fee_detail' => $params['OtherFeeDetail'],
                'total_fee' => $params['TotalFee'],
                'volume' => $params['Volume'],
                'volume_weight' => $params['VolumeWeight'],
            ];

            $re=$this->model->create($data);

            Log::write('添加原始费用' .$re. date('Y-m-d H:i:s'));
            $line_price=(new OrderDeliveryService())->getLinePriceByOrderId($params['order_id']);

            $weight=$params["Weight"];

            $first_weight=1; //首重
            $continuous_weight=abs($weight-1>0 ? $weight - 1 : 0);//续重

            //首重价格
            $first_price=$line_price['first_weight'];
            //续重价格
            $continuous_price=$line_price['continuous_weight'];

            // 续重*续重卖价
            $continuous_amount=sprintf("%.2f",$continuous_price*$continuous_price);

            $firstWeightAmount=$first_price;

            $cost=sprintf("%.2f",$firstWeightAmount+$continuous_amount);

            $TotalFee=sprintf("%.2f",$cost+$params["InsureAmount"]+$params["PackageFee"]+$params["OverFee"]+$params["OtherFee"]);

            $data = [
                'order_id'=>$params['order_id'],
                'order_type'=>2,
                'weight' => $params['Weight'],
                'first_weight_amount' => $firstWeightAmount,
                'continuous_weight_amount' => $continuous_amount,
                'cost' => $cost,
                'insure_amount' => $params['InsureAmount'],
                'package_fee' => $params['PackageFee'],
                'over_fee' => $params['OverFee'],
                'other_fee' => $params['OtherFee'],
                'other_fee_detail' => $params['OtherFeeDetail'],
                'total_fee' => $TotalFee,
                'volume' => $params['Volume'],
                'volume_weight' => $params['VolumeWeight'],
            ];
            $re=$this->model->create($data);

            Log::write('添加平台费用' .$re. date('Y-m-d H:i:s'));

            Db::commit();
            return $TotalFee;
        } catch (Exception $e) {
            Db::rollback();
            Log::write('下单失败' . date('Y-m-d H:i:s'));
            Log::write($e->getMessage());
            throw new CommonException($e->getMessage());
        }


    }


}