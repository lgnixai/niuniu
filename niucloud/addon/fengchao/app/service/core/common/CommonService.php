<?php

namespace addon\fengchao\app\service\core\common;

use addon\fengchao\app\model\order\OrderDelivery;
use addon\fengchao\app\model\order\OrderFee;
use core\base\BaseApiService;
use core\exception\CommonException;
use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;
use Exception;

use think\facade\Cache;
use think\facade\Db;
use think\facade\Log;

/**
 * 计算费用
 */
class CommonService extends BaseApiService
{
    public function __construct()
    {
        parent::__construct();

    }

    public function GetApiKeyByOrderId($order_id)
    {
        //$info = (new OrderDelivery())->where([['order_id', '=', $order_id]])->findOrEmpty()->toArray();
        $order = Db::name('fengchao_order_delivery')->alias('od')
            ->join(["fengchao_site_auth" => 'sa'], 'od.app_id = sa.api_key')
            ->where([['od.order_id', '=', $order_id]])
            ->field('sa.api_key,sa.api_secret,sa.callback_url')->findOrEmpty();


        $encryption_key = env("fengchao.encryption_key");
        $order['api_secret'] = Crypto::decrypt($order["api_secret"], Key::loadFromAsciiSafeString($encryption_key));

        return $order;

    }

//    public function GetApiKeyByApiKey($api_key)
//    {
//        //$info = (new OrderDelivery())->where([['order_id', '=', $order_id]])->findOrEmpty()->toArray();
//        $order = Db::name('fengchao_order_delivery')->alias('od')
//            ->join(["fengchao_site_auth" => 'sa'], 'od.app_id = sa.api_key')
//            ->where([['od.order_id', '=', $order_id]])
//            ->field('sa.api_key,sa.api_secret,sa.callback_url')->findOrEmpty();
//
//
//        $encryption_key = env("fengchao.encryption_key");
//        $order['api_secret'] = Crypto::decrypt($order["api_secret"], Key::loadFromAsciiSafeString($encryption_key));
//
//        return $order;
//
//    }


}