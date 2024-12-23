import request from '@/utils/request'

/***************************************************** 平台管理 ****************************************************/

/**
 * 配置列表
 * @returns
 */
export function getPlatformList () {
    return request.get('fengchao/platform/list')
}

/**
 * 配置详情
 * @param sms_type
 * @returns
 */
export function getPlatformInfo (type: string) {
    return request.get(`fengchao/platform/config/${type}`,)
}

/**
 * 配置修改
 * @param params
 */
export function editPlatform (params: Record<string, any>) {
    return request.put(`fengchao/platform/config/${params.type}`, params, { showSuccessMessage: true })
}
