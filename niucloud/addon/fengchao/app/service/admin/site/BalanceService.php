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

/**
 * 会员账户流水服务层（会员个人账户通过会员服务层查询）
 * Class MemberAccountService
 * @package app\service\admin\member
 */
class BalanceService extends BaseAdminService
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new SiteAccount();
    }


    /**
     * 账户流水详情
     * @param int $id
     * @return array
     */
    public function getInfo()
    {
        $field = ' site_id, balance, balance_get, update_time';
        return $this->model->where([ ['site_id', '=', $this->site_id]])->field($field)->findOrEmpty()->toArray();
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

            'account_type' => $account_type,
            'account_data' => $account_data,
            "account_sum" => $account_new_data,
            'from_type' => $from_type,
            'create_time' => time(),

            'memo' => $memo,
            'related_id' => 0,
        );

        Db::startTrans();
        try {

            $res = $site_balance_log_model->create($data);
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
            event("MemberAccount", $data);
            Db::commit();
            return $res->id;
        } catch (Exception $e) {
            Db::rollback();
            throw new CommonException($e->getMessage());
        }


        return true;
    }


}
