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
use addon\fengchao\app\service\api\express\ExpressService;
use addon\fengchao\app\service\api\marketing\pointexchange\OrderCreateService;
use core\base\BaseApiController;
use Faker\Provider\zh_CN\Company;
use think\Response;
use Faker\Factory;


class FakeData extends BaseApiController
{

    /**
     * 节口列表
     * @param int $id
     * @return Response
     */
    public function list()
    {
        $list = [];
        $list = [
            '1801' => '创建订单接口',
            '1802' => '订单取消接口',
            '1804' => '订单信息查询接口',
            '1807' => '工单提交接口',
            '1815' => '预估运费接口',

            '1816' => '订单状态查询接口',
            '1818' => '工单详情查询接口',

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

    public function Fake_1801($site_id)
    {

        $mobile = preg_replace_callback(
            "/\\%/u",
            function () {
                return random_int(1, 9); // 随机生成 1-9 的数字替代 `%`
            },
            "1%8986048%%"
        );

        // 创建 Faker 实例
        $faker = Factory::create('zh_CN'); // 使用中文

        // 构造假数据
        $data = [
            "TransportType"=>1,
            "ShipperType" => 5, // 随机快递类型
            "ShipperCode" => $faker->randomElement(["YD", "STO",  "ZTO","YTO","JTSD"]), // 快递公司编码
            "OrderCode" => $faker->uuid, // 商家订单编号
            "ExpType" => 1, // 快递类型
            "PayType" => 3, // 支付方式

            "Receiver" => [
                "ProvinceName" => "广东省", // 固定为广东省
                "CityName" => $faker->randomElement(["广州市", "深圳市", "东莞市", "佛山市"]),
                "ExpAreaName" => $faker->randomElement(["天河区", "海珠区", "福田区", "南山区"]),
                "Address" => $faker->streetName,
                "Name" => $faker->name,
                "Mobile" => $mobile,
            ],
            "Sender" => [

                "ProvinceName" => "河南省", // 固定为河南省
                "CityName" => $faker->randomElement(["郑州市", "洛阳市", "开封市", "南阳市"]),
                "ExpAreaName" => $faker->randomElement(["中原区", "二七区", "管城区", "惠济区"]),
                "Address" => $faker->streetName,
                "Name" => $faker->name,
                "Mobile" => $mobile,
            ],
            "Weight" => $faker->randomFloat(1, 0.5, 5.0), // 包裹重量 (0.5 ~ 5.0kg)
            "Quantity" => 1, // 数量
            "Remark" => "", // 备注 (可选)
            "Commodity" => [
                [
                    "GoodsName" => $faker->randomElement(["衣服", "电子产品", "食品", "酒水", "书籍"]),
                    "GoodsQuantity" => $faker->numberBetween(1, 5),
                    "GoodsPrice" => $faker->randomFloat(2, 10, 1000), // 价格范围 10~1000
                ]
            ]
        ];

        // 返回 JSON 数据
        return success($data);
    }

    public function Fake_1802($site_id)
    {
        $mobile = preg_replace_callback(
            "/\\%/u",
            function () {
                return random_int(1, 9); // 随机生成 1-9 的数字替代 `%`
            },
            "1%8986048%%"
        );

        // 创建 Faker 实例
        $faker = Factory::create('zh_CN'); // 使用中文
        $orders = (new OrderLogService())->getOrderLogBySiteId($site_id);
        $order_code = "";
        if (empty($orders)) {

        } else {
            $order_code = $orders[array_rand($orders)]['request_data']['OrderCode'];
        }
        // 构造假数据
        $data = [
            "ShipperCode" => "STO", // 随机快递类型
            "OrderCode" => $order_code,
            "LogisticCode" => "",
            "CancelType" => 1,
            "CancelMsg" => "预约信息有误",
        ];

        // 返回 JSON 数据
        return success($data);

    }

    // 订单信息查询接口
    public function Fake_1804($site_id)
    {
        $mobile = preg_replace_callback(
            "/\\%/u",
            function () {
                return random_int(1, 9); // 随机生成 1-9 的数字替代 `%`
            },
            "1%8986048%%"
        );

        // 创建 Faker 实例
        $faker = Factory::create('zh_CN'); // 使用中文
        $orders = (new OrderLogService())->getOrderLogBySiteId($site_id);
        $order_code = "";
        if (empty($orders)) {

        } else {
            $order_code = $orders[array_rand($orders)]['request_data']['OrderCode'];
        }
        // 构造假数据
        $data = [

            "OrderCode" => $order_code,

        ];

        // 返回 JSON 数据
        return success($data);

    }
    // 订单类型查询接口
    public function Fake_1818($site_id)
    {
        $mobile = preg_replace_callback(
            "/\\%/u",
            function () {
                return random_int(1, 9); // 随机生成 1-9 的数字替代 `%`
            },
            "1%8986048%%"
        );

        // 创建 Faker 实例
        $faker = Factory::create('zh_CN'); // 使用中文

        // 构造假数据
        $data = [
            "pageIndex"=>1,
            "sizePerPage"=>20,
            "kdnOrderCodes"=>[
                "KDNSIT2404151410000002"
            ],
            "source"=> 4

        ];

        // 返回 JSON 数据
        return success("",$data);

    }

    /**
     * 超区检验
     */
    public function Fake_1814($site_id)
    {

        $mobile = preg_replace_callback(
            "/\\%/u",
            function () {
                return random_int(1, 9); // 随机生成 1-9 的数字替代 `%`
            },
            "1%8986048%%"
        );

        // 创建 Faker 实例
        $faker = Factory::create('zh_CN'); // 使用中文

        // 构造假数据
        $data = [
            "ShipperType" => 5, // 随机快递类型

            "Receiver" => [
                "ProvinceName" => "广东省", // 固定为广东省
                "CityName" => $faker->randomElement(["广州市", "深圳市", "东莞市", "佛山市"]),
                "ExpAreaName" => $faker->randomElement(["天河区", "海珠区", "福田区", "南山区"]),
                "Address" => $faker->streetName,

            ],
            "Sender" => [

                "ProvinceName" => "河南省", // 固定为河南省
                "CityName" => $faker->randomElement(["郑州市", "洛阳市", "开封市", "南阳市"]),
                "ExpAreaName" => $faker->randomElement(["中原区", "二七区", "管城区", "惠济区"]),
                "Address" => $faker->streetName,

            ]

        ];

        // 返回 JSON 数据
        return success($data);
    }

    /**
     * 预估运费接口
     * @return \think\response\Json
     * @throws \Random\RandomException
     */

    public function Fake_1815($site_id)
    {


        // 创建 Faker 实例
        $faker = Factory::create('zh_CN'); // 使用中文

        // 构造假数据
        $data = [
            "TransportType"=>1,
            "ShipperType" => 5, // 随机快递类型
            "Weight" => $faker->numberBetween(1, 5), // 随机快递类型

            "Receiver" => [
                "ProvinceName" => "广东省", // 固定为广东省
                "CityName" => $faker->randomElement(["广州市", "深圳市", "东莞市", "佛山市"]),
                "ExpAreaName" => $faker->randomElement(["天河区", "海珠区", "福田区", "南山区"]),

            ],
            "Sender" => [

                "ProvinceName" => "河南省", // 固定为河南省
                "CityName" => $faker->randomElement(["郑州市", "洛阳市", "开封市", "南阳市"]),
                "ExpAreaName" => $faker->randomElement(["中原区", "二七区", "管城区", "惠济区"]),

            ]

        ];

        // 返回 JSON 数据
        return success($data);
    }
/**
     * 预估运费接口
     * @return \think\response\Json
     * @throws \Random\RandomException
     */

    public function Fake_1807($site_id)
    {


        // 创建 Faker 实例
        $faker = Factory::create('zh_CN'); // 使用中文
        $orders = (new OrderLogService())->getOrderLogBySiteId($site_id);

        $order_code = "";
        if (empty($orders)) {

        } else {
            $order_code = $orders[array_rand($orders)]['response_data']["Order"]['OrderCode'];
        }
        // 构造假数据
        $data = [
            "Mobile"=>$faker->phoneNumber,
            "Name"=>$faker->name,
            "OrderCode"=>$order_code,
            "ComplaintType"=>$faker->numberBetween(1, 3),
            "ComplaintContent"=>$faker->text,
            "Source"=>4,
            "PicList"=>[
                [
                    "PictureItem"=>"UjBsR09EbGhFZ0UwQVBBQUFBQUFBUC8vL3l3QUFBQUFFZ0UwQUVBSS93QURDQnhJa0NDQWd3QUVIalNJY09IQWhnb1JNblFZMFNIRWh4SXhNcHlZc0NERkFCY2pGZ1Rac0tOSWtoOHRaaHlac21QSmpDOHJtaVRKVWVWRm15Vmxzc3hKRStYTWtVQ0RZbFJaYytiTmxUNDU2aHhxdEtsU2owMWI3Z3paa3lyT29GSjlIdDNxbENsT29scGhJcFVKbHFyUXMxREJrbzNxRXFsVnNTMnpubHk2a1duZG9uWGYwb1dhOTJWYnJuZkRyajNwOSs5UHdWWEhvbDE4RksvZHBJK1h2cFhiYys5Y3lKY0hhOFNjK0dQZ3IzQkRmK1lac3pOcHhhV3ZMbDR0bVcxY3cwOWJ2eDRkZS9OZXo0Z0p1NFVOTkd0aHpYcTlHaTdyMXpKaTFhd1ppM1VzbSszVHlWMHZtNjNNR1hkcDNiNFZTeDhlR2puMTFLZlhldjhIempzNTJzYkNuKytlWFgzM2FPdk9iYWZmSEh6NmR2SGNiN3ZPYnhwdzJ1V2NtWWNWZ0pvMVY1dC8rcjEzR0h1WjVXWmFYN2pkRnhab0NjNEhIbjdHWFJpZ2dGTzF4UnhrMEtuSDRIZnhLUmhZZ1EvU3B4MkpHQjdubm9YaFRWZ2VqTVp4cU42SENMYm5YWERid1hmZ2dqeGgxNVY5TE1wSUhtWGdvZmZiaGhvU2FTT0krNGxZSXBRaklvbmFsUERWOXlLUjJTVXBtbnhlRXVkbGgySWU5bVJyT0g2cDM0NHY5Z2prajJRT3VlV0tYWjZXNDJzVTlxY21qUnVlQ1dXYWJMSVhJcGhUdW5taWcyeldXT1NTWXhMS1ZaazVrcWZvaytpaGVPZDZNL0pJb28rUlVXZHBwalBTWnFTTFZqN3E0YWpUTmJraXBRUWl1dWVnZzByL21DR1dRR3BaNTRBUTJ2bHFsQzYybUdxTVR0cFlxYXVCeGhkcmtiUEMrZCt0S2thNGFIR2tSaGN0cEh0SzJ1ZVp3MTVISmEzRmlwcHNwMW5PeWV4T3VacGE0WkVBTW5xbGtxc0syNnEybHdxS3FiZE0waHBucnZqMkptZVlvRHFtYXFQK2h1cm5uL01aQ082dVZ0Wm1xSHlmVnNqbHZyb21DaU83QVBNWkxJZlpCcm50ajkwU3F2Q20wamJjbnFKMW1qdnl4T2xDK3l2RlptTDdyc2J4R2p1dng1MHUzQ0M4L1Y1YmNuYzVvMHZ0ZUwxZXk2cGF4SUlxYjVYUy9xcHNtZzdUQ2JISm12SXJaS1JCWHl4Z3hyRE9iUEM1SUpONzhMM05Rb3hyMkZDM09lMnA2b1piNXNEL3VYazB0MFluWFdqWERMdmF0TE03NXhsMXhHaXIvN3h1eXM0T2ZlcW5IVzk5c3MyT2htejN5UStYeXpQWFV1c0o5TDh0Qys2MnpFZ1hqbXk5U3hlY29wQmpULzM0NFdlTFBqbXc3V0w4Y3RhWngwMnYwbDh2SzNiWW9Vdk8zOTVsKy9yMzJtdy9oaWZtY0s4cDk4ZElndzA2N2ZvNnJyZlprWU4yT3N1OSs4NnI0YXpibTdqWFhJdHNhOHQ1Mzg0ODM2WUxUSG4wYUhvZXM1U2RqNGk0MnJNZmo3M3Q2Q3E0dk83c3U5ODcxak1mZXo3TjMyYS8rUGExYzU3M1NqVTZBYzRLZXVURDM5czQ1anIrY1M1MlRHT2MwNVEzUUxubERsVzc2MXZnM0VVMG5HbHVmN0o2b1A5d2RqZnVQYTJBMzd0ZzJtb0Z1TXB4Y0hCRkV4NzZJRWczRTlXTmhCTEUyd21YUjhENVliQituN3ZmNnYveXA3V04wVkI5TmZUVS84UmxRZ3JHTDNFK1hDSFlnT1luQlFLUGdUSjBJT3hHQ0xPY05ZNXNLT3loOStqSFF0NUZ6NG96ektMK0xQZ21HbXFQaVFIa0RnL1pHRVcvQVpHS0x1dGdGeitJc09IVkxJbEF0QjhldS9mRXkxbExpckt6SDl2UUtMM1daVEdFV3lUZEc4ZkZGekRPVVg1ai9HRVpOZWhDMWVteGVsalVrUi83SjhrbFVsSlVLNVNZenpoSnRmRWxjSWdMUEJnZmJVaExKZUlRZ01telpBVXhlVWc3YmxLUkEyTWs5WWhZdk90VmtvdTRCS2FFVXRtejBzR3ZYZ2c4SXl5dktNc0dRdkpLblp0ays0NzV6SXI5cnBjVkEyY25yemJOTklyeWtadUxwS2EwbWEvM0dUQmF2S3lhTDZjb3NDcVdzNUhCTzZjV3NlbTBSbE51RTVXK1ZLVXozN215RnBLUFlJU3pwaEVoTjdkaVJqQ1ozQ1NvcnVKSnVWYWlib09laEtFSEZRckNkUElUbVhCRW5qdmx1RXNvWmhLUkFadlVDdzJKejFDdXNaYnIrNlZJZ3dqUTVxVVFoV1NrcDBvenl0Smh4cEtoeExQZVEwTTZVaklLMUtZNVRTUk5nM2xQbjFJVHFIOTBxUG04T0VGZEZoSmtkUXluUERGS3prOFNNNTh2TldZdEF4bkVRZTZ3cEN5dGFMVzJPazd6Q0hPaCtnd3I0bUpxdkxMVzgxazJGYU00TFJwTnRBUUVBRHM9"
                ]
            ],
        ];

        // 返回 JSON 数据
        return success($data);
    }

    //订单状态查询接口
    public function Fake_1816($site_id)
    {


        // 创建 Faker 实例
        $faker = Factory::create('zh_CN'); // 使用中文
        $orders = (new OrderLogService())->getOrderLogBySiteId($site_id);

        $order_code = "";
        if (empty($orders)) {

        } else {
            $order_code = $orders[array_rand($orders)]['response_data']["Order"]['KDNOrderCode'];
        }
        // 构造假数据
        $data = [

            "KdnOrderCode" => $order_code,

        ];

        // 返回 JSON 数据
        return success($data);

    }


}

function convertToRequestData($inputData)
{
    // 如果输入是 JSON 字符串，则将其解码为数组
    if (is_string($inputData)) {
        $inputData = json_decode($inputData, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidArgumentException("Invalid JSON input");
        }
    }

    // 检查是否是数组
    if (!is_array($inputData)) {
        throw new InvalidArgumentException("Input data must be an array or a valid JSON string");
    }

    // 递归格式化数组
    return formatArrayToRequestString($inputData);
}

function formatArrayToRequestString($data, $indent = 0)
{
    $output = "{\n";
    $indentation = str_repeat("    ", $indent + 1);  // 每一层增加缩进

    foreach ($data as $key => $value) {
        $formattedKey = "'$key'"; // 使用单引号包裹键

        if (is_array($value)) {
            // 如果值是数组，递归调用函数并增加缩进
            $formattedValue = formatArrayToRequestString($value, $indent + 1);
        } elseif (is_string($value)) {
            // 如果值是字符串，使用单引号包裹
            $formattedValue = "'$value'";
        } else {
            // 其他类型的值直接输出
            $formattedValue = $value;
        }

        $output .= "$indentation$formattedKey: $formattedValue,\n";
    }

    // 去除最后一个多余的逗号
    $output = rtrim($output, ",\n") . "\n";
    $output .= str_repeat("    ", $indent) . "}";

    return $output;
}