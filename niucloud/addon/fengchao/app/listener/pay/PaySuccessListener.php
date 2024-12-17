<?php
// +----------------------------------------------------------------------
// | Niucloud-admin 企业快速开发的saas管理平台
// +----------------------------------------------------------------------
// | 官方网址：https://www.niucloud-admin.com
// +----------------------------------------------------------------------
// | niucloud团队 版权所有 开源版本可自由商用
// +----------------------------------------------------------------------
// | Author: Niucloud Team
// +----------------------------------------------------------------------

namespace addon\fengchao\app\listener\pay;

use app\service\core\site\CoreSiteAccountService;
use think\facade\Log;

/**
 * 支付异步回调事件
 */
class PaySuccessListener
{
    public function handle(array $pay_info)
    {



        Log::write("监听支付成功回调事件---".json_encode($pay_info,true).'---'.date("Y-m-d H:i:s").'------');


    }
}