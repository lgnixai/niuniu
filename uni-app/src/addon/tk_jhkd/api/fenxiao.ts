
import request from '@/utils/request'

/***************************************************** 分销相关接口 ****************************************************/
export function checkFenxiao(params : Record<string, any>) {
	return request.post(`fengchao/checkfenxiao`, params)
}
export function getFenxiaoInfo() {
	return request.get(`fengchao/fenxiao/getfenxiaofnfo`)
}