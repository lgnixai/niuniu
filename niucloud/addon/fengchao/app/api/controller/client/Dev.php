<?php


namespace addon\fengchao\app\api\controller\client;

 use addon\fengchao\app\api\controller\express\ExpressService;
 use addon\fengchao\app\api\controller\express\OrderEventService;
 use addon\fengchao\app\api\controller\express\OrderPrice;
 use addon\fengchao\app\model\order\Orderle;
 use addon\fengchao\app\service\api\marketing\pointexchange\OrderCreateService;
 use addon\fengchao\app\service\lark\Lark;
 use addon\fengchao\app\service\lark\LarkService;
 use app\service\api\sys\ConfigService;
 use core\base\BaseApiController;
use think\facade\Log;
use think\Response;


class Dev extends BaseApiController
{

    //快递鸟接口
    public function  domain()
    {



        try {
            $lark = new LarkService();
            $notify=$lark->useBotChat();
            $notify->sendInfoNotification("info","ok",["a"=>1]);


            return  33;
        } catch (\Exception $e) {
            return json(['error' => $e->getMessage()]);
        }


         return success($msg = 'SUCCESS', json_encode($result));

    }


}
