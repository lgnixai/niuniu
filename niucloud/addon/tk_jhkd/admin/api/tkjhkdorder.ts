
addon
tk_jhkd
app
adminapi
controller
order
Order.php
route
route.php
model
order
Order.php
service
admin
order
OrderService.php
validate
order
Order.php
admin
api
order.ts
lang
zh-cn
order.order.json
views
order
components
order-edit.vue
order.vue
import request from '@/utils/request'

// USER_CODE_BEGIN -- tkjhkd_order
/**
 * 获取订单列列表
 * @param params
 * @returns
 */
export function getOrderList(params: Record<string, any>) {
    return request.get(`tk_jhkd/order`, {params})
}

/**
 * 获取订单列详情
 * @param id 订单列id
 * @returns
 */
export function getOrderInfo(id: number) {
    return request.get(`tk_jhkd/order/${id}`);
}

/**
 * 添加订单列
 * @param params
 * @returns
 */
export function addOrder(params: Record<string, any>) {
    return request.post('tk_jhkd/order', params, { showErrorMessage: true, showSuccessMessage: true })
}

/**
 * 编辑订单列
 * @param id
 * @param params
 * @returns
 */
export function editOrder(params: Record<string, any>) {
    return request.put(`tk_jhkd/order/${params.id}`, params, { showErrorMessage: true, showSuccessMessage: true })
}

/**
 * 删除订单列
 * @param id
 * @returns
 */
export function deleteOrder(id: number) {
    return request.delete(`tk_jhkd/order/${id}`, { showErrorMessage: true, showSuccessMessage: true })
}

export function getWithMemberList(params: Record<string,any>){
    return request.get('tk_jhkd/member', {params})
}

// USER_CODE_END -- tkjhkd_order