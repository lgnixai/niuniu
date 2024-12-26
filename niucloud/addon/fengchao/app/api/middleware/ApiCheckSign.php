<?php
// +----------------------------------------------------------------------
// | Niucloud-admin 企业快速开发的saas管理平台
// +----------------------------------------------------------------------
// | 官方网址：https://www.niucloud.com
// +----------------------------------------------------------------------
// | niucloud团队 版权所有 开源版本可自由商用
// +----------------------------------------------------------------------
// | Author: Niucloud Team
// +----------------------------------------------------------------------

namespace addon\fengchao\app\api\middleware;

use addon\fengchao\app\adminapi\middleware\AdminException;
use addon\fengchao\app\service\admin\site\SiteAuthService;
use app\Request;
use app\service\admin\auth\AuthService;
use app\service\admin\auth\LoginService;
use Closure;
use core\exception\AuthException;
use core\exception\CommonException;
use think\facade\Log;

/**
 * admin用户登录token验证
 * Class AdminCheckToken
 * @package app\adminapi\middleware
 */
class ApiCheckSign
{
    public function handle(Request $request, Closure $next, bool $is_home = false)
    {

        $data = $request->params([
            [ "api_key", "" ],
            [ "EBusinessID", "" ],
            [ "RequestType", "" ],
            [ "RequestData", "" ],
            [ "DataType", 2 ],
            [ "DataSign", "" ]
        ]);

        $auth=(new SiteAuthService())->getByAppKey($data["EBusinessID"]);
        if(empty($auth)){

            return json(
                [
                    "EBusinessID"=>$data["EBusinessID"],
                    "ResultCode" => 10001,
                    "Reason" => "EBusinessID不存在",
                    "Success" =>false
                ]
            );
        }
        $requestData=urldecode($data["RequestData"]);


        $verifySignData=(new SiteAuthService())->verifySign($requestData,$auth["api_secret"]);
        Log::write('=====云杰000====='.$verifySignData . date('Y-m-d H:i:s', time()));
        Log::write('=====云杰000====='.$data["DataSign"] . date('Y-m-d H:i:s', time()));


        if($data["DataSign"]!==$verifySignData){
            return json(
                [
                    "EBusinessID"=>$data["EBusinessID"],
                    "ResultCode" => 10001,
                    "Reason" => "数据签名错误",
                    "Success" =>false
                ]
            );
        }


        $request->siteId($auth["site_id"]);
        $request->memberId($data["EBusinessID"]);

        return $next($request);
    }
}
