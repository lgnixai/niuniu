<?php
// +----------------------------------------------------------------------
// | Author: TK
// +----------------------------------------------------------------------

namespace addon\tk_jhkd\app\service\core;

use addon\tk_jhkd\app\model\fenxiao\FenxiaoOrder;
use addon\tk_jhkd\app\model\fenxiao\FenxiaoMember;
use app\dict\member\MemberAccountTypeDict;
use app\model\member\MemberLevel;
use app\service\core\member\CoreMemberAccountService;
use app\service\core\member\CoreMemberService;
use core\base\BaseApiService;

/**
 * 分销公共服务层
 */
class FenxiaoService extends BaseApiService
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getFenxiaoInfo()
    {
        $fenxiaoModel=new FenxiaoMember();
        $fenxiaoOrderModel = new FenxiaoOrder();
        $firstFenxiao=$fenxiaoModel->where(['site_id'=>$this->site_id,'pid'=>$this->member_id])->select();
        $firstNum=count($firstFenxiao);
        $secondNum=0;
        $firstOrderNum=0;
        $secondOrderNum=0;
        foreach ($firstFenxiao as $k => $v){
            //$v['member_id']
            $twoFenxiao=$fenxiaoModel->where(['site_id'=>$this->site_id,'pid'=>$v['member_id']])->select();
            $secondNum=$secondNum+count($twoFenxiao);
            $firstOrder=$fenxiaoOrderModel->where(['site_id'=>$this->site_id,'member_id'=>$v['member_id']])->select();
            $firstOrderNum=$firstOrderNum+count($firstOrder);
            foreach ($twoFenxiao as $k2 => $v2){
                $secondOrder=$fenxiaoOrderModel->where(['site_id'=>$this->site_id,'member_id'=>$v2['member_id']])->select();
                $secondOrderNum=$secondOrderNum+count($secondOrder);
            }
        }
        $numData=[
            'first_num'=>$firstNum,
            'second_num'=>$secondNum,
            'first_order_num'=>$firstOrderNum,
            'second_order_num'=>$secondOrderNum
        ];
        return $numData;
    }

    /**
     * @Notes:分销佣金结算
     * @Interface fenxiaoEvent
     * @param $orderInfo
     * @return true
     * @author: TK
     * @Time: 2024/5/28   下午1:03
     */
    public function fenxiaoEvent($orderInfo)
    {
        $member_id = $orderInfo['member_id'];
        $site_id = $orderInfo['site_id'];
        $fenxiaoMemberModel = new FenxiaoMember();
        $fenxiaoOrderModel = new FenxiaoOrder();
        $fenxiaoModelInfo = $fenxiaoOrderModel->where(['order_id' => $orderInfo['order_id']])->findOrEmpty();
        if ($fenxiaoModelInfo->isEmpty()) {
            $fenxiaoOrderModel->save([
                'order_id' => $orderInfo['order_id'],
                'site_id' => $orderInfo['site_id'],
                'member_id' => $orderInfo['member_id'],
                'type' => 0,
                'status' => 0,
                'create_time' => time()
            ]);
        }
        //查询是否有上级会员
        $fenxiaoMemberInfo = $fenxiaoMemberModel->where(['site_id' => $site_id, 'member_id' => $member_id])->findOrEmpty();
        if ($fenxiaoMemberInfo->isEmpty()) return true;
        //获取一级分销会员信息
        $p_member_info = (new CoreMemberService())->getInfoByMemberId($site_id, $fenxiaoMemberInfo['pid'], 'nickname, point, member_level');
        if (empty($p_member_info)) return true;
        $p_member_info['member_level'] = (new MemberLevel())->where([['level_id', '=', $p_member_info['member_level']]])->field('site_id,level_id,level_benefits')->findOrEmpty()->toArray();
        if ($p_member_info['member_level'] && !empty($p_member_info['member_level']['level_benefits'])) {
            $level_benefits = $p_member_info['member_level']['level_benefits'];
            foreach ($level_benefits as $k => $v) {
                if ($k == 'tk_jhkd_fenxiao' && $v['is_use'] == 1) {
                    $commission=0;
                    //比列
                    if ($v['fenxiao_type'] == 0 && $v['first_rate'] > 0) {
                        $commission = $v['first_rate'] / 100 * $orderInfo['order_money'];
                    }
                    //固定金额
                    if ($v['fenxiao_type'] == 1 && $v['first_commission'] > 0) {
                        $commission = $v['first_commission'];
                    }
                    $commission = number_format($commission, 2, '.', '');
                    //记录佣金信息
                    $orderFenxiao = $fenxiaoOrderModel->where(['order_id' => $orderInfo['order_id']])->update([
                        'first_commission' => $commission,
                    ]);

                    (new CoreMemberAccountService())->addLog($orderInfo['site_id'], $fenxiaoMemberInfo['pid'], MemberAccountTypeDict::COMMISSION, $commission, 'jhkd_award', '聚合快递一级分销激励');
                    $fenxiaoOrderModel->where(['order_id' => $orderInfo['order_id']])->update([
                        'status' => 1,
                        'update_time' => time()
                    ]);
                }
            }
        }
        //获取二级分销信息
        $pp_fenxiaoMemberInfo = $fenxiaoMemberModel->where(['site_id' => $site_id, 'member_id' => $fenxiaoMemberInfo['pid']])->findOrEmpty();
        if ($pp_fenxiaoMemberInfo->isEmpty()) return true;
        $pp_member_info = (new CoreMemberService())->getInfoByMemberId($site_id, $pp_fenxiaoMemberInfo['pid'], 'nickname, point, member_level');
        if (empty($p_member_info)) return true;
        $pp_member_info['member_level'] = (new MemberLevel())->where([['level_id', '=', $pp_member_info['member_level']]])->field('site_id,level_id,level_benefits')->findOrEmpty()->toArray();

        if ($pp_member_info['member_level'] && !empty($pp_member_info['member_level']['level_benefits'])) {
            $level_benefits = $pp_member_info['member_level']['level_benefits'];

            foreach ($level_benefits as $k => $v) {
                if ($k == 'tk_jhkd_fenxiao' && $v['is_use'] == 1) {
                    $commission=0;
                    //比列
                    if ($v['fenxiao_type'] == 0 && $v['second_rate'] > 0) {
                        $commission = $v['second_rate'] / 100 * $orderInfo['order_money'];
                    }
                    //固定金额
                    if ($v['fenxiao_type'] == 1 && $v['second_commission'] > 0) {
                        $commission = $v['second_commission'];
                    }
                    $commission = number_format($commission, 2, '.', '');
                    //记录佣金信息
                    $orderFenxiao = $fenxiaoOrderModel->where(['order_id' => $orderInfo['order_id']])->update([
                        'two_commission' => $commission,
                    ]);

                    (new CoreMemberAccountService())->addLog($orderInfo['site_id'], $pp_fenxiaoMemberInfo['pid'], MemberAccountTypeDict::COMMISSION, $commission, 'jhkd_award', '聚合快递二级分销激励');
                    $fenxiaoOrderModel->where(['order_id' => $orderInfo['order_id']])->update([
                        'status' => 1,
                        'update_time' => time()
                    ]);
                }
            }
        }
        return true;
    }
    /**
     * @Notes:分销绑定
     * @Interface checkFenxiao
     * @param $data
     * @return array
     * @author: TK
     * @Time: 2024/5/28   下午1:02
     */
    public function checkFenxiao($data)
    {
        if ($this->member_id == $data['pid']) return [];
        $fenxiaoMemberModel = new FenxiaoMember();
        $fenxiaoMemberInfo = $fenxiaoMemberModel->where(['site_id' => $this->site_id, 'member_id' => $this->member_id])->findOrEmpty();
        //会员分销关系存在不进行管理
        if (!$fenxiaoMemberInfo->isEmpty()) return [];
        //上级会员信息及权限判断
        $p_member_info = (new CoreMemberService())->getInfoByMemberId($this->site_id, $data['pid'], 'nickname, point, member_level');
        if (empty($p_member_info)) return [];
        $p_member_info['member_level'] = (new MemberLevel())->where([['level_id', '=', $p_member_info['member_level']]])->field('site_id,level_id,level_benefits')->findOrEmpty()->toArray();
        if ($p_member_info['member_level'] && !empty($p_member_info['member_level']['level_benefits'])) {
            $level_benefits = $p_member_info['member_level']['level_benefits'];
            foreach ($level_benefits as $k => $v) {
                if ($k == 'tk_jhkd_fenxiao' && $v['is_use'] == 1) {
                    //等级拥有分销权限
                    $fenxiaoMemberModel->create([
                        'site_id' => $this->site_id,
                        'member_id' => $this->member_id,
                        'pid' => $data['pid'],
                        'create_time' => time()
                    ]);
                }
            }
        }
        return [];
    }

}