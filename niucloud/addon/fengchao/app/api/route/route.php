<?php

use app\api\middleware\ApiChannel;
use app\api\middleware\ApiCheckToken;
use addon\fengchao\app\api\middleware\ApiCheckSign;
use addon\fengchao\app\api\middleware\CallBackCheckSign;
use app\api\middleware\ApiLog;
use think\facade\Route;


/***************************************************** 对外api ****************************************************/
//主网api
Route::group('v1', function() {

    // 退款方式
    Route::post('order', 'addon\fengchao\app\api\controller\express\Express@order');

    Route::post('callbackurl', 'addon\fengchao\app\api\controller\express\Express@notify');

})
    ->middleware(ApiCheckSign::class)
    ->middleware(ApiLog::class);

Route::group('v1', function() {


    //快递鸟回调通知
    Route::post('kdniaonotice', 'addon\fengchao\app\api\controller\order\Order@kdniaoNotice');
    //云杰回调通知
    Route::post('yunjienotice', 'addon\fengchao\app\api\controller\order\Order@yunjieNotice');

}) ->middleware(ApiLog::class);
 
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
    Route::get('load', 'addon\fengchao\app\api\controller\test\Load@index');

});
