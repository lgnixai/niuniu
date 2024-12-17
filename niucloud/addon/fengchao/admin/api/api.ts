import request from '@/utils/request'
import http from '@/utils/http'

/*********************************  站点相关  ***************************************/


/**
 * 站点余额调整
 * @param params
 * @returns
 */
export function getApiList( ) {
    return request.get(`fengchao/site/api/list`)
}

export function getNewApi( ) {
    return request.get(`fengchao/site/api/createNewApi`)
}
export function addApi(params: Record<string, any>) {
    return request.post('fengchao/site/api/add', params, { showErrorMessage: true, showSuccessMessage: true })
}
export function deleteApi(id: number) {
    return request.delete(`fengchao/site/api/${id}`, { showErrorMessage: true, showSuccessMessage: true })
}

/***余额相关***/
export function getSiteBalanceList(params: Record<string, any>) {
    return request.get(`fengchao/site/siteBalance`, { params })
}
export function getSiteBalanceSum() {
    return request.get(`fengchao/site/siteBalanceSum`)
}

/*****沙盒相关****/
export function getApiKeyById(id: number ) {
    return request.get(`fengchao/site/api/getApi/${id}`)
}


export function getApiDomain() {
    return request.get(`fengchao/site/api/domain`)
}

export function getApiNameList() {
    return request.get(`sandbox/fake/list`)
}

export function getApiData(site_id:number,id:number) {
    return request.get(`sandbox/fake/${site_id}/${id}`)
}
/*****沙盒相关****/

export function sendSandBox(url:string,params: Record<string, any>) {
    return http.post(url, params,  )
}
