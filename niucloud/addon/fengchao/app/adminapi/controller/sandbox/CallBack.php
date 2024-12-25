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

namespace addon\fengchao\app\adminapi\controller\sandbox;

use addon\fengchao\app\service\admin\api\SiteApiService;
use addon\fengchao\app\service\admin\site\OrderLogService;
use addon\fengchao\app\service\api\marketing\pointexchange\OrderCreateService;
use core\base\BaseApiController;
use Faker\Provider\zh_CN\Company;
use think\Response;
use Faker\Factory;


class CallBack extends BaseApiController
{

    /**
     * 节口列表
     * @param int $id
     * @return Response
     */
    public function list()
    {

        $list = [
           // '102' => '已经分配网点',
            '103' => '已分配快递员',
            '104' => '推送已取件',
            //'109' => '更换快递公司',
//            '110' => '修改预约时间',
//            '121' => '交易结果推送',
//            '122' => '待支付金额推送',
            '2' => '推送在途中状态',
            '203' => '订单取消',
//            '206' => '虚假揽件（用户举报）',
//            '207' => '线下收费（用户举报）',
            '208' =>'修正重量（用户举报客服对账)',
            '3' => '已签收',
            '301' => '揽件状态（包含费用明细）',
            '302' => '更换运单号信息',
             '401' => '工单回推',
//            '402' => '修改订单通知',
//            '501' => '推送工单赔付结果',
//            '502' => '推送子母件信息',
            '601' => '推送费用状态(仅指定申通下单)',
            '99' => '调度失败',
//            '单条轨迹推送' => '单条轨迹推送',
//            '多条轨迹推送' => '多条轨迹推送',


        ];

        return success($list);
    }

    public function fake(int $site_id, int $id)
    {


        $functionName = "Fake_$id"; // 拼接函数名
        if (method_exists($this, $functionName)) { // 检查方法是否存在
            return $this->$functionName($site_id); // 使用 $this 调用类中的方法
        } else {
            return "方法 $functionName 不存在";
        }


    }

    public function Fake_203($site_id)
    {

        // 构造假数据
        $data = [
            "PushTime" => "2023-10-10 17:23:00",
            "EBusinessID" => "350238",
            "Data" => [
                [
                    "ShipperCode" => "SF",
                    "CreateTime" => "2023-10-10 19:35:07",
                    "OrderCode" => "TEST23100001",
                    "EBusinessID" => "350238",
                    "PickerInfo" => [
                        [
                            "PickupCode" => "1234"
                        ]
                    ],
                    "Cost" => 0.0,
                    "Success" => true,
                    "CallRequestType" => "1801",
                    "Weight" => 1.0,
                    "Reason" => "揽收失败 原因：无法联系上客户",
                    "LogisticCode" => "SF1390004911440",
                    "State" => "203",
                    "FetchTime" => "",
                    "KDNOrderCode" => "KDNIST2310101000000001",
                    "OperateType" => 2
                ]
            ],
            "Count" => 1
        ];

        // 返回 JSON 数据
        return success($data);
    }

    public function Fake_103($site_id)
    {
        $data = [
            "PushTime" => "2023-10-10 18:13:23",
            "EBusinessID" => "350238",
            "Data" => [
                [
                    "ShipperCode" => "SF",
                    "CreateTime" => "2023-10-10 18:13:50",
                    "OrderCode" => "TEST23100001",
                    "EBusinessID" => "350238",
                    "PickerInfo" => [
                        [
                            "PersonName" => "宋建硕",
                            "PersonTel" => "18100006672",
                            "PickupCode" => "1234",
                            "PersonCode" => ""
                        ]
                    ],
                    "Cost" => 0.0,
                    "Success" => true,
                    "CallRequestType" => "1801",
                    "Weight" => 1.0,
                    "Reason" => "订单已分配快递员",
                    "LogisticCode" => "SF1390004911440",
                    "State" => "103",
                    "FetchTime" => "",
                    "KDNOrderCode" => "KDNIST2310101000000001",
                    "OperateType" => 2
                ]
            ],
            "Count" => 1
        ];
        // 返回 JSON 数据
        return success($data);

    }

