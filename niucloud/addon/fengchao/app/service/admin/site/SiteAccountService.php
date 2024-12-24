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
use addon\fengchao\app\model\site\SiteAuth;
use addon\fengchao\app\model\site\SiteBalanceLog;
use app\dict\member\MemberAccountChangeTypeDict;
use app\dict\member\MemberAccountTypeDict;
use app\model\member\Member;
use app\model\member\MemberAccountLog;
use app\service\core\member\CoreMemberAccountService;
use core\base\BaseAdminService;
use core\exception\AdminException;
use core\exception\CommonException;
use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;
use think\facade\Db;

/**
 * 会员账户流水服务层（会员个人账户通过会员服务层查询）
 * Class MemberAccountService
 * @package app\service\admin\member
 */
class SiteAccountService extends BaseAdminService
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new  SiteAccount();
    }

  public function add(array $data)
    {

        $data['create_time'] = time();
        $res = $this->model->create($data);


        return $res->id;
    }

    public function edit( array $data)
    {
        $data[ 'update_time' ] = time();
        $this->model->where([  [ 'site_id', '=', $data['site_id'] ] ])->update($data);
        return true;
    }
    public function getInfo( int $site_id)
    {

        $res=$this->model->where([  [ 'site_id', '=', $site_id ] ])->findOrEmpty()->toArray();
        return $res;
    }


}
