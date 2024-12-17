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

namespace addon\fengchao\app\service\admin\api;

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
class SiteApiService extends BaseAdminService
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new  SiteAuth();
    }

    public function getList()
    {
        $field = 'id,api_name,callback_url,api_key,api_secret,create_time';
        $order = 'create_time desc';

        $list = $this->model->where([['site_id', '=', $this->site_id]])->field($field)->order($order)->select()->toArray();
        return $list;
    }

    public function add(array $data)
    {


        $data['create_time'] = time();
        $data['site_id'] = $this->site_id;
        $res = $this->model->create($data);

        return $res->id;
    }

    public function del(int $id)
    {
        $model = $this->model->where([['id', '=', $id], ['site_id', '=', $this->site_id]])->find();
        $res = $model->delete();
        return $res;
    }

    public function getByAppKey(string $api_key)
    {
        $field = 'id,site_id, api_key, api_secret';


        $detail = (new SiteAuth())->where([['api_key', '=', $api_key]])->field($field)->findOrEmpty()->toArray();

        return $detail;
    }

     public function getInfo(int $id)
    {
        $field = 'id,site_id,api_name, api_key, api_secret,callback_url';


        $data = (new SiteAuth())->where([['id', '=', $id], ['site_id', '=', $this->site_id]])->field($field)->findOrEmpty()->toArray();
        $encryption_key = env("fengchao.encryption_key");
            $data['api_secret'] = Crypto::decrypt($data["api_secret"], Key::loadFromAsciiSafeString($encryption_key));

        return $data;
    }

    // 重新计算签名
    public function verifySign($data, $api_secret)
    {
        $encryption_key = env("fengchao.encryption_key");

        $api_secret = Crypto::decrypt($api_secret, Key::loadFromAsciiSafeString($encryption_key));

        //var_dump($data);


        return $this->encrypt($data, $api_secret);
    }


    public function encrypt($data, $api_secret)
    {
        return urlencode(base64_encode(md5($data . $api_secret)));
    }


}
