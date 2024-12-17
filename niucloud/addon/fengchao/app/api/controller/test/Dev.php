<?php


namespace addon\fengchao\app\api\controller\test;

 use addon\fengchao\app\api\controller\express\ExpressService;
 use addon\fengchao\app\api\controller\express\OrderEventService;
 use addon\fengchao\app\api\controller\express\OrderPrice;
 use addon\fengchao\app\model\order\Orderle;
 use addon\fengchao\app\service\api\marketing\pointexchange\OrderCreateService;
 use app\service\api\sys\ConfigService;
 use core\base\BaseApiController;
use think\facade\Log;
use think\Response;


class Dev extends BaseApiController
{

    //快递鸟接口
    public function  domain()
    {

        $model=new Orderle();
        $data['create_time'] = time();
        $data['order_code'] = time();
        $data['site_id'] = time();
        $data['kdn_code'] = time();
        $data['server_data'] =[];
        $data['price_data'] =[];
        $data['result_price'] =[];
        $data['user_price'] =[];
        $data['client_data'] = [
            "a"=>"中国"
        ];
       // $res = $model->save($data);
        // echo $url;
        var_dump($res);

        exit;

       // return success($msg = 'SUCCESS', json_encode($result));

    }


}
