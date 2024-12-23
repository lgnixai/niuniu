import request from '@/utils/request'

/**
 * 获取订单列表
 */
export function getOrderList(data : AnyObject) {
	return request.get('fengchao/getorderlist', data)
}
/**
 * 获取订单状态列表
 */
export function getOrderStatus() {
	return request.get('fengchao/getorderstatus')
}
/**
 * 获取订单信息
 */
export function getOrderDetail(id : number) {
	return request.get(`fengchao/getorderinfo/${id}`)
}
/**
 * 关闭订单
 */
export function closeOrder(id : number) {
	return request.get(`fengchao/closeorder/${id}`)
}
/**
 * 获取订单轨迹
 */
export function getDeliveryInfo(deliveryid) {
	return request.get(`fengchao/getdeliveryinfo/${deliveryid}`)
}
/**
 * 删除订单
 */
export function deleteOrder(id : number) {
	return request.delete(`fengchao/deleteorder/${id}`, { showSuccessMessage: true, showErrorMessage: true })
}
/**
 * 申请退款
 */
export function applyRefund(data : AnyObject) {
	return request.post('fengchao/applyrefund', data, { showSuccessMessage: true, showErrorMessage: true })
}