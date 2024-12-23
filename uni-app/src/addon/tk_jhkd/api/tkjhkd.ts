import request from '@/utils/request'

export function fanyiAddress(data : AnyObject) {
	return request.get('fengchao/address/fanyiaddress', data)
}
/**
 * 获取地址列表
 */
export function getJhkdAddressList(data : AnyObject) {
	return request.get('fengchao/address', data)
}
/**
 * 帮助中心
 */
export function help(data : AnyObject) {
	return request.get('fengchao/help', data)
}
/**
 * 获取地址详情
 */
export function getJhkdAddressDetail(id : number) {
	return request.get(`fengchao/address/${id}`)
}
/**
 * 获取地址详情
 */
export function getJhkdAddressInfo(id : number) {
	return request.get(`fengchao/addressinfo/${id}`)
}
/**
 * 获取协议
 */
export function getAgreement(key) {
	return request.get(`fengchao/agreement/${key}`)
}
/**
 * 添加地址/修改地址
 */
export function updateJhkdAddress(data : AnyObject) {
	return request.post(`fengchao/address`, data, { showErrorMessage: true })
}
/**
 * 编辑地址 
 */
export function editJhkdAddress(data : AnyObject) {
	return request.put(`fengchao/address/${data.id}`, data, { showSuccessMessage: true, showErrorMessage: true })
}
/**
 * 删除地址 
 */
export function deleteJhkdAddress(id : number) {
	return request.delete(`fengchao/address/${id}`, { showSuccessMessage: true, showErrorMessage: true })
}
/**
 * 地理位置逆编码
 */
export function getJhkdRegeo(data : AnyObject) {
	return request.get('fengchao/regeo', data)
}
/**
 * 快递品牌列表
 */
export function getBrand() {
	return request.get('fengchao/brand')
}
/**
 * 快递与下单
 */
export function preOrder(data : AnyObject) {
	return request.post(`fengchao/preorder`, data)
}
/**
 * 创建订单
 */
export function createOrder(data : AnyObject) {
	return request.post(`fengchao/createorder`, data)
}
export function checkFenxiao(params : Record<string, any>) {
	return request.post(`fengchao/checkfenxiao`, params)
}