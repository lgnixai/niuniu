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
use think\facade\Log;

class AliCallBackCheckSign
{
    public function handle(Request $request, Closure $next, bool $is_home = false)
    {

        $data = $request->params([
            [ "body", "" ],

        ]);

         $requestData=($data["body"]["RequestData"]);

         $AppKey = env("fengchao.KDN_KEY");
         $verifySignData=(new SiteAuthService())->encrypt($requestData,$AppKey);

//        Log::write('下单失败'.$verifySignData . date('Y-m-d H:i:s'));
//        Log::write('下单失败'.$data["body"]["DataSign"]!==urldecode($verifySignData) . date('Y-m-d H:i:s'));

        if($data["body"]["DataSign"]!==urldecode($verifySignData)){
             throw new AuthException('回调数据签名错误');
        }
        return $next($request);
    }
}