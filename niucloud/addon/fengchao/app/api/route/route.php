<?php
// +----------------------------------------------------------------------
// | Niucloud-admin 企业快速开发的多应用管理平台
// +----------------------------------------------------------------------
// | 官方网址：https://www.niucloud.com
// +----------------------------------------------------------------------
// | niucloud团队 版权所有 开源版本可自由商用
// +----------------------------------------------------------------------
// | Author: Niucloud Team
// +----------------------------------------------------------------------

use app\api\middleware\ApiChannel;
use app\api\middleware\ApiCheckToken;
use addon\fengchao\app\api\middleware\ApiCheckSign;
use addon\fengchao\app\api\middleware\CallBackCheckSign;
use app\api\middleware\ApiLog;
use think\facade\Route;


/**
 * 商城系统
 */
Route::group('fengchao', function() {



})->middleware(ApiChannel::class)
    ->middleware(ApiCheckToken::class, true)//表示验证登录
    ->middleware(ApiLog::class);

/***************************************************** 对外api ****************************************************/
//主网api
Route::group('v1', function() {

    // 退款方式
    Route::post('order', 'addon\fengchao\app\api\controller\express\Express@order');
    Route::post('callbackurl', 'addon\fengchao\app\api\controller\express\Express@notify');

})
    ->middleware(ApiCheckSign::class)
    ->middleware(ApiLog::class);
 
//阿里云对队调用
Route::group('express', function() {
    Route::post('callback', 'addon\fengchao\app\api\controller\express\Alimq@notify');

})->middleware(\addon\fengchao\app\api\middleware\AliCallBackCheckSign::class)
 ->middleware(ApiLog::class);

Route::group('client', function() {
    Route::post('callback', 'addon\fengchao\app\api\controller\client\Client@notify');
});

Route::group('express', function() {
     Route::post('test', 'addon\fengchao\app\api\controller\test\Express@notify');

 })->middleware(\addon\fengchao\app\api\middleware\TestCheckSign::class);



Route::group('test', function() {

    Route::post('lark', 'addon\fengchao\app\api\controller\client\Dev@domain');

});
