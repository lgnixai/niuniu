<?php

return [
    'common_validate' => [
        'mobile' => '手机号格式有误',
        'email' => '邮箱格式有误',
        'url' => 'URL格式不正确',
        'required' => ':attribute 必须填写',
        'max' => ':attribute 长度不能超过:max个字符',
        'integer' => ':attribute 必须为整数',
        'float' => ':attribute 必须为浮点数',
        'array' => ':attribute 必须为数组',
        'date' => ':attribute 必须为有效的日期',
        'regex' => ':attribute 格式不正确',
        'gt' => ':attribute 必须大于:rule',
        'gte' => ':attribute 必须大于等于:rule',
        'lte' => ':attribute 必须小于等于:rule',
        'lt' => ':attribute 必须小于:rule',
        'json' => ':attribute 必须为合法的 JSON 字符串',
    ],
    'validate_api' => [

        'business_id_require' => '商户Id必须填写',
        'request_data_require' => '请求数据必须填写',
        'request_data_json' => '请求数据必须是json格式',
        'request_data_json_error' => '请求数据json格式有误',
        'request_data_json_error_array' => '请求数据json格式有误，请检查数据类型',
        'request_type_require' => '请求接口指令必须填写',
        'data_type_require' => '数据类型必须填写',
        'data_sign_require' => '数据签名必须填写',


        // 运输类型
        'transport_type_require' => '运输类型不能为空',
        'transport_type_invalid' => '运输类型不合法',

        // 发货人类型
        'shipper_type_require' => '发货人类型不能为空',
        'shipper_type_invalid' => '发货人类型不合法',

        // 快递公司编码
        'shipper_code_require' => '快递公司编码不能为空',

        // 商家订单编号
        'order_code_require' => '商家订单编号不能为空',
        'order_code_max' => '商家订单编号长度不能超过50个字符',

        // 快递类型
        'exp_type_require' => '快递类型不能为空',
        'exp_type_invalid' => '快递类型不合法',

        // 支付方式
        'pay_type_require' => '支付方式不能为空',
        'pay_type_invalid' => '支付方式不合法',

        // 收件人信息
        'receiver_require' => '收件人信息不能为空',
        'receiver_province_require' => '收件人省份不能为空',
        'receiver_city_require' => '收件人城市不能为空',
        'receiver_area_require' => '收件人区域不能为空',
        'receiver_address_require' => '收件人详细地址不能为空',
        'receiver_name_require' => '收件人姓名不能为空',
        'receiver_name_max' => '收件人姓名不能超过30个字符',
        'receiver_mobile_require' => '收件人手机号不能为空',
        'receiver_mobile_invalid' => '收件人手机号格式不正确',

        // 发件人信息
        'sender_require' => '发件人信息不能为空',
        'sender_province_require' => '发件人省份不能为空',
        'sender_city_require' => '发件人城市不能为空',
        'sender_area_require' => '发件人区域不能为空',
        'sender_address_require' => '发件人详细地址不能为空',
        'sender_name_require' => '发件人姓名不能为空',
        'sender_name_max' => '发件人姓名不能超过30个字符',
        'sender_mobile_require' => '发件人手机号不能为空',
        'sender_mobile_invalid' => '发件人手机号格式不正确',

        // 日期格式
        'start_date_require' => '开始时间不能为空',
        'start_date_invalid' => '开始时间格式不正确',
        'end_date_require' => '结束时间不能为空',
        'end_date_invalid' => '结束时间格式不正确',
        'end_date_after_start' => '结束时间必须晚于开始时间',

        // 重量、数量等数值字段
        'weight_require' => '重量不能为空',
        'weight_invalid' => '重量必须为有效的数值',
        'weight_gt_zero' => '重量必须大于0',
        'quantity_require' => '数量不能为空',
        'quantity_equal' => '包裹数量必须等于1', // 添加数量等于1的错误提示

        // 商品信息字段
        'commodity_require' => '商品信息不能为空',
        'commodity_invalid' => '商品信息格式不正确',
        'commodity_category_require' => '商品分类编码不能为空',
        'commodity_goods_name_require' => '商品名称不能为空',
        'commodity_goods_code_require' => '商品编码不能为空',
        'commodity_goods_quantity_require' => '商品数量不能为空',
        'commodity_goods_price_require' => '商品价格不能为空',
        'commodity_goods_price_invalid' => '商品价格必须为有效的数值',
        'commodity_goods_weight_require' => '商品重量不能为空',
        'commodity_pic_url_invalid' => '商品图片链接必须为合法的 URL',

        // 支付与保价金额
        'payment_amount_require' => '实际支付金额不能为空',
        'payment_amount_invalid' => '实际支付金额必须为有效的数值',
        'insure_amount_require' => '保价金额不能为空',
        'insure_amount_invalid' => '保价金额必须为有效的数值',


    ],
];
