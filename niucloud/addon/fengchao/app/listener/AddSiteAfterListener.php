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
namespace addon\fengchao\app\listener;

use addon\fengchao\app\model\goods\Label;
use addon\fengchao\app\model\goods\LabelGroup;
use addon\fengchao\app\service\admin\site\PriceTemplateService;
use addon\fengchao\app\service\admin\site\SiteService;
use addon\fengchao\app\service\core\delivery\CoreCompanyService;
use addon\fengchao\app\service\core\delivery\CoreElectronicSheetService;
use app\service\admin\diy\DiyService;
use app\service\core\poster\CorePosterService;

/**
 * 站点创建之后
 */
class AddSiteAfterListener
{
    public function handle($params = [])
    {
        if (in_array('fengchao', $params['main_app'])) {
            $site_id = $params['site_id'];
            request()->siteId($site_id);
            // 初始化余额
            $balance = new SiteService();
            $balance->initBalance($site_id);




        }
    }
}
