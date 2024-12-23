<?php

namespace addon\fengchao\app\dict\delivery;

use app\dict\pay\PayDict;

/**
 * 快递鸟快递品牌
 */
class KdniaoBrandDict
{

    public static function getBrand($brand=null)
    {
        $data=[
            'YTO'=> [
                'name' => '圆通速递',
                'logo' => 'addon/fengchao/logo/yt.png'
            ],
            'STO'=>[
                'name' => '申通快递',
                'logo' => 'addon/fengchao/logo/st.png'
            ],

            'JTSD'=> [
                'name' => '极兔速递',
                'logo' => 'addon/fengchao/logo/jt.png'
            ],
            'ZTO'=>[
                'name' => '中通快递',
                'logo' => 'addon/fengchao/logo/zt.png'
            ],
            'YD'=>[
                'name' => '韵达速递',
                'logo' => 'addon/fengchao/logo/yd.png'
            ],


        ];
        if ($brand == null || !isset($data[$brand])) {
            return ['logo' => '','name'=>$brand];
        }
        return $data[$brand];
    }

}