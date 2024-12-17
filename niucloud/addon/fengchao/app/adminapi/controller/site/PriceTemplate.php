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

use addon\fengchao\app\service\admin\delivery\ShippingTemplateService;
use addon\fengchao\app\service\admin\site\PriceTemplateService;
use core\base\BaseAdminController;


/**
 * 运费模板控制器
 * Class ShippingTemplate
 * @package addon\fengchao\app\adminapi\controller\delivery
 */
class PriceTemplate extends BaseAdminController
{


    /**
     * 添加运费模板
     * @return void
     */
    public function add()
    {
        $data = $this->request->params([
            [ 'template_name', '' ],
            [ 'fee_type', '' ],
            [ 'area', [] ],
            [ 'no_delivery', 0 ],
            [ 'is_free_shipping', 0 ]
        ]);
        return success('ADD_SUCCESS', ( new PriceTemplateService() )->add($data));
    }

    /**
     * 编辑运费模板
     * @return void
     */
    public function edit(int $template_id)
    {
        $data = $this->request->params([
            [ 'template_name', '' ],
            [ 'fee_type', '' ],
            [ 'site_id', '' ],
            [ 'companys', '' ],

        ]);
        return success('EDIT_SUCCESS', ( new PriceTemplateService() )->edit($template_id, $data));
    }

    /**
     * 删除模板
     * @param int $template_id
     * @return \think\Response
     */
    public function del(int $template_id)
    {
        return success('DELETE_SUCCESS', ( new PriceTemplateService() )->delete($template_id));
    }


    /**
     * 运费模板详情
     * @param int $template_id
     * @return void
     */
    public function info(int $template_id)
    {
        return success(( new PriceTemplateService() )->getInfo($template_id));
    }

    /**
     * 站点运费模板详情
     * @param int $template_id
     * @return void
     */
    public function site_info(int $site_id)
    {


        return success(( new PriceTemplateService() )->getSiteInfo($site_id));
    }
}
