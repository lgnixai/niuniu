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

namespace addon\fengchao\app\service\admin\site;

use addon\fengchao\app\model\delivery\Company;
use addon\fengchao\app\model\delivery\ShippingTemplate;
use addon\fengchao\app\model\delivery\ShippingTemplateItem;
use addon\fengchao\app\model\goods\Goods;
use addon\fengchao\app\model\site\PriceTemplate;
use addon\fengchao\app\model\site\PriceTemplateItem;
use addon\fengchao\app\service\admin\delivery\CompanyService;
use core\base\BaseAdminService;
use core\exception\CommonException;
use think\facade\Db;

/**
 * 运费模板服务层
 * Class ShippingTemplateService
 * @package addon\fengchao\app\service\admin\delivery
 */
class PriceTemplateService extends BaseAdminService
{

    /**
     * 添加运费模板
     * @param array $data
     * @return void
     */
    public function add(array $data)
    {
        Db::startTrans();
        try {
            $create_res = (new ShippingTemplate())->create([
                'template_name' => $data['template_name'],
                'site_id' => $this->site_id,
                'fee_type' => $data['fee_type'],
                'create_time' => time(),
                'no_delivery' => $data['no_delivery'],
                'is_free_shipping' => $data['is_free_shipping']
            ]);

            $template_item = [];
            foreach ($data['area'] as $item) {
                $template_item[] = [
                    'template_id' => $create_res->template_id,
                    'site_id' => $this->site_id,
                    'city_id' => $item['city_id'],
                    'fee_type' => $data['fee_type'],
                    'snum' => round(floatval($item['snum'] ?? 0), 2),
                    'sprice' => round(floatval($item['sprice'] ?? 0), 2),
                    'xnum' => round(floatval($item['xnum'] ?? 0), 2),
                    'xprice' => round(floatval($item['xprice'] ?? 0), 2),
                    'fee_area_ids' => $item['fee_area_ids'] ?? '',
                    'fee_area_names' => $item['fee_area_names'] ?? '',
                    'no_delivery' => $data['no_delivery'],
                    'no_delivery_area_ids' => $item['no_delivery_area_ids'] ?? '',
                    'no_delivery_area_names' => $item['no_delivery_area_names'] ?? '',
                    'is_free_shipping' => $data['is_free_shipping'],
                    'free_shipping_area_ids' => $item['free_shipping_area_ids'] ?? '',
                    'free_shipping_area_names' => $item['free_shipping_area_names'] ?? '',
                    'free_shipping_price' => $item['free_shipping_price'] ?? 0,
                    'free_shipping_num' => $item['free_shipping_num'] ?? 0,
                ];
            }
            (new ShippingTemplateItem())->saveAll($template_item);

            Db::commit();
            return $create_res->template_id;
        } catch (\Exception $e) {
            Db::rollback();
            throw new CommonException($e->getMessage());
        }
    }


    /**
     * 删除运费模板
     * @param int $template_id
     * @return true
     */
    public function delete(int $template_id)
    {
        if ((new Goods())->where([['delivery_template_id', '=', $template_id]])->count()) throw new CommonException('SHIPPING_TEMPLATE_IN_USE');
        (new ShippingTemplate())->where(['template_id' => $template_id, 'site_id' => $this->site_id])->delete();
        (new ShippingTemplateItem())->where(['template_id' => $template_id, 'site_id' => $this->site_id])->delete();
        return true;
    }

    /**
     * 查询运费模板列表
     * @param array $where
     * @return array
     */
    public function getPage(array $where)
    {
        $field = 'template_id, template_name, fee_type, create_time, no_delivery, is_free_shipping';
        $search_model = (new ShippingTemplate())->where([['site_id', '=', $this->site_id]])->withSearch(['template_name'], $where)->field($field)->order('create_time desc')->append(['fee_type_name']);
        $list = $this->pageQuery($search_model);
        return $list;
    }

    /**
     * 获取运费模板列表
     * @param array $where
     * @param string $field
     * @return array
     */
    public function getList(array $where = [], $field = 'template_id, template_name, fee_type, create_time, no_delivery, is_free_shipping')
    {
        $order = "create_time desc";
        return (new ShippingTemplate())->where([['site_id', '=', $this->site_id]])->withSearch(["template_name"], $where)->field($field)->order($order)->select()->toArray();
    }

