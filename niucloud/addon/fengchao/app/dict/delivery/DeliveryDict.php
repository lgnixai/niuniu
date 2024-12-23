<?php

namespace addon\fengchao\app\dict\delivery;

use app\dict\pay\PayDict;

/**
 *订单相关枚举类
 */
class DeliveryDict
{
    public const KDNIAO = 'kdniao';
    public  const YUNJIE = 'yunjie';
     public static function getType()
    {
        return [
            self::KDNIAO => [
                'key'=>350238,
                "secret"=>"082bff05-66ba-46b3-ae64-804c7cff990c",
                "url"=> "http://183.62.170.46:8081/api/dist"
            ],
            self::YUNJIE => [
                'key'=>25532,
                "secret"=>"OGZIiMjhmNDFkNTExMGMzNzNlNzI5NzY1NTdjZTM2YTk",
                "url"=> ""
            ],
        ];
    }
}
