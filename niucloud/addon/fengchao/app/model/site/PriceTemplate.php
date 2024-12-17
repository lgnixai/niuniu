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

namespace addon\fengchao\app\model\site;

use addon\fengchao\app\dict\site\PriceTemplateDict;
use core\base\BaseModel;

/**
 * 物流模板模型
 * Class ShippingTemplate
 * @package addon\fengchao\app\model\delivery
 */
class PriceTemplate extends BaseModel
{
    /**
     * 数据表主键
     * @var string
     */
    protected $pk = 'template_id';

    /**
     * 模型名称
     * @var string
     */
    protected $name = 'fengchao_site_price_template';

    public function searchTemplateNameAttr($query, $value, $data)
    {
        if ($value != '') {
            $query->where([ [ 'template_name', 'like', "%$value%" ] ]);
        }
    }

    /**
     * 获取计费类型
     * @param $value
     * @param $data
     * @return array|mixed|string
     */
    public function getFeeTypeNameAttr($value, $data)
    {
        if (isset($data[ 'fee_type' ])) return PriceTemplateDict::getFeeType($data[ 'fee_type' ]);
    }
}
