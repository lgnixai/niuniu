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

namespace addon\fengchao\app\dict\site;

class PriceTemplateDict
{
    const WEIGHT = 'weight';

    const PERCENT = 'percent';



    /**
     * 获取运费模板计费类型
     * @param $type
     * @return array|mixed|string
     */
    public static function getFeeType($type = ''){
        $type_list = [
            self::PERCENT => get_lang('dict_fengchao_site.percent'),
            self::WEIGHT => get_lang('dict_fengchao_site.weight'),

        ];
        if ($type == '') return $type_list;
        return $type_list[$type] ?? '';
    }
}
