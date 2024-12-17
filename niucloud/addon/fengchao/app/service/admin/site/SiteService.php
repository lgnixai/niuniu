<?php
// +----------------------------------------------------------------------
// | Niucloud-admin 企业快速开发的saas管理平台
// +----------------------------------------------------------------------
// | 官方网址：https://www.niucloud.com
// +----------------------------------------------------------------------
// | niucloud团队 版权所有 开源版本可自由商用
// +----------------------------------------------------------------------
// | Author: Niucloud Team
// +----------------------------------------------------------------------

namespace addon\fengchao\app\service\admin\site;

use addon\fengchao\app\model\site\SiteAccount;
use addon\fengchao\app\model\site\SiteBalanceLog;
use app\dict\member\MemberAccountChangeTypeDict;
use app\dict\member\MemberAccountTypeDict;
use app\model\member\Member;
use app\model\member\MemberAccountLog;
use app\service\core\member\CoreMemberAccountService;
use core\base\BaseAdminService;
use core\exception\AdminException;
use core\exception\CommonException;
use think\facade\Db;
use think\facade\Log;

/**
 * 会员账户流水服务层（会员个人账户通过会员服务层查询）
 * Class MemberAccountService
 * @package app\service\admin\member
 */
class SiteService extends BaseAdminService
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new SiteBalanceLog();
    }


    /**
     * 初始化网站账户流水
     * @param $site_id
     * @param $addon
     * @param $data
     * @return true
     */
    public function initBalance($site_id)
    {

        $data[ 'site_id' ] = $site_id;
        ( new SiteAccount() )->create($data);
        return true;
    }

    /**
     * 会员账户流水列表
     * @param array $where
     * @return array
     */
    public function getPage(array $where = [])
    {

        $field = 'site_balance_log.id,  site_balance_log.site_id, site_balance_log.account_type, site_balance_log.account_data,site_balance_log.account_sum, site_balance_log.from_type,   site_balance_log.create_time, site_balance_log.memo';
        $site_where = [];
        if (isset($where['keywords']) && $where['keywords'] != '') {
            $site_where[] = ["site.site_id|site.site_name", 'like', '%' . $this->model->handelSpecialCharacter($where['keywords']) . '%'];
        }
        $search_model = $this->model->where([])->withSearch([ 'join_create_time' => 'create_time'], $where)
            ->withJoin(
                ['site' => ['site_id', 'site_name']
                ])->where($site_where)->field($field)->order('create_time desc')->append(['from_type_name', 'account_type_name']);
        return $this->pageQuery($search_model);
    }

    /**
     * 会员账户流水列表
     * @param array $where
     * @return array
     */
    public function getBySitePage(array $where = [])
    {

        $field = 'site_balance_log.id,  site_balance_log.site_id, site_balance_log.account_type, site_balance_log.account_data,site_balance_log.account_sum, site_balance_log.from_type,   site_balance_log.create_time, site_balance_log.memo';
        $site_where = [];

        $search_model = $this->model->where([['site_balance_log.site_id', '=', $this->site_id]])->withSearch([ 'join_create_time' => 'create_time'], $where)
            ->withJoin(
                ['site' => ['site_id', 'site_name']
                ])->where($site_where)->field($field)->order('create_time desc')->append(['from_type_name', 'account_type_name']);
        return $this->pageQuery($search_model);
    }

    /**
     * 账户流水详情
     * @param int $id
     * @return array
     */
    public function getInfo(int $id)
    {
        $field = 'id, member_id, site_id, account_type, account_data, from_type, related_id, create_time, memo';
        return $this->model->where([['id', '=', $id], ['site_id', '=', $this->site_id]])->with('memberInfo')->field($field)->append(['from_type_name', 'account_type_name'])->findOrEmpty()->toArray();
    }


    /**
     * 添加调整余额账户
     * @param array $data
     * @return bool
     */
    public function adjustBalance(array $data)
    {

        // $data[ 'member_id' ], 'balance', $data[ 'account_data' ], 'adjust', $data[ 'memo' ]

         ///var_dump($data);
        $site_model = new SiteAccount();
        $site_balance_log_model = new SiteBalanceLog();
        $site_id = $data['site_id'];
        $account_type = 'balance';
        $account_data = $data['account_data'];
        $from_type = $data["from_type"]??'adjust';
        $memo = $data['memo'];

        //账户检测
        $site_info = $site_model->where([
            ['site_id', '=', $site_id]
        ])->field($account_type . ',' . $account_type . "_get" . '')->lock(true)->find();

        if (empty($site_info)) throw new CommonException('SITE_NOT_EXIST');
        $account_new_data = round((float)$site_info[$account_type] + (float)$account_data, 2);

        if ($account_new_data < 0) {
            throw new CommonException('ACCOUNT_INSUFFICIENT');
        }

        $data = array(
            'site_id' => $site_id,
            'order_id' => $data['order_id']??0,
            'account_type' => $account_type,
            'account_data' => $account_data,
            "account_sum" => $account_new_data,
            'from_type' => $from_type,
            'create_time' => time(),

            'memo' => $memo,
            'pay_id' => $data['pay_id']??0,
        );

        Db::startTrans();

        Log::write("扣款---".json_encode($data,true).'---'.date("Y-m-d H:i:s").'------');

        try {

            $res = $site_balance_log_model->create($data);
            Log::write("添加扣款日志---".json_encode($res,true).'---'.date("Y-m-d H:i:s").'------');


            //账户更新
            if ($account_data > 0) {

                $from_type_arr = MemberAccountChangeTypeDict::getType($account_type)[$from_type];
                $is_change_get = $from_type_arr['is_change_get'] ?? 1;
                if ($is_change_get) {
                    $account_type_get = $site_info[$account_type . "_get"] + $account_data;
                } else {
                    $account_type_get = $site_info[$account_type . "_get"];
                }

            } else {
                $account_type_get = $site_info[$account_type . "_get"];
            }
            $site_model->update([
                $account_type => $account_new_data,
                $account_type . "_get" => $account_type_get
            ], [
                'site_id' => $site_id,
            ]);
            //账户变化事件
            $data[] = [
                $account_type => $account_new_data,
                $account_type . "_get" => $account_type_get
            ];

            Log::write("扣款成功---".json_encode($data,true).'---'.date("Y-m-d H:i:s").'------');


            Db::commit();
            return $res->id;
        } catch (Exception $e) {
            Log::write("扣款失败---".json_encode($data,true).'---'.date("Y-m-d H:i:s").'------');

            Db::rollback();
            throw new CommonException($e->getMessage());
        }


        return true;
    }


}
