<?php


namespace addon\fengchao\app\api\controller\express;

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


class Alimq extends BaseApiController
{

    //快递鸟接口
    public function  order()
    {

        $data = $this->request->params([
            ["api_name", ""],
            ["api_id", ""],
            ["api_key", ""],
            ["request_data", ""],
            ["api_secret", ""],
            ["api_secret", ""],
            ["RequestData", ""],
            ["RequestType", ""],
            ["EBusinessID", ""],
            ["ApiKey", ""],
            ["callback_url", ""],
        ]);


        $requestData = $data['RequestData'];

        $datas = array(

            'RequestType' => $data['RequestType'],
            'RequestData' => ($requestData),
            'SiteId'=>$this->request->siteId(),
        );
        $event_data=[];
        $event_data["request"]=$requestData;
        $event_data["request_type"]=$data['RequestType'];
        $event_data["site_id"]=$this->request->siteId();

        $res_data=json_decode($requestData,true);
        $result=[];
        switch ($data['RequestType']){
            case "1801":


                $res=(new CoreOrderService())->checkBalance($res_data);
                if($res){
                    $result = (new ExpressService())->Kdniao($datas);
                    if($result["Success"]){
                        $res_data["result"]= $result["Order"];
                        $res=(new CoreOrderService())->createOrder($res_data);
                        event('AfterOrderCreate', ($result));
                    }
                    $event_data["response"]=$result;
                    Log::write('快递鸟下单接口' . json_encode($result));
                }
                break;
            case "1815":
                $res=(new CoreOrderService())->preOrder($res_data);
                $result=[];
                $result["Data"]=$res;
                $result["ResultCode"]="100";
                $result["Reason"]="查询成功！";
                break;
            default:
                $result = (new ExpressService())->Kdniao($datas);
                $event_data["response"]=$result;
                Log::write('快递鸟其它接口('.$data['RequestType'].')' . json_encode($result));

        }

        //添加日志
        OrderEventService::createOrderLog($event_data);
        $result["msg"]="";
        return json($result);
//        if ($result["Success"] == false) {
//            return success($msg = 'FAIL', json_encode($result),0);
//        }
//        return success($msg = 'SUCCESS', json_encode($result));

    }
    /**
     * 订单回调
     * @return Response
     */
    public function notify()
    {

         $data = $this->request->params([
             ["params",''],
             ["query",''],
             ["body",''],

         ]);


       // Log::write('订单回调' . json_encode($data,JSON_UNESCAPED_UNICODE));

        $res=[];
        $res["EBusinessID"] = env("fengchao.KDN_ID");;
        $res["Success"] = true;
        $res["Reason"] = "成功";
        $res["UpdateTime"] = date('Y-m-d H:i:s');
        echo json_encode($res);
        flush(); // 确保响应输出到客户端


        // 继续后台操作
        if (function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request();
        }
        $data=json_decode($data['body']['RequestData'], true);;
        $res_data =  $data["Data"][0];
        Log::write('订单回调完成' . json_encode($res_data));
        $state=$res_data["State"];

        Log::write('订单回调完成$state' . $state);


        switch ($state){
            case "301":
            case "208":
            case "601":
                //最终确认费用
                $res=(new CoreOrderService())->ConfirmOrder($res_data);
                break;
            //订单完成
            case "203":
            case "99":
                //订单取消 调度失败
                $res=(new CoreOrderService())->CancelOrder($res_data);
                break;
            default:
                break;
        }

        $order=[
            "order_id"=>$res_data["OrderCode"],
            "state"=>$state,
            "server_data"=>$res_data,
        ];
        (new OrderCallBackLogService())->add($order);

        Log::write('订单回调完成' . json_encode($data,JSON_UNESCAPED_UNICODE));


    }


}
