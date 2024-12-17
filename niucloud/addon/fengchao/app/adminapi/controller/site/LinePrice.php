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


use addon\fengchao\app\service\admin\site\LinePriceService;
use core\base\BaseAdminController;
use core\exception\CommonException;
use think\facade\Cache;
use think\Response;

class LinePrice extends BaseAdminController
{


    public function add()
    {
        $data = $this->request->params([
            ["line_price", ""],
            ["express_no", ""],
            ["delivery", ""],
            ["site_id", ""],

        ]);
        // $this->validate($data, 'addon\fengchao\app\validate\delivery\Company.add');
        $id = (new LinePriceService())->add($data);
        return success('ADD_SUCCESS', ['id' => $id]);
    }

    public function getBySiteId()
    {
        $data = $this->request->params([

            [ 'site_id', '' ],
            [ 'delivery', '' ],
            [ 'express_no',  '' ],
        ]);
        $site_id=$data['site_id'];
        return success(( new LinePriceService() )->getDataList($site_id,$data));
    }


}