    /**
     * 查询运费模板详情
     * @return array
     */
    public function getInfo(int $template_id)
    {
        $field = 'template_id, template_name, fee_type, create_time, no_delivery, is_free_shipping';
        $detail = (new ShippingTemplate())->where([['template_id', '=', $template_id], ['site_id', '=', $this->site_id]])->field($field)->append(['fee_type_name'])->findOrEmpty()->toArray();
        if (!empty($detail)) {
            $detail['fee_data'] = (new ShippingTemplateItem())->where([['template_id', '=', $template_id], ['fee_area_ids', '<>', '']])->field('fee_area_ids as area_ids,fee_area_names,snum,sprice,xnum,xprice')->group('fee_area_ids')->select()->toArray();
            $detail['no_delivery_data'] = (new ShippingTemplateItem())->where([['template_id', '=', $template_id], ['no_delivery_area_ids', '<>', '']])->field('no_delivery_area_ids as area_ids,no_delivery_area_names')->group('no_delivery_area_ids')->select()->toArray();
            $detail['free_shipping_data'] = (new ShippingTemplateItem())->where([['template_id', '=', $template_id], ['free_shipping_area_ids', '<>', '']])->field('free_shipping_area_ids as area_ids,free_shipping_area_names,free_shipping_price,free_shipping_num')->group('free_shipping_area_ids')->select()->toArray();
        }
        return $detail;
    }

    /**
     * 查询运费模板详情
     * @return array
     */
    public function getSiteInfo(int $site_id)
    {
        $field = 'template_id, template_name, fee_type, create_time';
        $detail = (new PriceTemplate())->where([['site_id', '=', $site_id]])->field($field)->append(['fee_type_name'])->findOrEmpty()->toArray();


        $template_id=$detail['template_id'];

        if (!empty($detail)) {
        $detail['fee_data'] = (new PriceTemplateItem())
            ->alias('pti')
            ->join('fengchao_delivery_company c', 'pti.company_id = c.company_id')
            ->where([['pti.template_id', '=', $detail['template_id']]])
            ->field('pti.item_id,pti.company_id, pti.snum, pti.sprice, pti.xnum, pti.xprice, pti.spercent, pti.xpercent, c.company_name,c.express_no')
            ->select()
            ->toArray();
    }
        return $detail;
    }

    /**
     * 编辑运费模板
     * @param array $data
     * @return true
     */
    public function edit(int $template_id, array $data)
    {
        Db::startTrans();

        $site_id = $data["site_id"];

        try {
            (new PriceTemplate())->update([
                'template_name' => $data['template_name'],
                'fee_type' => $data['fee_type'],
                'update_time' => time(),

            ], ['template_id' => $template_id, 'site_id' => $site_id]);

            (new PriceTemplateItem())->where(['template_id' => $template_id, 'site_id' => $site_id])->delete();
            $template_item = [];
            foreach ($data['companys'] as $item) {
                $template_item[] = [
                    'template_id' => $template_id,
                    'site_id' => $site_id,
                    'company_id' => $item['company_id'],
                    'fee_type' => $data['fee_type'],
                    'sprice' => round(floatval($item['sprice'] ?? 0), 2),
                    'xprice' => round(floatval($item['xprice'] ?? 0), 2),
                ];
            }
            (new PriceTemplateItem())->saveAll($template_item);

            Db::commit();
            return true;
        } catch (\Exception $e) {
            Db::rollback();
            throw new CommonException($e->getMessage());
        }
    }
    public function initPriceTemplate(int $site_id)
    {
        Db::startTrans();

        $companys=(new CompanyService())->getAllList();
        try {
            $create_res = (new PriceTemplate())->create([
                'template_name' => $site_id."_运费模板",
                'site_id' => $site_id,
                'fee_type' => 1,
                'create_time' => time(),
            ]);

            $template_item = [];
            foreach ($companys as $item) {
                $template_item[] = [
                    'template_id' => $create_res->template_id,
                    'site_id' => $this->site_id,
                    'company_id' => $item['company_id'],
                    'fee_type' =>1,
                    'snum' => round(floatval($item['snum'] ?? 0), 2),
                    'sprice' => round(floatval($item['sprice'] ?? 0), 2),
                    'xnum' => round(floatval($item['xnum'] ?? 0), 2),
                    'xprice' => round(floatval($item['xprice'] ?? 0), 2),
                    'spercent' => round(floatval($item['xprice'] ?? 0), 2),
                    'xpercent' => round(floatval($item['xprice'] ?? 0), 2),

                ];
            }
            (new PriceTemplateItem())->saveAll($template_item);

            Db::commit();
            return $create_res->template_id;
        } catch (\Exception $e) {
            Db::rollback();
            throw new CommonException($e->getMessage());
        }
    }


    public function setSiteFeePrice(int $site_id)
    {
        $field = 'template_id, template_name, fee_type, create_time';
        $detail = (new PriceTemplate())->where([['site_id', '=', $site_id]])->field($field)->append(['fee_type_name'])->findOrEmpty()->toArray();


        $template_id=$detail['template_id'];

        if (!empty($detail)) {
            $detail['fee_data'] = (new PriceTemplateItem())
                ->alias('pti')
                ->join('fengchao_delivery_company c', 'pti.company_id = c.company_id')
                ->where([['pti.template_id', '=', $detail['template_id']]])
                ->field('pti.item_id,pti.company_id, pti.snum, pti.sprice, pti.xnum, pti.xprice, pti.spercent, pti.xpercent, c.company_name,c.express_no')
                ->select()
                ->toArray();
        }
        return $detail;
    }
}
