<?php

namespace addon\fengchao\app\listener\pay;


use addon\fengchao\app\service\admin\site\SiteService;
use addon\fengchao\app\service\core\FengChaoPayService;
use app\dict\pay\PayDict;

use app\service\core\notice\NoticeService;
use core\exception\CommonException;
use think\facade\Db;
use think\facade\Log;

/**
 * 支付单据创建事件
 */
class PayCreateListener
{
    public function handle(array $params)
    { try {
        Db::startTrans();
        //扣费
        if($params["trade_type"]==1){
            if (isset($params["money"]) && is_numeric($params["money"])) {
                // 将其转成负数
                $account_data = -abs(floatval($params["money"]));
            } else {
                // 处理非数字情况
                $account_data = 0; // 或者根据需求处理
            }
        }
        //退款
        if($params["trade_type"]==2){
            if (isset($params["money"]) && is_numeric($params["money"])) {
                // 将其转成负数
                $account_data = abs(floatval($params["money"]));
            } else {
                // 处理非数字情况
                $account_data = 0; // 或者根据需求处理
            }
        }

        if($params["trade_type"]==3){
            if (isset($params["money"]) && is_numeric($params["money"])) {
                $account_data=-$params['money'];
            } else {
                // 处理非数字情况
                $account_data = 0; // 或者根据需求处理
            }
        }



        $balance["site_id"]=$params["site_id"];
        $balance["account_data"]=$account_data;
        $balance["trade_type"]=$params["trade_type"];
        $balance["from_type"]="order";
        $balance["order_id"]=$params["order_id"];
        $balance["pay_id"]=$params["pay_id"];
        $balance["memo"]=$params['memo'];
        Log::write("下单---".json_encode($balance,true).'---'.date("Y-m-d H:i:s").'------');


        // 余额调整
        $res=( new SiteService() )->adjustBalance($balance);
        $pay=[
            "id"=>$params["pay_id"],
            "status"=>2,
        ];
        Log::write("余额调整---".json_encode($pay,true).'---'.date("Y-m-d H:i:s").'------');

        (new FengChaoPayService())->changeStatus($pay);

        Db::commit();

        return true;
    } catch (Exception $e) {
        Db::rollback();
        Log::write('支付回调失败' . date('Y-m-d H:i:s'));
        Log::write($e->getMessage());
        throw new CommonException($e->getMessage());
    }


    }
}