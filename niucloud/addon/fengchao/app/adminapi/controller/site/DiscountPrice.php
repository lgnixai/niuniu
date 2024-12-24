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

namespace addon\fengchao\app\adminapi\controller\site;


use addon\fengchao\app\model\site\SiteAccount;
use addon\fengchao\app\service\admin\site\LinePriceService;
use addon\fengchao\app\service\admin\site\SiteAccountService;
use core\base\BaseAdminController;
use core\exception\CommonException;
use think\facade\Cache;
use think\Response;

class DiscountPrice extends BaseAdminController
{


    public function update()
    {
        $data = $this->request->params([
            ["yunjie_discount", ""],
            ["site_id", ""],
        ]);

        $id = (new SiteAccountService())->edit($data);
        return success('更新成功', ['id' => $id]);
    }

    public function getBySiteId($site_id)
    {

        $site = (new SiteAccountService())->getInfo($site_id);
        return success('获取成功', ['discount'=>$site['yunjie_discount']]);
    }


}
