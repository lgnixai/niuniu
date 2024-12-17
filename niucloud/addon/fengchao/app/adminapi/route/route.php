<?php

use app\adminapi\middleware\AdminCheckRole;
use app\adminapi\middleware\AdminCheckToken;
use app\adminapi\middleware\AdminLog;
use think\facade\Route;
//
///**
// * 商城系统
// */
////暂时为测试用
//Route::group('api', function () {
//    Route::get('company', 'addon\fengchao\app\adminapi\controller\api\Company@all');
//    Route::get('createApiKey', 'addon\fengchao\app\adminapi\controller\api\token@createApiKey');
//    Route::get('getApiKey', 'addon\fengchao\app\adminapi\controller\api\token@getApiKey');
//
//});
//
//
//Route::group('v1', function () {
//
//    // 退款方式
//    Route::post('order', 'addon\fengchao\app\api\controller\express\order@create');
//    Route::get('order', 'addon\fengchao\app\api\controller\express\order@get');
//
//})->middleware(\addon\fengchao\app\api\middleware\ApiCheckSign::class)
//    ->middleware(\app\api\middleware\ApiLog::class);
//
///**沙盒环境**/
//Route::group('sandbox', function () {
//
//    // 退款方式
//    Route::post('order', 'addon\fengchao\app\adminapi\controller\sandbox\SandBox@create');
//
//})->middleware(\addon\fengchao\app\api\middleware\ApiCheckSign::class)
//    ->middleware(\app\api\middleware\ApiLog::class);


Route::group('fengchao', function () {
    Route::post('line/price', 'addon\fengchao\app\adminapi\controller\site\LinePrice@add');
    Route::post('site/line/price', 'addon\fengchao\app\adminapi\controller\site\LinePrice@getBySiteId');

    Route::get('delivery/company/all', 'addon\fengchao\app\adminapi\controller\delivery\Company@all');
    Route::get('channel/all', 'addon\fengchao\app\adminapi\controller\site\Channel@all');



    //会员余额流水
    Route::get('site/balance', 'addon\fengchao\app\adminapi\controller\site\Balance@siteBalanceList');
    Route::post('site/balance/adjust', 'addon\fengchao\app\adminapi\controller\site\Balance@adjustBalance');
    Route::get('site/price/template/site/:site_id', 'addon\fengchao\app\adminapi\controller\site\PriceTemplate@site_info');
    Route::put('site/price/template/:template_id', 'addon\fengchao\app\adminapi\controller\site\PriceTemplate@edit');



    //网站端相关
    Route::get('site/api/domain', 'addon\fengchao\app\adminapi\controller\api\Api@domain');
    Route::get('site/api/notifyUrl', 'addon\fengchao\app\adminapi\controller\api\Api@notifyUrl');

    Route::get('site/api/list', 'addon\fengchao\app\adminapi\controller\api\Api@lists');
    Route::get('site/api/createNewApi', 'addon\fengchao\app\adminapi\controller\api\Api@createNewApi');
    Route::get('site/api/getApi/:id', 'addon\fengchao\app\adminapi\controller\api\Api@info');
    Route::post('site/api/add', 'addon\fengchao\app\adminapi\controller\api\Api@add');
    Route::delete('site/api/:id', 'addon\fengchao\app\adminapi\controller\api\Api@del');
    Route::get('site/allBalance', 'addon\fengchao\app\adminapi\controller\site\Balance@siteBalanceList');
    Route::get('site/siteBalance', 'addon\fengchao\app\adminapi\controller\site\Balance@BalanceBySiteList');
    Route::get('site/siteBalanceSum', 'addon\fengchao\app\adminapi\controller\site\Balance@BalanceSum');
    Route::post('site/api/sandbox', 'addon\fengchao\app\adminapi\controller\sandbox\SandBox@kuaidiniao');


    //订单列表
    Route::get('order/list', 'addon\fengchao\app\adminapi\controller\order\Order@lists');

    //订单详情
    Route::get('order/detail/:id', 'addon\fengchao\app\adminapi\controller\order\Order@detail');


    Route::get('sandbox/fake/list', 'addon\fengchao\app\adminapi\controller\sandbox\FakeData@list');
    Route::get('sandbox/fake/:id', 'addon\fengchao\app\adminapi\controller\sandbox\FakeData@fake');



    /************************************************** 配送相关接口 *****************************************************/
    //物流公司 分页列表
    Route::get('delivery/company', 'addon\fengchao\app\adminapi\controller\delivery\Company@pages');
    Route::post('delivery/company/init', 'addon\fengchao\app\adminapi\controller\delivery\Company@init');

    //物流公司 列表
    Route::get('delivery/company/list', 'addon\fengchao\app\adminapi\controller\delivery\Company@lists');

    //物流公司 详情
    Route::get('delivery/company/:id', 'addon\fengchao\app\adminapi\controller\delivery\Company@info');

    //物流公司 添加
    Route::post('delivery/company', 'addon\fengchao\app\adminapi\controller\delivery\Company@add');

    //物流公司 编辑
    Route::put('delivery/company/:id', 'addon\fengchao\app\adminapi\controller\delivery\Company@edit');

    //物流公司 删除
    Route::delete('delivery/company/:id', 'addon\fengchao\app\adminapi\controller\delivery\Company@del');


})->middleware([
    AdminCheckToken::class,
    AdminCheckRole::class,
    AdminLog::class
]);
// 沙盒提供模拟数据

Route::group('sandbox', function() {
    Route::get('fake/list', 'addon\fengchao\app\adminapi\controller\sandbox\FakeData@list');
    Route::get('fake/:site_id/:id', 'addon\fengchao\app\adminapi\controller\sandbox\FakeData@fake');

});

Route::group('sandbox', function() {
    Route::get('cb/list', 'addon\fengchao\app\adminapi\controller\sandbox\CallBack@list');
    Route::get('cb/:site_id/:id', 'addon\fengchao\app\adminapi\controller\sandbox\CallBack@fake');

});