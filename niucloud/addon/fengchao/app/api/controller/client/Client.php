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
use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;
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
        //$AppKey="330aa1fd76054c6c87a5672e6b9db88bbbc4454ba092edf4710518544df97c32";

       // $verifySignData=(new SiteAuthService())->encrypt($requestData,$AppKey);
        $auth=(new SiteAuthService())->getByAppKey($requestData["EBusinessID"]);
        if(empty($auth)){
            throw new AuthException('EBusinessID不存在');
        }

        $encryption_key = env("fengchao.encryption_key");

        $api_secret = Crypto::decrypt($auth['api_secret'], Key::loadFromAsciiSafeString($encryption_key));


        $verifySignData=(new SiteAuthService())->encryptNoUrl(json_encode($requestData),$api_secret);

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
