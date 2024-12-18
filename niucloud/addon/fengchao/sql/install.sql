-- ----------------------------
-- Table structure for fengchao_delivery_company
-- ----------------------------
DROP TABLE IF EXISTS `fengchao_delivery_company`;
CREATE TABLE `fengchao_delivery_company` (
                                             `company_id` int(11) NOT NULL AUTO_INCREMENT,
                                             `site_id` int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
                                             `company_name` varchar(255) NOT NULL DEFAULT '' COMMENT '物流公司名称',
                                             `logo` varchar(255) NOT NULL DEFAULT '' COMMENT '物流公司logo',
                                             `url` varchar(255) NOT NULL DEFAULT '' COMMENT '物流公司网站',
                                             `express_no` varchar(255) NOT NULL DEFAULT '' COMMENT '物流公司编号(用于物流跟踪)',
                                             `express_no_electronic_sheet` varchar(255) NOT NULL DEFAULT '' COMMENT '物流公司编号(用于电子面单)',
                                             `electronic_sheet_switch` tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否支持电子面单（0：不支持，1：支持）',
                                             `create_time` int(11) NOT NULL DEFAULT 0,
                                             `update_time` int(11) NOT NULL DEFAULT 0,
                                             PRIMARY KEY (`company_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for fengchao_line_price
-- ----------------------------
DROP TABLE IF EXISTS `fengchao_line_price`;
CREATE TABLE `fengchao_line_price` (
                                       `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                                       `site_id` int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
                                       `express_no` varchar(30) NOT NULL DEFAULT '' COMMENT '物流公司编号',
                                       `sender_province` varchar(30) NOT NULL DEFAULT '' COMMENT '发件省',
                                       `receive_province` varchar(30) NOT NULL DEFAULT '' COMMENT '收件省',
                                       `first_weight` decimal(10,2) NOT NULL COMMENT '首重价格',
                                       `continuous_weight` decimal(10,2) NOT NULL COMMENT '续重价格',
                                       `remark` text DEFAULT NULL COMMENT 'api_key',
                                       `delete_time` int(11) NOT NULL DEFAULT 0 COMMENT '删除时间',
                                       `create_time` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
                                       `import_no` varchar(255) DEFAULT NULL,
                                       `delivery` varchar(255) DEFAULT NULL,
                                       PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=47149 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='站点线路报价';

-- ----------------------------
-- Table structure for fengchao_line_price_log
-- ----------------------------
DROP TABLE IF EXISTS `fengchao_line_price_log`;
CREATE TABLE `fengchao_line_price_log` (
                                           `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                                           `site_id` int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
                                           `import_no` varchar(30) NOT NULL DEFAULT '' COMMENT '导入编号',
                                           `create_time` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
                                           PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='站点线路报价';

-- ----------------------------
-- Table structure for fengchao_notify_log
-- ----------------------------
DROP TABLE IF EXISTS `fengchao_notify_log`;
CREATE TABLE `fengchao_notify_log` (
                                       `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                                       `site_id` int(11) DEFAULT 0 COMMENT '站点id',
                                       `url` varchar(255) NOT NULL COMMENT '推送url',
                                       `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '业务数据',
                                       `create_time` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
                                       `status` int(11) NOT NULL DEFAULT 0 COMMENT '推送状态',
                                       PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='站点请求和回调日志';

-- ----------------------------
-- Table structure for fengchao_order
-- ----------------------------
DROP TABLE IF EXISTS `fengchao_order`;
CREATE TABLE `fengchao_order` (
                                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
                                  `site_id` int(11) NOT NULL COMMENT '站点id',
                                  `order_id` varchar(44) NOT NULL COMMENT '订单id',
                                  `order_money` decimal(10,2) DEFAULT NULL COMMENT '订单金额',
                                  `order_discount_money` decimal(10,2) DEFAULT 0.00 COMMENT '订单优惠金额',
                                  `order_add_money` decimal(10,2) DEFAULT 0.00 COMMENT '订单优惠金额',
                                  `order_status` int(11) DEFAULT 0 COMMENT '订单状态',
                                  `add_price_status` int(11) DEFAULT 0 COMMENT '补款状态',
                                  `refund_status` int(3) DEFAULT 0 COMMENT '退款状态',
                                  `out_trade_no` varchar(32) DEFAULT NULL COMMENT '支付编号',
                                  `pay_time` int(13) DEFAULT NULL COMMENT '支付时间',
                                  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
                                  `close_reason` varchar(80) DEFAULT NULL COMMENT '关闭原因',
                                  `close_time` int(11) DEFAULT NULL COMMENT '订单关闭时间',
                                  `ip` varchar(60) DEFAULT NULL COMMENT '会员ip',
                                  `update_time` int(13) DEFAULT NULL COMMENT '更新时间',
                                  `delete_time` int(13) DEFAULT 0 COMMENT '删除时间',
                                  PRIMARY KEY (`id`) USING BTREE,
                                  KEY `id` (`id`,`site_id`,`order_id`,`create_time`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='订单列表';

-- ----------------------------
-- Table structure for fengchao_order_callback_log
-- ----------------------------
DROP TABLE IF EXISTS `fengchao_order_callback_log`;
CREATE TABLE `fengchao_order_callback_log` (
                                               `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '订单唯一ID',
                                               `site_id` int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
                                               `order_id` varchar(100) NOT NULL COMMENT '商家订单编号',
                                               `state` varchar(30) NOT NULL COMMENT '状态码',
                                               `server_data` longtext NOT NULL COMMENT '服务端最终确认的信息',
                                               `create_time` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
                                               PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='站点回调日志表';

-- ----------------------------
-- Table structure for fengchao_order_delivery
-- ----------------------------
DROP TABLE IF EXISTS `fengchao_order_delivery`;
CREATE TABLE `fengchao_order_delivery` (
                                           `order_id` varchar(44) NOT NULL DEFAULT '订单id',
                                           `site_id` int(11) NOT NULL,
                                           `line_price_id` bigint(20) DEFAULT NULL,
                                           `app_id` varchar(255) DEFAULT NULL,
                                           `client_order_code` varchar(100) NOT NULL DEFAULT '下游用户订单id',
                                           `service_order_code` varchar(100) DEFAULT NULL,
                                           `logistic_order_code` varchar(100) DEFAULT NULL,
                                           `order_info` longtext DEFAULT NULL COMMENT '订单原始数据',
                                           `picker_info` longtext DEFAULT NULL COMMENT '订单原始数据',
                                           `pay_info` longtext DEFAULT NULL COMMENT '订单原始数据',
                                           `height` double DEFAULT NULL COMMENT '高',
                                           `weight` double DEFAULT NULL COMMENT '重量',
                                           `volume` double DEFAULT NULL COMMENT '体积',
                                           `volume_weight` double DEFAULT NULL COMMENT '体积重量',
                                           `total_fee` double DEFAULT NULL COMMENT '体积重量',
                                           `order_status_desc` varchar(255) DEFAULT NULL COMMENT '订单状态描述',
                                           `order_status` varchar(5) DEFAULT '0' COMMENT '订单状态快递信息状态',
                                           `create_time` int(13) DEFAULT NULL COMMENT '创建时间',
                                           `update_time` int(13) DEFAULT NULL COMMENT '更新时间',
                                           `delete_time` int(13) DEFAULT NULL COMMENT '删除时间',
                                           PRIMARY KEY (`order_id`) USING BTREE,
                                           KEY `order_id` (`order_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='订单快递信息表';

-- ----------------------------
-- Table structure for fengchao_order_fee
-- ----------------------------
DROP TABLE IF EXISTS `fengchao_order_fee`;
CREATE TABLE `fengchao_order_fee` (
                                      `id` bigint(20) NOT NULL AUTO_INCREMENT,
                                      `order_id` varchar(100) NOT NULL DEFAULT '订单id',
                                      `order_type` int(1) NOT NULL DEFAULT 0 COMMENT '订单类型',
                                      `weight` decimal(10,2) NOT NULL COMMENT '重量',
                                      `first_weight_amount` decimal(10,2) NOT NULL COMMENT '首重费用',
                                      `continuous_weight_amount` decimal(10,2) NOT NULL COMMENT '续重费用',
                                      `cost` decimal(10,2) NOT NULL COMMENT '成本',
                                      `insure_amount` decimal(10,2) NOT NULL COMMENT '保价金额',
                                      `package_fee` decimal(10,2) NOT NULL COMMENT '包装费用',
                                      `over_fee` decimal(10,2) NOT NULL COMMENT '超重费用',
                                      `other_fee` decimal(10,2) NOT NULL COMMENT '其他费用',
                                      `other_fee_detail` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '其他费用详情' CHECK (json_valid(`other_fee_detail`)),
                                      `total_fee` decimal(10,2) NOT NULL COMMENT '总费用',
                                      `volume` decimal(10,2) NOT NULL COMMENT '体积',
                                      `volume_weight` decimal(10,2) NOT NULL COMMENT '体积重量',
                                      PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='运费信息表';

-- ----------------------------
-- Table structure for fengchao_order_log
-- ----------------------------
DROP TABLE IF EXISTS `fengchao_order_log`;
CREATE TABLE `fengchao_order_log` (
                                      `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                                      `site_id` int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
                                      `request_type` varchar(255) NOT NULL COMMENT '业务类型',
                                      `request_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '业务数据',
                                      `create_time` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
                                      `memo` varchar(255) NOT NULL DEFAULT '' COMMENT '备注信息',
                                      `response_data` longtext NOT NULL COMMENT '服务端数据',
                                      PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='站点请求和回调日志';

-- ----------------------------
-- Table structure for fengchao_pay
-- ----------------------------
DROP TABLE IF EXISTS `fengchao_pay`;
CREATE TABLE `fengchao_pay` (
                                `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
                                `site_id` int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
                                `trade_type` int(11) NOT NULL DEFAULT 0 COMMENT '1、下单付款\n\n2、取消订单退款\n\n3、重量补差价\n',
                                `order_id` varchar(44) NOT NULL DEFAULT '0' COMMENT '订单Id',
                                `money` decimal(10,2) NOT NULL COMMENT '支付金额',
                                `status` int(11) NOT NULL DEFAULT 0 COMMENT '支付状态（0.待支付 1. 支付中 2. 已支付 -1已取消）',
                                `create_time` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
                                `pay_time` int(11) NOT NULL DEFAULT 0 COMMENT '支付时间',
                                `update_time` int(11) DEFAULT NULL,
                                `cancel_time` int(11) NOT NULL DEFAULT 0 COMMENT '关闭时间',
                                `fail_reason` varchar(255) NOT NULL DEFAULT '' COMMENT '失败原因',
                                PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='支付记录表';

-- ----------------------------
-- Table structure for fengchao_site
-- ----------------------------
DROP TABLE IF EXISTS `fengchao_site`;
CREATE TABLE `fengchao_site` (
                                 `site_id` int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
                                 `balance` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT '可用余额',
                                 `balance_get` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT '累计获取余额',
                                 `delete_time` int(11) NOT NULL DEFAULT 0 COMMENT '删除时间',
                                 `update_time` int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
                                 PRIMARY KEY (`site_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='站点信息';

-- ----------------------------
-- Table structure for fengchao_site_auth
-- ----------------------------
DROP TABLE IF EXISTS `fengchao_site_auth`;
CREATE TABLE `fengchao_site_auth` (
                                      `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                                      `site_id` int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
                                      `api_name` varchar(255) NOT NULL DEFAULT '' COMMENT 'ApiName',
                                      `api_key` bigint(20) NOT NULL COMMENT 'api_key',
                                      `api_secret` text NOT NULL COMMENT 'api_secret',
                                      `callback_url` text NOT NULL COMMENT '回调url',
                                      `delete_time` int(11) NOT NULL DEFAULT 0 COMMENT '删除时间',
                                      `create_time` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
                                      PRIMARY KEY (`id`,`api_key`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='站点api验证';

-- ----------------------------
-- Table structure for fengchao_site_balance_log
-- ----------------------------
DROP TABLE IF EXISTS `fengchao_site_balance_log`;
CREATE TABLE `fengchao_site_balance_log` (
                                             `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                                             `member_id` int(11) NOT NULL DEFAULT 0 COMMENT '用户id',
                                             `site_id` int(11) NOT NULL DEFAULT 0 COMMENT '站点id',
                                             `account_type` varchar(255) NOT NULL DEFAULT 'point' COMMENT '账户类型',
                                             `account_data` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT '账户数据',
                                             `account_sum` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT '变动后的账户余额',
                                             `from_type` varchar(255) NOT NULL DEFAULT '' COMMENT '来源类型',
                                             `order_id` varchar(100) NOT NULL,
                                             `pay_id` varchar(50) NOT NULL DEFAULT '' COMMENT '关联Id',
                                             `create_time` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
                                             `memo` varchar(255) NOT NULL DEFAULT '' COMMENT '备注信息',
                                             PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='会员账单表';
