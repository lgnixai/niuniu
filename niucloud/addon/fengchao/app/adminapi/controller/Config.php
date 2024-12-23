<?php

namespace addon\fengchao\app\adminapi\controller;


//use addon\fengchao\app\service\core\CloudService as CommonAuth;
use core\base\BaseAdminController;
use addon\fengchao\app\service\core\ConfigService;


class Config extends BaseAdminController
{
    /**
     * 接口数据
     */
    public function getConfig()
    {
        return success("fengchao_SUCCESS", (new ConfigService())->getConfig());
    }
    public function setConfig()
    {
       // (new CommonAuth())->auth();
        $data = $this->request->params([
            ['username', ''],
            ['privateKey', ''],
            ['floatWay', ''],
            ['floatAmount', ''],
            ['firstAmount', '1.5'],
            ['secondAmount', '0.5'],
            ['floatRate', ''],
            ['bindMobile', ''],
            ['amapKey', ''],
            ['autosend', '1'],
            ['cancelmin', '0'],
            ['address_use', '0'],
            ['tx_id', ''],
            ['tx_secret', ''],
            ["is_webhook", 0],
            ["webhook_type", 0],
            ["qwurl", ''],
            ["fsurl", ''],
            ["ddurl", ''],
            ["min", ''],
            ["appcode", ''],
            ["is_shipping", 0],
        ]);
        (new ConfigService())->setConfig($data);
        return success('fengchao_SUCCESS');
    }
    public function getBalance()
    {
       // return success((new YidaService())->getBalance());
    }
}
