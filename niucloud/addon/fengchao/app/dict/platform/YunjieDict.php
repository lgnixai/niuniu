<?php

namespace addon\fengchao\app\dict\platform;

class YunjieDict
{
    public function getType()
    {
        $data = [
            'yunjie' => [
                "is_use"=>'启用',
                "type" => 'yunjie',
                "name" => "云杰",
                "desc" => "云杰开放平台对接",
                //配置参数
                'params' => [
                    "is_use"=>'启用',//必须
                    'appid' => '账户ID',
                    'appkey' => '密钥',
                ],
                'component' => '/src/addon/fengchao/views/platform/components/yunjie.vue',//前端配置信息定义文件
               ]
            ];
        return $data;
    }
}