<?php

namespace addon\fengchao\app\api\controller\order;

use addon\fengchao\app\service\core\CoreOrderService;
use addon\fengchao\app\service\core\notify\KdniaoNoticeService;
use addon\fengchao\app\service\core\notify\YunjieNoticeService;
use core\base\BaseController;

use think\Exception;
use think\facade\Log;
use think\Response;


class Order extends BaseController
{

    /**
     * @Notes:快递鸟回调
     * kdniaoNotice
     * 2024/12/12  14:28
     * author:TK
     */
    public function kdniaoNotice()
    {
        $data = $this->request->params([
            ["RequestData", ''],
            ["Data", ''],
            ["DataSign", ''],
            ["RequestType", ''],
        ]);

        (new KdniaoNoticeService())->notice($data);
        $data = json_decode($data['RequestData'], true);;
        $res_data = $data["Data"][0];

        $result = (new CoreOrderService())->ChangeAppId($res_data);
        (new CoreOrderService())->NotifyOrder($result);

        Log::write('订单回调完成' . json_encode($data, JSON_UNESCAPED_UNICODE));
        $res = [];
        $res["EBusinessID"] = env("fengchao.KDN_ID");;
        $res["Success"] = true;
        $res["ResultCode"] = 100;
        $res["Reason"] = "成功";
        $res["UpdateTime"] = date('Y-m-d H:i:s');

        return Response::create($res, 'json', 200);
    }

    /**
     * @Notes:云杰回调
     * @return Response
     */
    protected $middleware = [Auth::class];
    public function yunjieNotice()
    {
        $data = $this->request->params([
            ["RequestData", ''],
            ["Data", ''],
            ["DataSign", ''],
            ["RequestType", ''],
        ]);
        (new YunjieNoticeService())->notice($data);
        $data = json_decode($data['RequestData'], true);;
        $res_data = $data["Data"][0];

        $result = (new CoreOrderService())->ChangeAppId($res_data);
        (new CoreOrderService())->NotifyOrder($result);

        Log::write('订单回调完成' . json_encode($data, JSON_UNESCAPED_UNICODE));
        $res = [];
        $res["EBusinessID"] = env("fengchao.KDN_ID");;
        $res["Success"] = true;
        $res["ResultCode"] = 100;
        $res["Reason"] = "成功";
        $res["UpdateTime"] = date('Y-m-d H:i:s');

        return Response::create($res, 'json', 200);
    }


}