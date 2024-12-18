<?php


namespace addon\fengchao\app\api\controller\client;


use addon\fengchao\app\service\admin\site\BalanceService;
use addon\fengchao\app\service\admin\site\SiteAuthService;
use addon\fengchao\app\service\api\express\ExpressService;
use addon\fengchao\app\service\api\order\OrderCallBackLogService;
use addon\fengchao\app\service\api\order\OrderEventService;
use addon\fengchao\app\service\api\order\OrderPrice;
use addon\fengchao\app\service\core\CoreOrderService;
use app\dict\pay\PayDict;
use core\base\BaseApiController;
use core\exception\AuthException;
use think\facade\Log;
use think\Response;



class Client extends BaseApiController
{

    public function notify()
    {
       // echo "3333==============\n";
        $data = $this->request->params([
            ["RequestData",''],
            ["Data",''],
            ["DataSign",''],
            ["RequestType",''],
        ]);
        $res=[];
        $res["EBusinessID"] =333;;
        $res["Success"] = true;
        $res["Reason"] = "成功";
        $res["UpdateTime"] = date('Y-m-d H:i:s');

        echo json_encode($res);
        flush(); // 确保响应输出到客户端

        // 继续后台操作
        if (function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request();
        }


        Log::write('下游收到的信息222' . json_encode($data["RequestData"], JSON_UNESCAPED_UNICODE));

        Log::write('下游收到的信息333' . json_encode($data, JSON_UNESCAPED_UNICODE));



        $requestData=($data["RequestData"]);

        //$requestData=json_decode($res["RequestData"],true);
        $AppKey="7703e42a5240bb97ee3a9aedade177cbcfb14a8e1735bb0d6ee94711bc337487";


        $verifySignData=(new SiteAuthService())->encryptNoUrl(json_encode($requestData),$AppKey);

        Log::write($verifySignData  );
        Log::write($data["DataSign"] );
        Log::write(urldecode($data["DataSign"]) );
        if($data["DataSign"]!==urldecode($verifySignData)){
            throw new AuthException('回调数据签名错误');
        }
        Log::write('客户处理其它逻辑'  );

       // flush(); // 确保响应输出到客户端


    }


}
