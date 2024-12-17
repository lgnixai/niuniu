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

use core\base\BaseModel;

/**
 * 物流公司模型
 * Class Company
 * @package addon\fengchao\app\model\delivery
 */
class LinePrice extends BaseModel
{


    /**
     * 数据表主键
     * @var string
     */
    protected $pk = 'id';

    /**
     * 模型名称
     * @var string
     */
    protected $name = 'fengchao_line_price';

    // 设置json类型字段
    protected $json = [   ];

    // 设置JSON数据返回数组
    protected $jsonAssoc = true;


    public function searchExpressNoAttr($query, $value)
    {
        if (!empty($value)) {
            $query->where('express_no', '=', "{$value}");
        }
    }

    public function searchDeliveryAttr($query, $value)
    {
        if (!empty($value)) {
            $query->where('delivery', '=', "{$value}");
        }
    }

}
