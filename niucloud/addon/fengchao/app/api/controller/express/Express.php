<?php


namespace addon\fengchao\app\api\controller\express;

use addon\fengchao\app\service\admin\site\BalanceService;
use addon\fengchao\app\service\api\express\ExpressService;
use addon\fengchao\app\service\api\order\OrderCallBackLogService;
use addon\fengchao\app\service\api\order\OrderEventService;
use addon\fengchao\app\service\api\order\OrderPrice;
use addon\fengchao\app\service\core\CoreOrderService;
use addon\fengchao\app\service\core\notify\KdniaoNoticeService;
use addon\fengchao\app\service\core\notify\YunjieNoticeService;
use app\dict\pay\PayDict;
use core\base\BaseApiController;
use core\exception\CommonException;
use core\util\Snowflake;
use think\facade\Cache;
use think\facade\Log;
use think\Response;


class Express extends BaseApiController
{


    //综合下单接口
    public function order()
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
            ["DataSign", ""],
            ["DataType", ""],
            ["ApiKey", ""],
            ["callback_url", ""],
        ]);

        Log::write('接口请求参数(' . $data['RequestType'] . ')' . json_encode($data));
        try {
            $this->validate($data, 'addon\fengchao\app\validate\express\Order.auth');
            $requestData = urldecode($data['RequestData']);
            Log::write('接口请求' . json_encode($requestData));

            $datas = array(
                'RequestType' => $data['RequestType'],
                'RequestData' => ($requestData),
                'SiteId' => $this->request->siteId(),
            );
            $event_data = [];
            $event_data["request"] = $requestData;
            $event_data["request_type"] = $data['RequestType'];
            $event_data["site_id"] = $this->request->siteId();

            $res_data = json_decode($requestData, true);
            $result = [];

            switch ($data['RequestType']) {
                case "1801":

                    $this->validate($res_data, 'addon\fengchao\app\validate\express\Kdn.1801');
                    //生成订单号
                    $order_id = event('CreateOrder', ['site_id' => $this->request->siteId(), 'order_code' => $res_data["OrderCode"]]);

                    $order_id = $order_id[0];
                    if ($order_id) {
                        $res_data["order_id"] = $order_id;
                        Log::write('1801下单接口' . json_encode($res_data));
                        $result = (new CoreOrderService())->CreateOrder($res_data);
                        $result = $result['result'];
                        Log::write('1801下单接口' . json_encode($result));
                    } else {
                        $result = [];
                        $result["EBusinessID"] = $data['EBusinessID'];
                        $result["Data"] = [];
                        $result["ResultCode"] = 10002;
                        $result["Reason"] = "订单号重复";
                        $result["Success"] = false;
                    }
                    break;

                case "1802":
                    //取消订单
                    Log::write('请求 1802 报价' . json_encode($requestData));
                    $this->validate($res_data, 'addon\fengchao\app\validate\express\Kdn.1802');
                    $result = (new CoreOrderService())->CancelOrder($res_data);
                    break;
                case "1804":
                    //查询订单
                    Log::write('请求 1804 查询订单' . json_encode($requestData));
                    $this->validate($res_data, 'addon\fengchao\app\validate\express\Kdn.1802');
                    $result = (new CoreOrderService())->ViewOrder($res_data);
                    break;
                case "1807":
                    //查询订单
                    Log::write('请求 1807 工单订单' . json_encode($requestData));
                    $this->validate($res_data, 'addon\fengchao\app\validate\express\Kdn.1807');
                    $result = (new CoreOrderService())->ComplaintOrder($res_data);
                    break;

                case "1815":
                    //询价
                    Log::write('请求 1815 报价' . json_encode($requestData));
                    $this->validate($res_data, 'addon\fengchao\app\validate\express\Kdn.1815');
                    $res = (new CoreOrderService())->PreOrder($res_data);

                    $event_data["response"] = $res;

                    $result = [];
                    $result["EBusinessID"] = $data['EBusinessID'];
                    $result["Data"] = $res;
                    $result["ResultCode"] = 100;
                    $result["Reason"] = "查询成功！";
                    $result["Success"] = true;
                    break;
                case "1816":
                    //轨迹查询订单
                    Log::write('请求 1816 轨迹查询订单' . json_encode($requestData));
                    $this->validate($res_data, 'addon\fengchao\app\validate\express\Kdn.1802');
                    $result = (new CoreOrderService())->RouteOrder($res_data);
                    break;
                case "1818":
                    //查询订单
                    Log::write('请求 1807 工单订单' . json_encode($requestData));
                    $this->validate($res_data, 'addon\fengchao\app\validate\express\Kdn.1807');
                    $result = (new CoreOrderService())->ComplaintViewOrder($res_data);
                    break;
                default:
                    $result = (new ExpressService())->Kdniao($datas);
                    Log::write('其它接口(' . $data['RequestType'] . ')' . json_encode($result));

            }
            $event_data["response"] = $result;

            //添加日志
            OrderEventService::createOrderLog($event_data);
            $result = (new CoreOrderService())->ChangeAppId($result);
            $this->replaceKeyCaseInsensitive($result, 'KDNOrderCode', 'PlatCode');

        } catch (\Throwable $e) {
            $result = [];
            $result["EBusinessID"] = $data['EBusinessID'];
            $result["Data"] = [];
            $result["ResultCode"] = 10001;
            $result["Reason"] = $e->getMessage();
            $result["Success"] = false;
            return json($result);
        }

        return json($result);

    }

    /**
     * 订单回调
     * @return Response
     */
    public function notify()
    {

        $data = $this->request->params([
            ["RequestData", ''],
            ["Data", ''],
            ["DataSign", ''],
            ["RequestType", ''],
        ]);

        (new KdniaoNoticeService())->notice($data);

        // Log::write('订单回调' . json_encode($data,JSON_UNESCAPED_UNICODE));
        $data = json_decode($data['RequestData'], true);;

        $res_data = $data["Data"][0];

        $result = (new CoreOrderService())->ChangeAppId($res_data);
        $this->replaceKeyCaseInsensitive($result, 'KDNOrderCode', 'PlatCode');



        (new CoreOrderService())->NotifyOrder($result);

        $res = [];
        $res["EBusinessID"] = env("fengchao.KDN_ID");;
        $res["Success"] = true;
        $res["ResultCode"] = 100;
        $res["Reason"] = "成功";
        $res["UpdateTime"] = date('Y-m-d H:i:s');

        echo json_encode($res);
        flush(); // 确保响应输出到客户端
        // 继续后台操作
        if (function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request();
        }

        exit;


        $data = json_decode($data['RequestData'], true);;
        $res_data = $data["Data"][0];
        Log::write('订单回调完成' . json_encode($res_data));
        $state = $res_data["State"];

        Log::write('订单回调完成$state' . $state);
        echo (new YunjieNoticeService())->notice($data);
        exit;
        switch ($state) {
            case "301":
            case "208":
            case "601":
                //最终确认费用
                $res1 = (new CoreOrderService())->ConfirmOrder($res_data);
                break;
            //订单完成
            case "203":
            case "206":
            case "99":
                //订单取消 调度失败
                $res1 = (new CoreOrderService())->CancelOrder($res_data);

                break;
            default:


                break;
        }

        $result = (new CoreOrderService())->ChangeAppId($res_data);
        (new CoreOrderService())->NotifyOrder($result);

        Log::write('订单回调完成' . json_encode($data, JSON_UNESCAPED_UNICODE));

        // echo json_encode($res);
    }


    public function replaceKeyCaseInsensitive(&$array, $oldKey, $newKey)
    {
        $stack = [&$array]; // Initialize the stack with the top-level array

        while (!empty($stack)) {
            $current = &$stack[array_key_last($stack)]; // Get the reference to the current element
            array_pop($stack); // Remove the current element from the stack

            foreach ($current as $key => &$value) {
                if (strcasecmp($key, $oldKey) === 0) { // Case-insensitive comparison
                    $current[$newKey] = $value; // Add the new key-value pair
                    unset($current[$key]);  // Remove the old key
                }
                if (is_array($value)) {
                    $stack[] = &$value; // Push the child array to the stack
                }
            }
            unset($value); // Break the reference to avoid side effects
        }
    }

}
