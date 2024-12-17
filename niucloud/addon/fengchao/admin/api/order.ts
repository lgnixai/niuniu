import request from '@/utils/request'



/**
 * 获取订单列表
 * @returns
 */
export function getOrderList(params: Record<string, any>) {
    return request.get('fengchao/order/list', { params })
}

/**
 * 获取订单列表
 * @returns
 */
export function getOrderDetail(order_id: number) {
    return request.get(`fengchao/order/detail/${ order_id }`)
}
