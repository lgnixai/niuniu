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

namespace app\service\core\member;

use app\model\member\MemberAddress;
use core\base\BaseCoreService;

/**
 * 会员标签服务层
 * Class CoreMemberAccountService
 * @package app\service\core\member
 */
class CoreMemberAddressService extends BaseCoreService
{

    public function __construct()
    {
        parent::__construct();
        $this->model = new MemberAddress();
    }


    /**
     * 获取会员默认地址
     * @param int $member_id
     * @return array
     */
   public function getDefaultAddressByMemberId(int $member_id){
        $field = 'id,member_id,name,mobile,province_id,city_id,district_id,address,full_address,lng,lat,is_default';
        return $this->model->where([['member_id', '=', $member_id]])->field($field)->order('is_default desc')->findOrEmpty()->toArray();
   }

    /**
     * 获取会员存在经纬度的地址
     * @param int $member_id
     * @return array
     */
   public function getLngLatAddressByMemberId(int $member_id){
        $field = 'id,member_id,name,mobile,province_id,city_id,district_id,address,full_address,lng,lat,is_default';
        return $this->model->where([['member_id', '=', $member_id], ['lng', '<>', ''], ['lat', '<>', '']])->field($field)->order('is_default desc, id desc')->findOrEmpty()->toArray();
   }

    /**
     * 获取收货地址
     * @param int $id
     * @return array
     */
    public function getMemberAddressById(int $id, int $member_id){
        $field = 'id,member_id,name,mobile,province_id,city_id,district_id,address,full_address,lng,lat,is_default';
        return $this->model->where([['id', '=', $id], ['member_id', '=', $member_id]])->field($field)->findOrEmpty()->toArray();
    }
}
