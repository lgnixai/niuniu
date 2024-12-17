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

namespace addon\fengchao\app\model\site;

use app\dict\common\ChannelDict;
use app\dict\common\CommonDict;
use app\dict\member\MemberDict;
use app\dict\member\MemberLoginTypeDict;
use app\dict\member\MemberRegisterChannelDict;
use app\dict\member\MemberRegisterTypeDict;
use app\model\member\MemberLevel;
use core\base\BaseModel;
use think\db\Query;
use think\model\concern\SoftDelete;

/**
 * 会员模型
 * Class Member
 * @package app\model\member
 */
class SiteAccount extends BaseModel
{


    use SoftDelete;


    /**
     * 数据表主键
     * @var string
     */
    protected $pk = 'site_id';

    /**
     * 模型名称
     * @var string
     */
    protected $name = 'fengchao_site';

    /**
     * 定义软删除标记字段
     * @var string
     */
    protected $deleteTime = 'delete_time';

    /**
     * 定义软删除字段的默认值
     * @var int
     */
    protected $defaultSoftDelete = 0;

}
