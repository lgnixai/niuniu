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

namespace addon\fengchao\app\service\admin\delivery;

use addon\fengchao\app\model\delivery\Company;
use core\base\BaseAdminService;

use think\facade\Db;

/**
 * 物流公司服务层
 * Class CompanyService
 * @package addon\fengchao\app\service\admin\delivery
 */
class CompanyService extends BaseAdminService
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new Company();
        $this->site_id = 1;
    }

    /**
     * 获取物流公司分页列表
     * @param array $where
     * @return array
     */
    public function getPage(array $where = [])
    {
        $field = 'company_id,company_name,logo,url,express_no,express_no_electronic_sheet,electronic_sheet_switch,create_time';
        $order = 'create_time desc';

        $search_model = $this->model->where([['site_id', '=', $this->site_id]])->withSearch(["company_name", 'electronic_sheet_switch'], $where)->field($field)->order($order);
        $list = $this->pageQuery($search_model);
        return $list;
    }

    /**
     * 获取物流公司列表
     * @param array $where
     * @param string $field
     * @return array
     */
    public function getList(array $where = [], $field = 'company_id,company_name,logo,url,express_no,express_no_electronic_sheet,electronic_sheet_switch,create_time')
    {
        $order = 'create_time desc';

        return $this->model->where([['site_id', '=', $this->site_id]])->withSearch(["company_name", 'electronic_sheet_switch'], $where)->field($field)->order($order)->select()->toArray();
    }

    /**
     * 获取物流公司信息
     * @param int $id
     * @return array
     */
    public function getInfo(int $id)
    {
        $field = 'company_id,company_name,logo,url,express_no,express_no_electronic_sheet,electronic_sheet_switch,create_time';

        $info = $this->model->field($field)->where([['company_id', '=', $id], ['site_id', '=', $this->site_id]])->findOrEmpty()->toArray();
        return $info;
    }

    /**
     * 添加物流公司
     * @param array $data
     * @return mixed
     */
    public function add(array $data)
    {
        $data['site_id'] = $this->site_id;
        $data['create_time'] = time();
        $res = $this->model->create($data);
        return $res->company_id;
    }

    /**
     * 物流公司编辑
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function edit(int $id, array $data)
    {
        $data['update_time'] = time();
        $this->model->where([['company_id', '=', $id], ['site_id', '=', $this->site_id]])->update($data);
        return true;
    }

    /**
     * 删除物流公司
     * @param int $id
     * @return bool
     */
    public function del(int $id)
    {
        $res = $this->model->where([['company_id', '=', $id], ['site_id', '=', $this->site_id]])->delete();
        return $res;
    }

    /**
     * 初始化物流公司
     * @return bool
     */
    public function init()
    {
        $site_id = $this->site_id;
        $company_list = [
            [
                'site_id' => $site_id,
                'create_time' => time(),
                'company_name' => '邮政EMS',
                'logo' => 'addon/fengchao/express/ems.jpg',
                'url' => 'https://www.ems.com.cn',
                'express_no' => 'EMS',
                'express_no_electronic_sheet' => 'EMS',
                'electronic_sheet_switch' => 1,

            ],

            [
                'site_id' => $site_id,
                'create_time' => time(),
                'company_name' => '顺丰速运',
                'logo' => 'addon/fengchao/express/shunfeng.png',
                'url' => 'https://www.sf-express.com/chn/sc',
                'express_no' => 'SF',
                'express_no_electronic_sheet' => 'SF',
                'electronic_sheet_switch' => 1,

            ],
            [
                'site_id' => $site_id,
                'create_time' => time(),
                'company_name' => '中通快递',
                'logo' => 'addon/fengchao/express/zhongtong.png',
                'url' => 'https://www.zto.com',
                'express_no' => 'ZTO',
                'express_no_electronic_sheet' => 'ZTO',
                'electronic_sheet_switch' => 1,

            ],
            [
                'site_id' => $site_id,
                'create_time' => time(),
                'company_name' => '圆通速递',
                'logo' => 'addon/fengchao/express/yuantong.png',
                'url' => 'https://www.yto.net.cn',
                'express_no' => 'YTO',
                'express_no_electronic_sheet' => 'YTO',
                'electronic_sheet_switch' => 1,

            ],
            [
                'site_id' => $site_id,
                'create_time' => time(),
                'company_name' => '申通快递',
                'logo' => 'addon/fengchao/express/shentong.png',
                'url' => 'https://www.sto.cn/pc',
                'express_no' => 'STO',
                'express_no_electronic_sheet' => 'STO',
                'electronic_sheet_switch' => 1,

            ],
            [
                'site_id' => $site_id,
                'create_time' => time(),
                'company_name' => '韵达速递',
                'logo' => 'addon/fengchao/express/yunda.png',
                'url' => 'http://www.yundaex.com/cn',
                'express_no' => 'YD',
                'express_no_electronic_sheet' => 'YD',
                'electronic_sheet_switch' => 1,

            ],
            [
                'site_id' => $site_id,
                'create_time' => time(),
                'company_name' => '极兔速递',
                'logo' => 'addon/fengchao/express/jitu.png',
                'url' => 'https://www.jtexpress.cn',
                'express_no' => 'JTSD',
                'express_no_electronic_sheet' => 'JTSD',
                'electronic_sheet_switch' => 1,

            ],
            [
                'site_id' => $site_id,
                'create_time' => time(),
                'company_name' => '菜鸟速递',
                'logo' => 'addon/fengchao/express/cainiao.jpg',
                'url' => 'https://express.cainiao.com/',
                'express_no' => 'CNSD',
                'express_no_electronic_sheet' => 'CNSD',
                'electronic_sheet_switch' => 1,

            ],
            [
                'site_id' => $site_id,
                'create_time' => time(),
                'company_name' => '京东快递',
                'logo' => 'addon/fengchao/express/jingdong.jpg',
                'url' => 'https://www.jdl.com',
                'express_no' => 'JD',
                'express_no_electronic_sheet' => 'JD',
                'electronic_sheet_switch' => 1,

            ] ,
            [
                'site_id' => $site_id,
                'create_time' => time(),
                'company_name' => '德邦',
                'logo' => '',
                'url' => '',
                'express_no' => 'DBL',
                'express_no_electronic_sheet' => 'DBL',
                'electronic_sheet_switch' => 1,


            ],
            [
                'site_id' => $site_id,
                'create_time' => time(),
                'company_name' => '菜鸟裹裹',
                'logo' => '',
                'url' => '',
                'express_no' => 'CAINIAO',
                'express_no_electronic_sheet' => 'CAINIAO',
                'electronic_sheet_switch' => 1,


            ],
            [
                'site_id' => $site_id,
                'create_time' => time(),
                'company_name' => '丹鸟',
                'logo' => '',
                'url' => '',
                'express_no' => 'DNWL',
                'express_no_electronic_sheet' => 'DNWL',
                'electronic_sheet_switch' => 1,


            ],
        ];

        $table_name = $this->model->getTable();

        Db::execute("truncate " . $table_name);
        $res = $this->model->insertAll($company_list);
        return $res;
    }

    /**
     * 获取物流公司列表
     * @param array $where
     * @param string $field
     * @return array
     */
    public function getAllList(array $where = [], $field = 'company_id,company_name,express_no')
    {
        $order = 'create_time desc';

        return $this->model->where([])->field($field)->order($order)->select()->toArray();
    }


}
