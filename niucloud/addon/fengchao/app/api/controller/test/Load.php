<?php


namespace addon\fengchao\app\api\controller\test;

 use addon\fengchao\app\api\controller\express\ExpressService;
 use addon\fengchao\app\api\controller\express\OrderEventService;
 use addon\fengchao\app\api\controller\express\OrderPrice;
 use addon\fengchao\app\model\order\Orderle;
 use addon\fengchao\app\service\api\marketing\pointexchange\OrderCreateService;
 use addon\fengchao\app\service\lark\Lark;
 use addon\fengchao\app\service\lark\LarkService;
 use app\service\api\sys\ConfigService;
 use core\base\BaseApiController;
 use core\dict\Config;
 use core\dict\DictLoader;
 use think\facade\Log;
use think\Response;


class Load extends BaseApiController
{

    //快递鸟接口
    public function  index()
    {
        $system = [
        //默认驱动
        'default' => 'wechatpay',
        //驱动
        'drivers' => [
            //微信
            'wechatpay' => [],
            //支付宝
            'alipay' => [],
            //余额
            'balancepay' => [
                'driver' => 'app\service\core\paytype\CoreBalanceService',  //反射类的名字
            ],
            'offlinepay' => [
                'driver' => 'app\service\core\paytype\CoreOfflineService'
            ]
        ]
    ];

        $a=(new DictLoader("Config"))->load(['data' => $system, 'name' => 'pay']);


       $b= \think\facade\Config::get("pay");

       echo json_encode($b);
    }


}
