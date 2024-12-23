<?php

return  [
    [
        'menu_name' => 'fcbox',
        'menu_key' => 'fcbox',
        'menu_type' => 0,
        'icon' => '',
        'api_url' => '',
        'router_path' => '',
        'view_path' => '',
        'methods' => '',
        'sort' => 100,
        'status' => 1,
        'is_show' => 1,
        'children' => [
            [
                'menu_name' => 'fcbox',
                'menu_key' => 'fcbox_hello_world',
                'menu_type' => 1,
                'icon' => '',
                'api_url' => 'fcbox/hello_world',
                'router_path' => 'fcbox/hello_world',
                'view_path' => 'hello_world/index',
                'methods' => 'get',
                'sort' => 100,
                'status' => 1,
                'is_show' => 1,
                'children' => []
            ],
        ]
    ]
];
