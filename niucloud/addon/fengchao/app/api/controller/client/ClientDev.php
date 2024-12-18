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



class ClientDev extends BaseApiController
{

    public function notify()
    {

         $data = $this->request->params([

             ["body",''],
             ["url",''],
         ]);
         $res= json_decode($data['body'],true);
        echo "===============";
         $res_data=json_encode($res["RequestData"],true);


        //$requestData=json_decode($res["RequestData"],true);
        $AppKey="4bc13fbb74784de95d1aa85f8732587f6b253d17ce2249355c901afadba96c49";

        $verifySignData=(new SiteAuthService())->encryptNoUrl($res_data,$AppKey);

//        Log::write('下单失败'.$verifySignData . date('Y-m-d H:i:s'));
//        Log::write('下单失败'.$data["body"]["DataSign"]!==urldecode($verifySignData) . date('Y-m-d H:i:s'));
        echo "===============";
        var_dump($res["DataSign"]);
        var_dump(($verifySignData));
        exit;
        if($res["DataSign"]!==urldecode($verifySignData)){
            throw new AuthException('回调数据签名错误');
        }
        $res=[];
        $res["EBusinessID"] =333;;
        $res["Success"] = true;
        $res["Reason"] = "成功";
        $res["UpdateTime"] = date('Y-m-d H:i:s');

        Log::write('下游收到的信息' . json_encode($data, JSON_UNESCAPED_UNICODE));
        echo json_encode($res);
       // flush(); // 确保响应输出到客户端


    }


}
