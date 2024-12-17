<?php
// +----------------------------------------------------------------------
// | Niucloud-admin 企业快速开发的多应用管理平台
// +----------------------------------------------------------------------
// | 官方网址：https://www.niucloud.com
// +----------------------------------------------------------------------
// | niucloud团队 版权所有 开源版本可自由商用
// +----------------------------------------------------------------------
// | Author: Niucloud Team
// +----------------------------------------------------------------------

namespace addon\fengchao\app\adminapi\controller\sandbox;

use addon\fengchao\app\service\admin\api\SiteApiService;
use addon\fengchao\app\service\admin\site\OrderLogService;
use addon\fengchao\app\service\admin\site\PriceTemplateService;
use addon\fengchao\app\service\api\express\ExpressService;
use addon\fengchao\app\service\api\marketing\pointexchange\OrderCreateService;
use addon\fengchao\app\service\api\order\OrderEventService;
use addon\fengchao\app\service\api\order\OrderPrice;
use core\base\BaseApiController;
use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;
use think\Response;

class SandBox extends BaseApiController
{


    public function create()
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
            //'EBusinessID' => EBusinessID,
            'RequestType' => $data['RequestType'],
            'RequestData' => ($requestData),
            //'DataType' => '2',
        );

        $result = (new ExpressService())->Kdniao($datas);

//        $datas['DataSign'] = $this->encrypt($requestData, ApiKey);
//        //以form表单形式提交post请求，post请求体中包含了应用级参数和系统级参数
//        $result = $this->sendPost(ReqURL, $datas);

        $event_data=[];
        $event_data["request"]=$requestData;
        $event_data["request_type"]=$data['RequestType'];
        $event_data["site_id"]=$this->request->siteId();
        $event_data["response"]=$result;

        //添加日志
        OrderEventService::createOrderLog($event_data);

        //订单创建
        if ($data['RequestType'] == "1801") {
            event('AfterOrderCreate', $event_data);
        }
        if ($data['RequestType'] == "1815") {
            $result=(new OrderPrice())->get_sell_price($event_data);
         }

        return success($msg = 'SUCCESS', json_encode($result));

    }

    public function info(int $id)
    {
        return success((new SiteApiService())->getInfo($id));
    }



}
