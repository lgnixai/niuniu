<?php

namespace addon\fengchao\app\service\admin\site;
use addon\fengchao\app\model\site\LinePrice;
use addon\fengchao\app\model\site\LinePriceLog;
use core\base\BaseAdminService;

/**
 *  线路价格
 * Class MemberAccountService
 * @package app\service\admin\member
 */
class LinePriceLogService extends BaseAdminService
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new LinePriceLog();
    }

    public function add()
    {
            $v['import_no'] = create_no("import");
            $v['create_time'] = time();
            $res = $this->model->create($v);
            return $v['import_no'];
    }


}
