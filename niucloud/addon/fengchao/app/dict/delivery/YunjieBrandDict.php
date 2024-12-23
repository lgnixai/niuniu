<?php

namespace addon\fengchao\app\dict\delivery;

/**
 * 辛达快递品牌枚举
 */
class YunjieBrandDict
{

    public static function getBrand($brand=null)
    {
        $data=[
            'JD'=> [
                'name' => '圆通速递',
                'logo' => 'addon/fengchao/logo/yt.png'
            ],
        ];
        if ($brand == null || !isset($data[$brand])) {
            return ['logo' => '','name'=>$brand];
        }
        return $data[$brand];
    }

}