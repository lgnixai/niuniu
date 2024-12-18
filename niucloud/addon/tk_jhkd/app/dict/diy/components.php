<?php

return [
    'JHKD' => [
        'title' => '聚合快递',
        'list' => [
            'Jhkd' => [
                'title' => '下单组件',
                'icon' => 'tk_jhkd jhkd-kuaidi1',
                'path' => 'edit-jhkd', // 编辑组件属性名称
                'support_page' => [], // 支持页面
                'uses' => 1, // 最大添加数量
                'sort' => 10001,
                'value' => [
                    "songbackground"=>"#4541c7",
                    "btbackground"=>"#4541c7",
                    "btfontcolor"=>"#ffffff",
                    "btname"=>"去下单",
                    "qsfontcolor"=>"#030307",
                    "slfontcolor"=>"#a9a9a9",
                    "padding"=>"12",
                ]
            ],
            'Brand' => [
                'title' => '快递列表',
                'icon' => 'tk_jhkd jhkd-kuaidi2',
                'path' => 'edit-jhkdbrand', // 编辑组件属性名称
                'support_page' => [], // 支持页面
                'uses' => 0, // 最大添加数量
                'sort' => 10001,
                'value' => [
                    "iconsize"=>"24",
                    "radiussize"=>"100",
                    "padding"=>"12",
                    "mrsize"=>"4"
                ]
            ],
        ],
    ],

];

