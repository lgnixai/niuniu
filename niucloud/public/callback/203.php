<?php
/**
* @技术QQ群: 需由双方商务人员创建项目群
* @see: https://kdniao.com/api-pickup
* @copyright: 深圳市快金数据技术服务有限公司
* ID和Key请到官网申请：https://kdniao.com/reg



* 上门取件接口
* 此接口用于通知快递公司快递员上门揽件。
* 正式地址：https://api.kdniao.com/api/OOrderService
*
*
* 系统级参数
* RequestData	   String	R	请求内容为JSON格式 详情可参考接口技术文档
* EBusinessID	   String	R	用户ID
* RequestType	   String	R	请求接口指令
* DataSign	       String	R	数据内容签名，加密方法为：把(请求内容(未编码)+ApiKey)进行MD5加密--32位小写，然后Base64编码，最后进行URL(utf-8)编码
* DataType	       String	R	DataType=2，请求、返回数据类型均为JSON格式


* 应用级参数
* R-必填（Required），O-可选（Optional），C-报文中该参数在一定条件下可选（Conditional）
* ShipperCode	             String(20)	    O	快递编码。开通指定快递类型的时候可传入字段，否则会报错
* OrderCode	                 String(30)	    R	订单编号(自定义，不可重复)
* PayType	                 Int(1)	        R	运费支付方式：1-现付，2-到付，3-月结
* ExpType	                 Int(2)	        R	业务类型
* Receiver.Company	         String(30)	    O	收件人公司
* Receiver.Name	             String(30)	    R	收件人
* Receiver.Tel	             String(20)	    R	电话与手机，必填一个
* Receiver.Mobile	         String(20)     R	电话与手机，必填一个
* Receiver.ProvinceName	     String(20)	    R	收件省(如广东省，不要缺少“省”；如是直辖市，请直接传北京、上海等；如是自治区，请直接传广西壮族自治区等)
* Receiver.CityName	         String(20)	    R	收件市(如深圳市，不要缺少“市；如是市辖区，请直接传北京市、上海市等”)
* Receiver.ExpAreaName	     String(20)	    R	收件区/县(如福田区，不要缺少“区”或“县”)
* Receiver.Address	         String(100)	R	收件人详细地址(不用传省市区)
* Sender.Company	         String(30)	    O	发件人公司
* Sender.Name	             String(30)	    R	发件人
* Sender.Tel	             String(20)	    R	电话与手机，必填一个
* Sender.Mobile	             String(20)	    R	电话与手机，必填一个
* Sender.ProvinceName	     String(20)	    R	发件省(如广东省，不要缺少“省”；如是直辖市，请直接传北京、上海等；如是自治区，请直接传广西壮族自治区等)
* Sender.CityName	         String(20)	    R	发件市(如深圳市，不要缺少“市；如是市辖区，请直接传北京市、上海市等”)
* Sender.ExpAreaName	     String(20)	    R	发件区/县(如福田区，不要缺少“区”或“县”)
* Sender.Address	         String(100)	R	发件人详细地址(不用传省市区)
* StartDate	                 String(32)	    O	上门揽件时间段，格式：YYYY-MM-DD HH24:MM:SS
* EndDate                    String(32)	    O	上门揽件时间段，格式：YYYY-MM-DD HH24:MM:SS
* Weight	                 Double(10,3)	C	包裹总重量kg，当选择IsInstallService时，必填
* Quantity	                 Int(2)	        R	包裹数，一个包裹对应一个运单号，如果是大于1个包裹，返回则按照子母件的方式返回母运单号和子运单号
* Volume	                 Double(20,3)	O	包裹总体积m3
* Remark	                 String(60)	    O	备注
* Commodity.GoodsName	     String(100)	R	商品名称
*
*
*
*/


//用户ID，快递鸟提供，注意保管，不要泄漏
defined('EBusinessID') or define('EBusinessID', '1237100');//即用户ID，登录快递鸟官网会员中心获取 https://www.kdniao.com/UserCenter/v4/UserHome.aspx 
//API key，快递鸟提供，注意保管，不要泄漏
defined('ApiKey') or define('ApiKey', '56da2cf8-c8a2-44b2-b6fa-476cd7d1ba17');//即API key，登录快递鸟官网会员中心获取 https://www.kdniao.com/UserCenter/v4/UserHome.aspx
//请求url，正式地址
defined('ReqURL') or define('ReqURL', 'https://api.kdniao.com/api/OOrderService');


$logisticResult = getOrderTracesByJson();
echo $logisticResult;


function getOrderTracesByJson(){
  // 组装应用级参数
	$requestData= "{".
    "'OrderCode': '012657018199',".
    "'ShipperCode': 'SF',".
    "'PayType': 1,".
    "'ExpType': 1,".
    "'Sender': {".
    "'Company': 'LV',".
    "'Name': 'Taylor',".
    "'Mobile': '15018442396',".
    "'ProvinceName': '上海',".
    "'CityName': '上海市',".
    "'ExpAreaName': '青浦区',".
    "'Address': '明珠路'".
    "},".
    "'Receiver': {".
    "'Company': 'GCCUI',".
    "'Name': 'Yann',".
    "'Mobile': '15018442396',".
    "'ProvinceName': '北京',".
    "'CityName': '北京市',".
    "'ExpAreaName': '朝阳区',".
    "'Address': '三里屯街道'".
    "},".
    "'Commodity': [".
    "{".
    "'GoodsName': '鞋子',".
    "'Goodsquantity': 1,".
    "'GoodsWeight': 1.0".
    "}".
    "],".
    "'Weight': 1.0,".
    "'Quantity': 1,".
    "'Volume': 0.0,".
    "'Remark': '小心轻放'".
"}";
  // 组装系统级参数
	$datas = array(
        'EBusinessID' => EBusinessID,
        'RequestType' => '1801',
        'RequestData' => urlencode($requestData) ,
        'DataType' => '2',
    );
    $datas['DataSign'] = encrypt($requestData, ApiKey);
  //以form表单形式提交post请求，post请求体中包含了应用级参数和系统级参数
	$result=sendPost(ReqURL, $datas);	
	
	//根据公司业务处理返回的信息......
	
	return $result;
}
 
/**
 *  post提交数据 
 * @param  string $url 请求Url
 * @param  array $datas 提交的数据 
 * @return url响应返回的html
 */
function sendPost($url, $datas) {
    $postdata = http_build_query($datas);
    $options = array(
      'http' => array(
        'method' => 'POST',
        'header' => 'Content-type:application/x-www-form-urlencoded',
        'content' => $postdata,
        'timeout' => 15 * 60 // 超时时间（单位:s）
      )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return $result;
}

/**
 * 电商Sign签名生成
 * @param data 内容   
 * @param ApiKey ApiKey
 * @return DataSign签名
 */
function encrypt($data, $ApiKey) {
    return urlencode(base64_encode(md5($data.$ApiKey)));
}

?>