    //已取件
    public function Fake_104($site_id)
    {

        $data = [
            "PushTime" => "2023-10-10 18:13:23",
            "EBusinessID" => "350238",
            "Data" => [
                [
                    "ShipperCode" => "SF",
                    "CreateTime" => "2023-10-10 20:20:57",
                    "OrderCode" => "TEST23100001",
                    "EBusinessID" => "350238",
                    "PickerInfo" => [
                        [
                            "PickupCode" => "1234"
                        ]
                    ],
                    "Cost" => 0.0,
                    "Success" => true,
                    "CallRequestType" => "1801",
                    "Weight" => 1.0,
                    "Reason" => "订单已取件",
                    "LogisticCode" => "SF1390004911440",
                    "State" => "104",
                    "FetchTime" => "",
                    "KDNOrderCode" => "KDNIST2310101000000001",
                    "OperateType" => 2
                ]
            ],
            "Count" => 1
        ];
        // 返回 JSON 数据
        return success($data);

    }

    //已取件
    public function Fake_2($site_id)
    {
        $data = [
            "PushTime" => "2023-10-10 18:13:23",
            "EBusinessID" => "350238",
            "Data" => [
                [
                    "ShipperCode" => "SF",
                    "CreateTime" => "2023-10-11 01:52:01",
                    "OrderCode" => "TEST23100001",
                    "EBusinessID" => "350238",
                    "PickerInfo" => [
                        [
                            "PickupCode" => "1234"
                        ]
                    ],
                    "Cost" => 8.5,
                    "Success" => true,
                    "CallRequestType" => "1801",
                    "Weight" => 2.0,
                    "Reason" => "订单已发出，进入运输中",
                    "LogisticCode" => "SF1390004911440",
                    "State" => "2",
                    "FetchTime" => "",
                    "KDNOrderCode" => "KDNIST2310101000000001",
                    "OperateType" => 2
                ]
            ],
            "Count" => 1
        ];
        // 返回 JSON 数据
        return success($data);

    }
    //已取件
    public function Fake_208($site_id)
    {
        $data = [
            "PushTime" => "2023-10-10 18:13:23",
            "EBusinessID" => "350238",
            "Data" => [
                [
                    "CreateTime" => "2023-10-10 20:51:04",
                    "EBusinessID" => "350238",
                    "ShipperCode" => "SF",
                    "LogisticCode" => "SF1390004911440",
                    "KDNOrderCode" => "KDNIST2310101000000001",
                    "OrderCode" => "TEST23100001",
                    "PickerInfo" => [
                        [
                            "PickupCode" => "1234"
                        ]
                    ],
                    "CallRequestType" => "1801",
                    "State" => "208",
                    "FetchTime" => "",
                    "Reason" => "修改重量",
                    "Weight" => 2.0,
                    "FirstWeightAmount" => "6.50",
                    "ContinuousWeightAmount" => "0.00",
                    "Cost" => 6.5,
                    "InsureAmount" => "0.00",
                    "PackageFee" => "0.00",
                    "OverFee" => "0.00",
                    "OtherFee" => "1.00",
                    "OtherFeeDetail" => "{\"其他费用\":\"1.00\"}",
                    "TotalFee" => 7.5,
                    "Volume" => 19200.0,
                    "VolumeWeight" => 0.5,
                    "Success" => true,
                    "OperateType" => 2
                ]
            ],
            "Count" => 1
        ];
        // 返回 JSON 数据
        return success($data);

    }
    //已取件
    public function Fake_206($site_id)
    {
        $data = [
            "PushTime" => "2023-10-10 18:13:23",
            "EBusinessID" => "350238",
            "Data" => [
                [
                    "CreateTime" => "2023-10-10 20:51:04",
                    "EBusinessID" => "350238",
                    "ShipperCode" => "SF",
                    "LogisticCode" => "SF1390004911440",
                    "KDNOrderCode" => "KDNIST2310101000000001",
                    "OrderCode" => "TEST23100001",
                    "PickerInfo" => [
                        [
                            "PickupCode" => "1234"
                        ]
                    ],
                    "CallRequestType" => "1801",
                    "State" => "208",
                    "FetchTime" => "",
                    "Reason" => "修改重量",
                    "Weight" => 2.0,
                    "FirstWeightAmount" => "6.50",
                    "ContinuousWeightAmount" => "0.00",
                    "Cost" => 6.5,
                    "InsureAmount" => "0.00",
                    "PackageFee" => "0.00",
                    "OverFee" => "0.00",
                    "OtherFee" => "1.00",
                    "OtherFeeDetail" => "{\"其他费用\":\"1.00\"}",
                    "TotalFee" => 7.5,
                    "Volume" => 19200.0,
                    "VolumeWeight" => 0.5,
                    "Success" => true,
                    "OperateType" => 2
                ]
            ],
            "Count" => 1
        ];

        // 返回 JSON 数据
        return success($data);

    }
    //工单
    public function Fake_401($site_id)
    {
        $data = [
            "PushTime" => "2023-02-03 18:54:05",
            "EBusinessID" => "350238",
            "Data" => [
                [
                    "ShipperCode" => "SF",
                    "CreateTime" => "2023-02-08 18:30:02",
                    "OrderCode" => "TEST23100001",
                    "EBusinessID" => "350238",
                    "PickerInfo" => [
                        [
                            "PickupCode" => "1234"
                        ]
                    ],
                    "Cost" => 0.0,
                    "Success" => true,
                    "CallRequestType" => "1801",
                    "Weight" => 1.0,
                    "Reason" => "与快递公司核实中，我们将在24小时内核实回复，请耐心等待。",
                    "DealResultFiles" => "",
                    "TicketSource" => 4,
                    "LogisticCode" => "SF1390004911440",
                    "TicketId" => "CPN2302061710005366",
                    "State" => "401",
                    "FetchTime" => "",
                    "KDNOrderCode" => "KDNIST2310101000000001",
                    "OperateType" => 2
                ]
            ],
            "Count" => 1
        ];
        // 返回 JSON 数据
        return success($data);

    }

