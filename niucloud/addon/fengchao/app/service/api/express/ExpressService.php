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

use addon\fengchao\app\service\core\order\CoreOrderConfigService;
use core\base\BaseAdminService;
use core\base\BaseApiService;
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
        if (isset($request_data["OrderCode"])) {
            $request_data["OrderCode"]=$data["SiteId"]."_".$request_data["OrderCode"];
        }
        //var_dump( $request_data );
        $request_data= json_encode($request_data,JSON_UNESCAPED_UNICODE);

// 组装系统级参数
        $datas = array(
            'EBusinessID' => $EBusinessID,
            'RequestType' => $data['RequestType'],
            'RequestData' => urlencode($request_data),
            'DataType' => '2',
        );
        $datas['DataSign'] = $this->encrypt($request_data, $AppKey);

        //以form表单形式提交post请求，post请求体中包含了应用级参数和系统级参数
        $result = $this->sendPost($ReqURL, $datas);
        $result=json_decode($result,true);


        if(isset($result['OrderCode'])){
            $result['OrderCode']=str_replace($data["SiteId"]."_","",$result['OrderCode']);
         }
        if(isset($result["Order"]["OrderCode"])){
            $result["Order"]["OrderCode"]=str_replace($data["SiteId"]."_","",$result["Order"]["OrderCode"]);
        }

        return  $result;
    }

    public function KdniaoDev($data)
    {



        // 组装系统级参数
        $datas = array(
            'EBusinessID' => $EBusinessID,
            'RequestType' => $data["RequestData"],
            'RequestData' => urlencode($data["RequestData"]),
            'DataType' => '2',
        );
        $datas['DataSign'] = $this->encrypt($data["RequestData"], $AppKey);
        //以form表单形式提交post请求，post请求体中包含了应用级参数和系统级参数

        $result = $this->sendPost($ReqURL, $datas);
       // $result=json_decode($result,true);
        //echo $result['OrderCode'];
        var_dump($result);

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