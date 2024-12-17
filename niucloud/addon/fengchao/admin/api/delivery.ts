import request from '@/utils/request'

/*********************************  物流公司  ***************************************/
/**
 * 获取物流公司分页列表
 * @param params
 * @returns
 */
export function getCompanyPageList(params: Record<string, any>) {
    return request.get(`fengchao/delivery/company`, { params })
}


/**
 * 获取物流公司详情
 * @param company_id 物流公司company_id
 * @returns
 */
export function getCompanyInfo(company_id: number) {
    return request.get(`fengchao/delivery/company/${ company_id }`);
}

/**
 * 添加物流公司
 * @param params
 * @returns
 */
export function addCompany(params: Record<string, any>) {
    return request.post('fengchao/delivery/company', params, { showErrorMessage: true, showSuccessMessage: true })
}

/**
 * 编辑物流公司
 * @param params
 * @returns
 */
export function editCompany(params: Record<string, any>) {
    return request.put(`fengchao/delivery/company/${ params.company_id }`, params, {
        showErrorMessage: true,
        showSuccessMessage: true
    })
}

/**
 * 删除物流公司
 * @param company_id
 * @returns
 */
export function deleteCompany(company_id: number) {
    return request.delete(`fengchao/delivery/company/${ company_id }`, { showErrorMessage: true, showSuccessMessage: true })
}
/**
 * 初始化物流公司
 * @returns
 */
export function initCompany() {
    return request.post(`fengchao/delivery/company/init`, { showErrorMessage: true, showSuccessMessage: true })
}

