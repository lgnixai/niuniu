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

namespace addon\fengchao\app\validate\express;

use core\base\BaseValidate;

/**
 * 物流公司验证器
 * Class Company
 * @package addon\fengchao\app\validate\delivery
 */
class Order extends BaseValidate
{

    protected $rule = [
        'EBusinessID' => 'require',
        'RequestData' => 'require|isJson',
        'RequestType' => 'require',
        'DataType' => 'require',
        'DataSign' => 'require',
    ];

    protected $message = [
        'EBusinessID.require' =>'validate_api.business_id_require',
        'RequestData.require' =>'validate_api.request_data_require',
        'RequestType.require' =>'validate_api.request_type_require',
        'DataType.require' =>'validate_api.data_type_require',
        'DataSign.require' =>'validate_api.data_sign_require',

    ];

    protected $scene = [
        "auth" => [ 'EBusinessID', 'RequestData', 'RequestType', 'DataSign' ],

    ];

    protected function isJson($value, $rule, $data = [])
    {
        if (is_string($value)) {
            json_decode($value);
            return (json_last_error() === JSON_ERROR_NONE) ? true : '字段必须为合法的 JSON 字符串';
        }
        return '字段必须为字符串类型';
    }

}
