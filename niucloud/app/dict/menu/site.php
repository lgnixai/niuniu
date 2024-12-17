<?php
return [

    [
        'menu_name' => '数据导出',
        'menu_key' => 'setting_export',
        'menu_short_name' => '数据导出',
        'menu_type' => '1',
        'icon' => 'element FolderChecked',
        'api_url' => 'sys/export',
        'router_path' => 'setting/export',
        'view_path' => 'setting/export',
        'methods' => 'get',
        'sort' => '98',
        'status' => '1',
        'is_show' => '1',
        'children' => [
            [
                'menu_name' => '删除报表',
                'menu_key' => 'delete_export',
                'menu_short_name' => '删除报表',
                'menu_type' => '2',
                'icon' => '',
                'api_url' => 'sys/export/<id>',
                'router_path' => '',
                'view_path' => '',
                'methods' => 'delete',
                'sort' => '100',
                'status' => '1',
                'is_show' => '1',
            ]
        ]
    ],
];
