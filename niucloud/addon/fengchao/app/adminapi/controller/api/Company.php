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

namespace addon\fengchao\app\adminapi\controller\api;

use core\base\BaseAdminController;
use addon\fengchao\app\service\admin\delivery\CompanyService;
use addon\fengchao\app\service\core\delivery\CoreCompanyService;


/**
 * 物流公司控制器
 * Class Company
 * @package addon\fengchao\app\adminapi\controller\delivery
 */
class Company extends BaseAdminController
{

    public function all()
    {

        return success((new CompanyService())->getAllList());
    }

}
