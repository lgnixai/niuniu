import request from '@/utils/request'

/**
 * 获取统计总数
 */
export function getfengchaoCountList() {
    return request.get(`fengchao/stat/total`)
}

/**
 * 获取今日统计总数
 */
export function getfengchaoTodayCountList() {
    return request.get(`fengchao/stat/today`)
}

/**
 * 获取昨日统计总数
 */
export function getfengchaoYesterdayCountList() {
    return request.get(`fengchao/stat/yesterday`)
}

/**
 * 获取统计图数据
 */
export function getfengchaoStat() {
    return request.get(`fengchao/stat`)
}

/**
 * 获取订单统计
 */
export function getfengchaoOrderStat() {
    return request.get(`fengchao/stat/order`)
}

/**
 * 获取商品统计
 */
export function getfengchaoGoodsStat() {
    return request.get(`fengchao/stat/goods`)
}

