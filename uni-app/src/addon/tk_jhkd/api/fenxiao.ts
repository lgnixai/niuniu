
import request from '@/utils/request'

/***************************************************** 分销相关接口 ****************************************************/
export function checkFenxiao(params : Record<string, any>) {
	return request.post(`tk_jhkd/checkfenxiao`, params)
}
export function getFenxiaoInfo() {
	return request.get(`tk_jhkd/fenxiao/getfenxiaofnfo`)
}