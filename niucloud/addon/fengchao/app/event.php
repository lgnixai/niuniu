<?php

return [
    'bind' => [

    ],
    'listen' => [
        // 站点创建之后
        'AddSiteAfter' => [ 'addon\fengchao\app\listener\AddSiteAfterListener' ],

        //导出数据类型
        'ExportDataType' => [
            'addon\fengchao\app\listener\export\BalanceExportTypeListener',

            //订单列表导出
            'addon\fengchao\app\listener\export\OrderExportTypeListener',
            //订单项导出

        ],
            //导出数据源
        'ExportData' => [
            //订单列表导出
            'addon\fengchao\app\listener\export\OrderExportDataListener',
            //费用变化列表导出
            'addon\fengchao\app\listener\export\BalanceExportDataListener',

        ],
        //订单创建后
        'AfterOrderCreate' => [
            'addon\fengchao\app\listener\order\AfterOrderCreate',
            //'addon\fengchao\app\listener\point_exchange\AfterfengchaoOrderCreate',   //积分商城业务
        ],

        //订单创建
        'PayCreate' => ['addon\fengchao\app\listener\pay\PayCreateListener'],


        //支付成功
        'PaySuccess' => ['addon\fengchao\app\listener\pay\PaySuccessListener'],

        // 收到快递推送
        'ListenNotifyAfter' => [
            'addon\fengchao\app\listener\express\ListenNotifyAfter'
        ],

        'OrderPriceConfirmAfter' => [
            'addon\fengchao\app\listener\express\OrderPriceConfirmAfter'
        ],




//        //订单支付后
//        'AfterfengchaoOrderPay' => [ 'addon\fengchao\app\listener\order\AfterfengchaoOrderPay' ],
//        //订单发货后
//        'AfterfengchaoOrderDelivery' => [ 'addon\fengchao\app\listener\order\AfterfengchaoOrderDelivery' ],
//        //订单收货后
//        'AfterfengchaoOrderFinish' => [ 'addon\fengchao\app\listener\order\AfterfengchaoOrderFinish' ],
//        //订单编辑价格后
//        'AfterfengchaoOrderEditPrice' => [ 'addon\fengchao\app\listener\order\AfterfengchaoOrderEditPrice' ],
//        //订单关闭后
//        'AfterfengchaoOrderClose' => [
//            'addon\fengchao\app\listener\order\AfterfengchaoOrderClose',
//            'addon\fengchao\app\listener\point_exchange\AfterfengchaoOrderClose',   //积分商城业务
//        ],
//        //活动信息
//        'fengchaoGoodsMarketCalculate' => [
//            'addon\fengchao\app\listener\marketing\fengchaoDiscountCalculate',   //限时折扣
//            'addon\fengchao\app\listener\marketing\fengchaoNewcomerCalculate'   //新人专享
//        ],
//        /***************************************************** 退款 start *****************************************************/
//        'AfterfengchaoOrderRefundApply' => [ 'addon\fengchao\app\listener\refund\AfterfengchaoOrderRefundApply' ],
//        'AfterfengchaoOrderRefundAuditApply' => [ 'addon\fengchao\app\listener\refund\AfterfengchaoOrderRefundAuditApply' ],
//        'AfterfengchaoOrderRefundAuditRefundGoods' => [ 'addon\fengchao\app\listener\refund\AfterfengchaoOrderRefundAuditRefundGoods' ],
//        'AfterfengchaoOrderRefundClose' => [ 'addon\fengchao\app\listener\refund\AfterfengchaoOrderRefundClose' ],
//        'AfterfengchaoOrderRefundDelivery' => [ 'addon\fengchao\app\listener\refund\AfterfengchaoOrderRefundDelivery' ],
//        'AfterfengchaoOrderRefundEdit' => [ 'addon\fengchao\app\listener\refund\AfterfengchaoOrderRefundEdit' ],
//        'AfterfengchaoOrderRefundEditDelivery' => [ 'addon\fengchao\app\listener\refund\AfterfengchaoOrderRefundEditDelivery' ],
//        'AfterfengchaoOrderRefundFinish' => [ 'addon\fengchao\app\listener\refund\AfterfengchaoOrderRefundFinish' ],
//        /***************************************************** 退款 end *****************************************************/
//
//        'fengchaoPromotion' => [ 'addon\fengchao\app\listener\app\fengchaoPromotionListener' ],
//        'WapIndex' => [ 'addon\fengchao\app\listener\WapIndexListener' ],
//        'BottomNavigation' => [ 'addon\fengchao\app\listener\BottomNavigationListener' ],
//
//        //支付
//        'PayCreate' => [ 'addon\fengchao\app\listener\pay\PayCreateListener' ],
//        'PaySuccess' => [ 'addon\fengchao\app\listener\pay\PaySuccessListener' ],
//        'RefundSuccess' => [ 'addon\fengchao\app\listener\pay\RefundSuccessListener' ],
//
//        'NoticeData' => [
//            'addon\fengchao\app\listener\notice_template\OrderPay',
//            'addon\fengchao\app\listener\notice_template\OrderPayRemind',
//            'addon\fengchao\app\listener\notice_template\OrderDelivery',
//            'addon\fengchao\app\listener\notice_template\RefundAgree',
//            'addon\fengchao\app\listener\notice_template\RefundRefuse',
//        ],
//        //优惠券
//        'CouponReceiveType' => [ 'addon\fengchao\app\listener\coupon\CouponReceiveListener' ],
//        'CouponCheck' => [ 'addon\fengchao\app\listener\coupon\CouponCheckListener' ],
//
//
//        //获取海报数据
//        'GetPosterType' => [ 'addon\fengchao\app\listener\poster\fengchaoPosterType' ],
//        'GetPosterData' => [ 'addon\fengchao\app\listener\poster\fengchaoPoster' ],
//
//        //导出数据类型
//        'ExportDataType' => [
//            //订单列表导出
//            'addon\fengchao\app\listener\order_export\fengchaoOrderExportTypeListener',
//            //订单项导出
//            'addon\fengchao\app\listener\order_export\fengchaoOrderGoodsExportTypeListener',
//            //退款维权导出
//            'addon\fengchao\app\listener\refund_export\fengchaoOrderRefundExportTypeListener',
//            //发票列表导出
//            'addon\fengchao\app\listener\order_export\fengchaoInvoiceExportTypeListener',
//        ],
//        //导出数据源
//        'ExportData' => [
//            //订单列表导出
//            'addon\fengchao\app\listener\order_export\fengchaoOrderExportDataListener',
//            //订单项导出
//            'addon\fengchao\app\listener\order_export\fengchaoOrderGoodsExportDataListener',
//            //退款维权导出
//            'addon\fengchao\app\listener\refund_export\fengchaoOrderRefundExportDataListener',
//            //发票列表导出
//            'addon\fengchao\app\listener\order_export\fengchaoInvoiceExportDataListener',
//        ],
//        //商城统计执行
//        'StatExecute' => [ 'addon\fengchao\app\listener\stat\StatExecuteListener' ],
//        //商城统计字段
//        'StatField' => [ 'addon\fengchao\app\listener\stat\StatFieldListener' ],
//        //核销
//        'VerifyType' => [ 'addon\fengchao\app\listener\verify\VerifyTypeListener' ],
//        'VerifyCreate' => [ 'addon\fengchao\app\listener\verify\VerifyCreateListener' ],
//        'Verify' => [ 'addon\fengchao\app\listener\verify\VerifyListener' ],
//        'VerifyInfo' => [ 'addon\fengchao\app\listener\verify\VerifyInfoListener' ],
//
//        'ActiveStartAfter' => [
//            'addon\fengchao\app\listener\marketing\DiscountActiveStartAfter'
//        ],
//
//        'ActiveEndAfter' => [
//            'addon\fengchao\app\listener\marketing\DiscountActiveEndAfter'
//        ],
//        //通过支付信息获取手机端订单详情路径
//        'WapOrderDetailPath' => [
//            'addon\fengchao\app\listener\order\WapOrderDetailPathListener',
//        ],
//
//        'PrinterContent' => [
//            'addon\fengchao\app\listener\printer\PrinterContentListener'
//        ],
//
//        //新人专享
//        'NewcomerActiveJoin' => [ 'addon\fengchao\app\listener\marketing\NewcomerActiveJoinListener' ],
//        //会员登录后事件
//        'MemberLoginAfter' => [ 'addon\fengchao\app\listener\MemberLoginAfterListener' ],
//
        ],
    'subscribe' => [
    ],
];
