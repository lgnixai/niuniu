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

namespace addon\fengchao\app\service\api\express;

use addon\fengchao\app\service\core\common\OrderDeliveryService;
use addon\fengchao\app\service\core\order\CoreOrderConfigService;
use addon\fengchao\app\service\core\order\OrderService;
use core\base\BaseAdminService;
use core\base\BaseApiService;
use think\facade\Log;
use function Symfony\Component\Translation\t;


/**
 * 订单设置服务层
 * Class ConfigService
 * @package adaddon\fengchao\app\service\admin\order
 */
class ExpressService extends BaseApiService
{


    public function __construct()
    {

    }
    public function Kdniao($data)
    {
        $EBusinessID = env("fengchao.KDN_ID");
        $AppKey = env("fengchao.KDN_KEY");
        $ReqURL = env("fengchao.KDN_URL");
        $request_data=json_decode($data["RequestData"],true);
        // 处理客户订单号
        if (isset($request_data["OrderCode"])&&$data["RequestType"]!="1801") {

            $order=(new OrderDeliveryService())->getOrderIdByClient($request_data['OrderCode']);

            $request_data["OrderCode"]=$order;
        }

        $request_data= json_encode($request_data,JSON_UNESCAPED_UNICODE);

// 组装系统级参数
        $datas = array(
            'EBusinessID' => $EBusinessID,
            'RequestType' => $data['RequestType'],
            'RequestData' => urlencode($request_data),
            'DataType' => '2',
        );
        $datas['DataSign'] = $this->encrypt($request_data, $AppKey);


        Log::write("向快递鸟下单的数据---".$request_data.'---'.date("Y-m-d H:i:s").'------');

        //以form表单形式提交post请求，post请求体中包含了应用级参数和系统级参数
        $result = $this->sendPost($ReqURL, $datas);
        $result=json_decode($result,true);



        if($datas["RequestType"]!="1801"){
            if(isset($result['OrderCode'])){
                $clientId=(new OrderDeliveryService())->getClientIdById($result['OrderCode']);

                if(isset($order)){
                    $result['OrderCode']=$clientId;
                }else{
                    throw new \Exception("订单不存在");
                }

            }
            if(isset($result["Order"]["OrderCode"])){
                $order=(new OrderDeliveryService())->getClientIdById( $result["Order"]["OrderCode"]);
                if(isset($order)){
                    $result["Order"]["OrderCode"]=$clientId;

                }else{
                    throw new \Exception("订单不存在");
                }

            }
        }
        return  $result;
    }


    /**
     *  post提交数据
     * @param string $url 请求Url
     * @param array $datas 提交的数据
     * @return url响应返回的html
     */
    public function sendPost($url, $datas)
    {
        $postdata = http_build_query($datas);
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type:application/x-www-form-urlencoded',
                'content' => $postdata,
                'timeout' => 15 * 60 // 超时时间（单位:s）
            )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return $result;
    }

    /**
     * 电商Sign签名生成
     * @param data 内容
     * @param api_secret api_secret
     * @return DataSign签名
     */
    public function encrypt($data, $api_secret)
    {
        return urlencode(base64_encode(md5($data . $api_secret)));
    }

}
