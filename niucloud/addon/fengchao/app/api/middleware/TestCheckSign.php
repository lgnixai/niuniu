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

class TestCheckSign
{
    public function handle(Request $request, Closure $next, bool $is_home = false)
    {

        $request->siteId(100004);

        return $next($request);
    }
}
