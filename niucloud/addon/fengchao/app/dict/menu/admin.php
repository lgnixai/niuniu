<?php
return [
    [
        'menu_name' => '快递管理',
        'menu_key' => 'fengchao_order',
        'menu_short_name' => '快递',
        'parent_key' => '',
        'menu_type' => '0',
        'icon' => 'iconfont iconshangpinguanli',
        'api_url' => '',
        'router_path' => '',
        'view_path' => '',
        'methods' => 'get',
        'sort' => '80',
        'status' => '1',
        'is_show' => '1',
        'children' => [
            [
                'menu_name' => '站点管理',
                'menu_key' => 'price_fee_list',
                'menu_short_name' => '站点管理',
                'menu_type' => '1',
                'icon' => 'element OfficeBuilding',
                'api_url' => 'fengchao/site',
                'router_path' => 'fengchao/site/list',
                'view_path' => 'site/list',
                'methods' => 'get',
                'sort' => '0',
                'status' => '1',
                'is_show' => '1',
                'children' => [
                    [
                        'menu_name' => '编辑价格',
                        'menu_key' => 'edit_price_fee',
                        'menu_short_name' => '编辑价格',
                        'menu_type' => '2',
                        'icon' => '',
                        'api_url' => 'fengchao/site/site/<id>',
                        'router_path' => '',
                        'view_path' => '',
                        'methods' => 'put',
                        'sort' => '0',
                        'status' => '1',
                        'is_show' => '1',
                    ],
                ],
            ],
            [
                'menu_name' => '站点余额',
                'menu_key' => 'site_balance',
                'menu_short_name' => '站点余额',
                'menu_type' => '1',
                'icon' => 'element Money',
                'api_url' => 'fengchao/balance/balance',
                'router_path' => 'fengchao/balance/balance',
                'view_path' => 'balance/balance',
                'methods' => 'get',
                'sort' => '0',
                'status' => '1',
                'is_show' => '1',
            ],
            [
                'menu_name' => '运费模版添加/编辑',
                'menu_key' => 'fengchao_config_delivery_shipping_template_add_edit',
                'menu_short_name' => '运费模版添加/编辑',
                'menu_type' => '1',
                'icon' => '',
                'api_url' => '',
                'router_path' => 'fengchao/site/price/template_edit',
                'view_path' => 'site/price/import',
                'methods' => 'get',
                'sort' => '0',
                'status' => '1',
                'is_show' => '0',
            ],
            [
                'menu_name' => '查看运费',
                'menu_key' => 'fengchao_config_delivery_shipping_template_view_edit',
                'menu_short_name' => '查看运费',
                'menu_type' => '1',
                'icon' => '',
                'api_url' => 'fengchao/site/price/view',
                'router_path' => 'fengchao/site/price/view',
                'view_path' => 'site/price/view',
                'methods' => 'get',
                'sort' => '0',
                'status' => '1',
                'is_show' => '0',
            ],
            [
                'menu_name' => '物流公司',
                'menu_key' => 'fengchao_config_delivery_company',
                'menu_short_name' => '物流公司',
                'menu_type' => '1',
                'icon' => '',
                'api_url' => 'fengchao/delivery/company',
                'router_path' => 'fengchao/order/delivery/company',
                'view_path' => 'delivery/company',
                'methods' => 'get',
                'sort' => '0',
                'status' => '1',
                'is_show' => '1',
                'children' => [
                    [
                        'menu_name' => '物流公司删除',
                        'menu_key' => 'fengchao_config_delivery_company_delete',
                        'menu_short_name' => '物流公司删除',
                        'menu_type' => '2',
                        'icon' => '',
                        'api_url' => 'fengchao/delivery/company/<id>',
                        'router_path' => '',
                        'view_path' => '',
                        'methods' => 'delete',
                        'sort' => '0',
                        'status' => '1',
                        'is_show' => '0',
                    ],
                ],
            ],
            [
                'menu_name' => '添加物流公司',
                'menu_key' => 'fengchao_config_delivery_company_add',
                'menu_short_name' => '添加物流公司',
                'menu_type' => '1',
                'icon' => '',
                'api_url' => 'fengchao/delivery/company',
                'router_path' => 'fengchao/order/delivery/company_add',
                'view_path' => 'delivery/company_edit',
                'methods' => 'post',
                'sort' => '0',
                'status' => '1',
                'is_show' => '0',
            ],
            [
                'menu_name' => '编辑物流公司',
                'menu_key' => 'fengchao_config_delivery_company_edit',
                'menu_short_name' => '编辑物流公司',
                'menu_type' => '1',
                'icon' => '',
                'api_url' => 'fengchao/delivery/company',
                'router_path' => 'fengchao/order/delivery/company_edit',
                'view_path' => 'delivery/company_edit',
                'methods' => 'put',
                'sort' => '0',
                'status' => '1',
                'is_show' => '0',
            ],
        ],
    ],
];