<?php

return [
    'tk_jhkd_order' => [
        'key' => 'tk_jhkd_order',
        'name' => '聚合快递下单',
        'desc' => '聚合快递订单完成后发放成长值',
        'component' => '/src/addon/tk_jhkd/views/member/components/growth-rule-jhkd.vue',
        'calculate' =>'',
        'content' => [
            'admin' => function($site_id, $config) {
                return "聚合快递订单完成后可获得{$config['growth']}成长值";
            },
            'task' => function($site_id, $config) {
                return [
                    'icon' => '/addon/tk_jhkd/rule/growth-rule-cart.png',
                    'title' => '聚合快递订单完成',
                    'desc' => "快递寄件完成后可获得{$config['growth']}成长值",
                    'button' => [
                        'text' => '去寄件',
                        'wap_redirect' => '/addon/tk_jhkd/pages/ordersubmit'
                    ]
                ];
            }
        ]
    ],

];
