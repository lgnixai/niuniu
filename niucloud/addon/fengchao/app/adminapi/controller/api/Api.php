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

namespace addon\fengchao\app\adminapi\controller\api;

use addon\fengchao\app\model\site\SiteAuth;
use addon\fengchao\app\service\admin\api\SiteApiService;
use addon\fengchao\app\service\admin\site\SiteAuthService;
use app\service\api\sys\ConfigService;
use core\base\BaseAdminController;
use addon\fengchao\app\service\admin\delivery\CompanyService;
use addon\fengchao\app\service\core\delivery\CoreCompanyService;
use core\util\Snowflake;
use think\facade\Cache;
use think\facade\Request;
use think\facade\Db;
use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;

/**
 * 物流公司控制器
 * Class Company
 * @package addon\fengchao\app\adminapi\controller\delivery
 */
class Api extends BaseAdminController
{


    public function lists()
    {
        return success((new SiteApiService())->getList());

    }
    public function create_no(string $prefix = '', string $tag = '')
    {

        $data_center_id = 1;
        $machine_id = 2;
        $snowflake = new Snowflake($data_center_id, $machine_id);
        $id = $snowflake->generateId();
        $no = $prefix . date('Ymd') . $tag . $id;
        $cacheKey = 'unique_no_' . $no;
        if (Cache::get($cacheKey)) {
            return create_no($prefix, $tag);
        } else {
            Cache::set($cacheKey, true, 60); // 设置过期时间为 60 秒
            return $no;
        }
    }
    public function createNewApi()
    {

        // 生成 apikey
        //这里需要返回一个json
        $data = (new SiteApiService())->getUid();
        return success($data);

    }

    public function add()
    {
        $encryption_key = env("fengchao.encryption_key");

        $data = $this->request->params([
            ["api_name", ""],
            ["api_key", ""],
            ["api_secret", ""],
            ["callback_url", ""],
        ]);
        $encrypted_secret = Crypto::encrypt($data['api_secret'], Key::loadFromAsciiSafeString($encryption_key));
        $data["api_secret"] = $encrypted_secret;
        $id = (new SiteApiService())->add($data);
        return success('ADD_SUCCESS', ['id' => $id]);
    }

     /**
     * 物流公司删除
     * @param int $id 物流公司id
     * @return \think\Response
     */
    public function del(int $id)
    {
        (new SiteApiService())->del($id);
        return success('DELETE_SUCCESS');
    }


    public function info(int $id){
        return success((new SiteApiService())->getInfo($id));
    }

    public function domain(){
        $domain =( new ConfigService())->getSceneDomain();
        $url=$domain["service_domain"]."/api/v1/order";
        return success("",$url);


    }

    public function notifyUrl(){
        $domain =( new ConfigService())->getSceneDomain();
        $url=$domain["service_domain"]."/api/v1/callbackurl";
        return success("",$url);


    }

}
