<?php

namespace addon\tk_jhkd\app\listener;

use app\service\core\addon\CoreAddonService;
use app\service\core\site\CoreSiteService;

/**
 * 底部导航
 */
class BottomNavigationListener
{
    /**
     * @param array $params
     * @return array|void
     */
    public function handle($params = [])
    {
        $key = 'tk_jhkd';

        $site_addon = (new CoreSiteService())->getAddonKeysBySiteId(request()->siteId());
        if (!in_array($key, $site_addon)) return;

        if (!empty($params)&& !empty($params['key']) && $params['key'] != $key) return;

        $core_addon_service = new CoreAddonService();
        $addon_info = $core_addon_service->getAddonConfig($key);

        return [
            'key' => $key,
            'info' => $addon_info,
            'value' => [
                "backgroundColor" => "#ffffff",
                "textColor" => "#333333",
                "textHoverColor" => "#4541c7",
                "type" => 1,
                "list" => [
                    [
                        "text" => "首页",
                        "link" => [
                            "parent" =>"TK_JHKD_DIY_LINK",
                            "name" =>"TK_JHKD_DIY_INDEX",
                            "title" =>"快递首页",
                            "url" =>"/addon/tk_jhkd/pages/index",
                            "action" =>"decorate"
                        ],
                        "iconPath" => "addon/tk_jhkd/diy/tabbar/index.png",
                        "iconSelectPath" => "addon/tk_jhkd/diy/tabbar/index-select.png"
                    ],
                    [
                        "text" => "订单",
                        "link" => [
                            "parent" => "TK_JHKD_LINK",
                            "name" => "TK_JHKD_ORDERLIST",
                            "title" => "订单列表",
                            "url" => "/addon/tk_jhkd/pages/orderlist",
                            "action" => ""
                        ],
                        "iconSelectPath" => "addon/tk_jhkd/diy/tabbar/order-select.png",
                        "iconPath" => "addon/tk_jhkd/diy/tabbar/order.png"
                    ],
                    [
                        "text" => "帮助",
                        "link" => [
                            "parent" => "TK_JHKD_LINK",
                            "name" => "TK_JHKD_HELP",
                            "title" => "帮助中心",
                            "url" => "/addon/tk_jhkd/pages/help",
                            "action" => ""
                        ],
                        "iconSelectPath" => "addon/tk_jhkd/diy/tabbar/help-select.png",
                        "iconPath" => "addon/tk_jhkd/diy/tabbar/help.png"
                    ],
                    [
                        "text" => "个人",
                        "link" => [
                            "parent" => "MEMBER_LINK",
                            "name" => "MEMBER_CENTER",
                            "title" => "个人中心",
                            "url" => "/addon/tk_jhkd/pages/member",
                            "action" => "decorate"
                        ],
                        "iconSelectPath" => "addon/tk_jhkd/diy/tabbar/my-select.png",
                        "iconPath" => "addon/tk_jhkd/diy/tabbar/my.png"
                    ]
                ]
            ]
        ];


    }
}
