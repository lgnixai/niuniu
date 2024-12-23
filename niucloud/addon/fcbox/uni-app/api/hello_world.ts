
import request from '@/utils/request'

/***************************************************** hello world ****************************************************/
export function getHelloWorld() {
    return request.get(`fcbox/hello_world`)
}

