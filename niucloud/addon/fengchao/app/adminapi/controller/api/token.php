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
use addon\fengchao\app\service\admin\site\SiteAuthService;
use core\base\BaseAdminController;
use addon\fengchao\app\service\admin\delivery\CompanyService;
use addon\fengchao\app\service\core\delivery\CoreCompanyService;
use think\facade\Request;
use think\facade\Db;
use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;

/**
 * 物流公司控制器
 * Class Company
 * @package addon\fengchao\app\adminapi\controller\delivery
 */
class token extends BaseAdminController
{

    public function generateApiKeyAndSecret()
    {

        $encryption_key = env("fengchao.encryption_key");

        // 生成 apikey
        $apikey = bin2hex(random_bytes(16));

        // 生成 apisecret
        $apisecret = bin2hex(random_bytes(32));

       // $encrypted_key = Crypto::encrypt($apikey, Key::loadFromAsciiSafeString($encryption_key));

        $encrypted_secret = Crypto::encrypt($apisecret, Key::loadFromAsciiSafeString($encryption_key));

        $data = [
            'api_key' => $apikey,
            'api_secret' => $encrypted_secret,
        ];
        //这里需要返回一个json

        return ($data);

    }

//
    public function createApiKey()
    {

        $data = $this->generateApiKeyAndSecret();
        $data["site_id"] = 10004;
        $id = (new SiteAuthService())->add($data);

        return success((new SiteAuthService())->add($data));

    }

    public function getApiKey()
    {
        $id = Request::param("id");

        $encryption_key = env("fengchao.encryption_key");
        // 把data 数据转换成数组
        $data = (new SiteAuthService())->getAllList();

        $processedData = array_map(function ($item) use ($encryption_key) {
            //$item['api_key'] = Crypto::decrypt($item["api_key"], Key::loadFromAsciiSafeString($encryption_key));
            $item['api_secret'] = Crypto::decrypt($item["api_secret"], Key::loadFromAsciiSafeString($encryption_key));
            return $item;
        }, $data);

        return success($processedData);
    }


}
