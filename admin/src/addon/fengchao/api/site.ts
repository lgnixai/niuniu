import request from '@/utils/request'

/*********************************  站点相关  ***************************************/

/**
 * 站点余额调整
 * @param params
 * @returns
 */
export function adjustBalance (params: Record<string, any>) {
    return request.post(`fengchao/site/balance/adjust`, params, { showSuccessMessage: true })
}

/**
 * 站点余额流水
 * @param params
 * @returns
 */
export function getSiteBalanceList (params: Record<string, any>) {
    return request.get(`fengchao/site/allBalance`, { params })
}

/*********************************  运费添加模板  ***************************************/
/**
 * 获取地址树列表
 * @param level
 */
export function getCompany () {
    return request.get(`fengchao/delivery/company/all`)
}

export function getPriceTemplateInfoBySiteId (site_id: number) {
    return request.get(`fengchao/site/price/template/site/${site_id}`)
}

export function editPriceTemplate (params: Record<string, any>) {
    return request.put(`fengchao/site/price/template/${params.template_id}`, params, {
        showErrorMessage: true,
        showSuccessMessage: true
    })
}

export function importLinePrice (params: Record<string, any>) {
    return request.post(`fengchao/line/price`, params, { showSuccessMessage: true })
}

export function getBrandAll () {
    return request.get('fengchao/delivery/company/all')
}

export function getCannelAll () {
    return request.get('fengchao/channel/all')
}

export function getLinePrice (params: Record<string, any>) {
    return request.post(`fengchao/site/line/price`, params, { showSuccessMessage: true })
}

export function setDiscount (params: Record<string, any>) {
    return request.post(`fengchao/site/discount/price`, params, { showSuccessMessage: true })
}

export function getDiscount (site_id: number) {
    return request.get(`fengchao/site/discount/price/${site_id}`)

}
