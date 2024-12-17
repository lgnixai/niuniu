<?php

namespace addon\fengchao\app\service\admin\site;
use addon\fengchao\app\model\site\LinePrice;
use core\base\BaseAdminService;

/**
 *  线路价格
 * Class MemberAccountService
 * @package app\service\admin\member
 */
class LinePriceService extends BaseAdminService
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new LinePrice();
    }

    public function add(array $data)
    {
        $import_no=(new LinePriceLogService())->add();

        $result = $this->model->where([
            ['site_id', '=', $data["site_id"]],
            ['express_no', '=', $data["express_no"]],
            ['delivery', '=', $data["delivery"]],
        ])->delete();

        foreach ($data["line_price"] as $k => $item){
            $v=[];
            $v["sender_province"]=$item['senderProvince'];
            $v["receive_province"]=$item['receiveProvince'];
            $v["first_weight"]=$item['firstWeight'];
            $v["continuous_weight"]=$item['continuousWeight'];
            $v['site_id'] = $data["site_id"];
            $v['express_no'] = $data["express_no"];
            $v['delivery'] = $data["delivery"];
            $v['import_no']=$import_no;
            $v['create_time'] = time();
            $res = $this->model->create($v);
        }


        return 1;
    }

    public function getDataList($site_id,array $where)
    {
        $field = 'site_id,express_no,delivery,sender_province,receive_province,first_weight,continuous_weight';
        $list = (new LinePrice())->where([['site_id', '=', $site_id]])
            ->withSearch(['express_no','delivery'], $where)->field($field)->order('id asc')->select()->toArray();

        return $list;
    }
}
