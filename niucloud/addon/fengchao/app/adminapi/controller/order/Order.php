<?php

namespace addon\fengchao\app\adminapi\controller\order;

use addon\fengchao\app\service\api\order\OrderService;

use core\base\BaseAdminController;
use think\Response;

class Order extends BaseAdminController
{
    /**
     * 订单列表
     * @return Response
     */
    public function lists()
    {
        $data = $this->request->params([
            [ 'order_id', '' ],
            [ 'create_time', [] ],
        ]);

        return success(( new OrderService() )->getPage($data));
    }

    /**
     * 订单详情
     * @param int $order_id
     * @return Response
     */
    public function detail(string $id)
    {
        return success(( new OrderService() )->getDetail($id));
    }


}
