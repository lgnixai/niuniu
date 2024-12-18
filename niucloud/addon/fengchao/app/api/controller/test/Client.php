<?php


namespace addon\fengchao\app\api\controller\test;


use addon\fengchao\app\service\admin\site\BalanceService;
use addon\fengchao\app\service\api\express\ExpressService;
use addon\fengchao\app\service\api\order\OrderCallBackLogService;
use addon\fengchao\app\service\api\order\OrderEventService;
use addon\fengchao\app\service\api\order\OrderPrice;
use addon\fengchao\app\service\core\CoreOrderService;
use app\dict\pay\PayDict;
use core\base\BaseApiController;
use think\facade\Log;
use think\Response;



class Client extends BaseApiController
{

    public function notify()
    {

         $data = $this->request->params([
             ["RequestData",''],
             ["Data",''],
             ["DataSign",''],
             ["RequestType",''],
         ]);
        $res=[];
        $res["EBusinessID"] = env("fengchao.KDN_ID");;
        $res["Success"] = true;
        $res["Reason"] = "成功";
        $res["UpdateTime"] = date('Y-m-d H:i:s');

        Log::write('下游收到的信息' . json_encode($data, JSON_UNESCAPED_UNICODE));
        echo json_encode($res);
        flush(); // 确保响应输出到客户端


    }


}
