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

namespace addon\fengchao\app\adminapi\controller\delivery;

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
    /**
     * 获取物流公司列表
     * @return \think\Response
     */
    public function pages()
    {
        $data = $this->request->params([
            ["company_name", ""],
            ['electronic_sheet_switch', '']
        ]);
        return success((new CompanyService())->getPage($data));
    }

    /**
     * 获取物流公司列表
     * @return \think\Response
     */
    public function lists()
    {
        $data = $this->request->params([
            ["company_name", ""],
            ['electronic_sheet_switch', '']
        ]);
        return success((new CompanyService())->getList($data));
    }

    /**
     * 物流公司详情
     * @param int $id
     * @return \think\Response
     */
    public function info(int $id)
    {
        return success((new CompanyService())->getInfo($id));
    }

    /**
     * 添加物流公司
     * @return \think\Response
     */
    public function add()
    {
        $data = $this->request->params([
            ["company_name", ""],

            ["express_no", ""], // 物流公司编号(用于物流跟踪)

        ]);
        $this->validate($data, 'addon\fengchao\app\validate\delivery\Company.add');
        $id = (new CompanyService())->add($data);
        return success('ADD_SUCCESS', ['id' => $id]);
    }

    /**
     * 物流公司编辑
     * @param int $id 物流公司id
     * @return \think\Response
     */
    public function edit($id)
    {
        $data = $this->request->params([
            ["company_name", ""],

            ["express_no", ""], // 物流公司编号(用于物流跟踪)

         ]);
        $this->validate($data, 'addon\fengchao\app\validate\delivery\Company.edit');
        (new CompanyService())->edit($id, $data);
        return success('EDIT_SUCCESS');
    }

    /**
     * 物流公司删除
     * @param int $id 物流公司id
     * @return \think\Response
     */
    public function del(int $id)
    {
        (new CompanyService())->del($id);
        return success('DELETE_SUCCESS');
    }

    public function init()
    {
        (new CompanyService())->init();
        return success('INIT_DATA_SUCCESS');
    }


    /**
     * 获取物流公司列表
     * @return \think\Response
     */
    public function all()
    {
        return success((new CompanyService())->getAllList());
    }

}