    public function Fake_601($site_id)
    {
        $data = [
            "PushTime" => "2023-10-10 23:13:23",
            "EBusinessID" => "350238",
            "Data" => [
                [
                    "CreateTime" => "2023-10-10 20:51:04",
                    "EBusinessID" => "350238",
                    "ShipperCode" => "SF",
                    "LogisticCode" => "SF1390004911440",
                    "KDNOrderCode" => "KDNIST2310101000000001",
                    "OrderCode" => "TEST23100001",
                    "PickerInfo" => [
                        [
                            "PickupCode" => "1234"
                        ]
                    ],
                    "CallRequestType" => "1801",
                    "State" => "601",
                    "FetchTime" => "",
                    "Reason" => "费用推送完成",
                    "Weight" => 2.0,
                    "FirstWeightAmount" => "6.50",
                    "ContinuousWeightAmount" => "2.00",
                    "Cost" => 8.5,
                    "InsureAmount" => "2.00",
                    "PackageFee" => "3.00",
                    "OverFee" => "0.00",
                    "OtherFee" => "1.00",
                    "OtherFeeDetail" => "{\"其他费用\":\"1.00\"}",
                    "TotalFee" => 14.5,
                    "Volume" => 19200.0,
                    "VolumeWeight" => 1.5,
                    "Success" => true,
                    "OperateType" => 2
                ]
            ],
            "Count" => 1
        ];

        // 返回 JSON 数据
        return success($data);

    }

    public function Fake_99($site_id)
    {
        $data = [
            "PushTime" => "2023-02-08 16:54:45",
            "EBusinessID" => "350238",
            "Data" => [
                [
                    "ShipperCode" => "SF",
                    "State" => "99",
                    "CreateTime" => "2023-02-08 16:54:49",
                    "KDNOrderCode" => "KDNIST2310101000000001",
                    "OrderCode" => "TEST23100001",
                    "Reason" => "网点暂停，无法提供收派服务，带来不便请您理解！",
                    "OperateType" => 1,
                    "CallRequestType" => "1801"
                ]
            ],
            "Count" => 1
        ];
        // 返回 JSON 数据
        return success($data);

    }

