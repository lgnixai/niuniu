<?php

namespace addon\fengchao\app\service\core;


use core\base\BaseAdminService;
use app\service\core\sys\CoreConfigService;

/**
 * 配置信息服务层
 * Class ConfigService
 * @package addon\fengchao\service\core\config
 */
class ConfigService extends BaseAdminService
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 获取配置信息
     * @param $site_id
     * @param string $config_key
     */
    public function getConfig()
    {
        $info = (new CoreConfigService())->getConfig($this->site_id, 'fengchao_CONFIG');
        $url_data = [
            [
                'name' => '易达178',
                'url' => (new CommonService())->getUrl() . '/api/fengchao/yidanotice',
            ],
            [
                'name' => '云洋',
                'url' => (new CommonService())->getUrl() . '/api/fengchao/yunyangnotice',
            ],
            [
                'name' => '辛达',
                'url' => (new CommonService())->getUrl() . '/api/fengchao/xindanotice',
            ],
            [
                'name' => '快递鸟',
                'url' => (new CommonService())->getUrl() . '/api/fengchao/kdniaonotice',
            ],
            [
                'name' => '亿速',
                'url' => (new CommonService())->getUrl() . '/api/fengchao/yisunotice',
            ],
        ];
        $info['value']['url_data'] = $url_data;
        return $info;
    }

    /**
     * 设置配置信息
     * @param $site_id
     * @param string $config_key
     * @return string|null
     */
    public function setConfig($value)
    {
        return (new CoreConfigService())->setConfig( 'FENGCHAO_CONFIG', $value);
    }

    public function getSiteId()
    {
        return $this->site_id;
    }
}