    public function Fake_3($site_id)
    {
        $data = [
            "PushTime" => "2023-10-10 18:13:23",
            "EBusinessID" => "350238",
            "Data" => [
                [
                    "LogisticCode" => "SF1390004911440",
                    "ShipperCode" => "SF",
                    "CreateTime" => "2023-10-11 09:14:53",
                    "KDNOrderCode" => "KDNIST2310101000000001",
                    "OrderCode" => "TEST23100001",
                    "Reason" => "【正常签收】您的快件已由本人签收，感谢您使用顺丰速运，期待再次为您服务",
                    "State" => "3",
                    "SignType" => "3001",
                    "CallRequestType" => "1801"
                ]
            ],
            "Count" => 1
        ];
        // 返回 JSON 数据
        return success($data);

    }

    public function Fake_301($site_id)
    {
        $data = [
            "PushTime" => "2023-10-10 18:13:23",
            "EBusinessID" => "350238",
            "Data" => [
                [
                    "CreateTime" => "2023-10-10 20:51:04",
                    "EBusinessID" => "350238",
                    "ShipperCode" => "SF",
                    "LogisticCode" => "SF1390004911440",
                    "KDNOrderCode" => "KDNIST2310101000000001",
                    "OrderCode" => "TEST23100001",
                    "PickerInfo" => [
                        [
                            "PickupCode" => "1234"
                        ]
                    ],
                    "CallRequestType" => "1801",
                    "State" => "301",
                    "FetchTime" => "",
                    "Reason" => "订单已完成",
                    "Weight" => 2.0,
                    "FirstWeightAmount" => "6.50",
                    "ContinuousWeightAmount" => "2.00",
                    "Cost" => 8.5,
                    "InsureAmount" => "2.00",
                    "PackageFee" => "3.00",
                    "OverFee" => "0.00",
                    "OtherFee" => "1.00",
                    "OtherFeeDetail" => "{\"其他费用\":\"1.00\"}",
                    "TotalFee" => 14.5,
                    "Volume" => 19200.0,
                    "VolumeWeight" => 1.5,
                    "Success" => true,
                    "OperateType" => 2
                ]
            ],
            "Count" => 1
        ];
        // 返回 JSON 数据
        return success($data);

    }
    public function Fake_302($site_id)
    {
        $data = [
            "PushTime" => "2023-10-10 18:13:23",
            "EBusinessID" => "350238",
            "Data" => [
                [
                    "CreateTime" => "2023-10-10 20:51:04",
                    "EBusinessID" => "350238",
                    "ShipperCode" => "SF",
                    "LogisticCode" => "SF1390004911440",
                    "KDNOrderCode" => "KDNIST2310101000000001",
                    "OrderCode" => "TEST23100001",
                    "PickerInfo" => [
                        [
                            "PickupCode" => "1234"
                        ]
                    ],
                    "CallRequestType" => "1801",
                    "State" => "301",
                    "FetchTime" => "",
                    "Reason" => "订单已完成",
                    "Weight" => 2.0,
                    "FirstWeightAmount" => "6.50",
                    "ContinuousWeightAmount" => "2.00",
                    "Cost" => 8.5,
                    "InsureAmount" => "2.00",
                    "PackageFee" => "3.00",
                    "OverFee" => "0.00",
                    "OtherFee" => "1.00",
                    "OtherFeeDetail" => "{\"其他费用\":\"1.00\"}",
                    "TotalFee" => 14.5,
                    "Volume" => 19200.0,
                    "VolumeWeight" => 1.5,
                    "Success" => true,
                    "OperateType" => 2
                ]
            ],
            "Count" => 1
        ];
        // 返回 JSON 数据
        return success($data);

    }


}
