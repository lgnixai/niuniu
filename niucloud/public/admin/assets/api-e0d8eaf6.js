var h=Object.defineProperty;var p=(a,e,s)=>e in a?h(a,e,{enumerable:!0,configurable:!0,writable:!0,value:s}):a[e]=s;var r=(a,e,s)=>(p(a,typeof e!="symbol"?e+"":e,s),s);import{b2 as d,G as o,b9 as c,U as u,q as t,bt as g,j as f,O as i}from"./index-a7efb343.js";class l{constructor(){r(this,"instance");r(this,"messageCache",new Map);this.instance=d.create({baseURL:"/adminapi/".substr(-1)=="/"?"/adminapi/":"/adminapi//",timeout:0,headers:{"Content-Type":"application/json",lang:o.get("lang")??"zh-cn"}}),this.instance.interceptors.request.use(e=>(c()&&(e.headers.token=c()),e.headers["site-id"]=o.get("siteId")||0,e),e=>Promise.reject(e)),this.instance.interceptors.response.use(e=>{if(e.request.responseType!="blob"){const s=e.data;return s.ResultCode!=100?(this.handleAuthError(s.Reason),s.ResultCode!=401&&e.config.showErrorMessage!==!1&&this.showElMessage({message:s.Reason,type:"error",dangerouslyUseHTMLString:!0,duration:5e3}),Promise.reject(new Error(s.Reason||"Error"))):(e.config.showSuccessMessage&&u({message:s.Reason,type:"success"}),s)}return e.data},e=>(this.handleNetworkError(e),Promise.reject(e)))}get(e,s){return this.instance.get(e,s)}post(e,s,n){return this.instance.post(e,s,n)}put(e,s,n){return this.instance.put(e,s,n)}delete(e,s){return this.instance.delete(e,s)}handleNetworkError(e){let s="";if(e.response&&e.response.status)switch(e.response.status){case 400:s=t("axios.400");break;case 401:s=t("axios.401");break;case 403:s=t("axios.403");break;case 404:s=(g(e.response.config.baseURL)?e.response.config.baseURL:`${location.origin}${e.response.config.baseURL}`)+t("axios.baseUrlError");break;case 405:s=t("axios.405");break;case 408:s=t("axios.408");break;case 409:s=t("axios.409");break;case 500:s=t("axios.500");break;case 501:s=t("axios.501");break;case 502:s=t("axios.502");break;case 503:s=t("axios.503");break;case 504:s=t("axios.504");break;case 505:s=t("axios.505");break}e.message.includes("timeout")&&(s=t("axios.timeout")),e.code=="ERR_NETWORK"&&(s=(g(e.config.baseURL)?e.config.baseURL:`${location.origin}${e.config.baseURL}`)+t("axios.baseUrlError")),s&&this.showElMessage({dangerouslyUseHTMLString:!0,duration:5e3,message:s,type:"error"})}handleAuthError(e){switch(e){case 401:f().logout();break}}showElMessage(e){const s=e.message,n=this.messageCache.get(s);(!n||Date.now()-n.timestamp>5e3)&&(this.messageCache.set(s,{timestamp:Date.now()}),u(e))}}const b=new l;function w(){return i.get("fengchao/site/api/list")}function x(){return i.get("fengchao/site/api/createNewApi")}function U(a){return i.post("fengchao/site/api/add",a,{showErrorMessage:!0,showSuccessMessage:!0})}function E(a){return i.delete(`fengchao/site/api/${a}`,{showErrorMessage:!0,showSuccessMessage:!0})}function L(a){return i.get("fengchao/site/siteBalance",{params:a})}function M(){return i.get("fengchao/site/siteBalanceSum")}function S(a){return i.get(`fengchao/site/api/getApi/${a}`)}function A(){return i.get("fengchao/site/api/domain")}function y(){return i.get("sandbox/fake/list")}function $(a,e){return i.get(`sandbox/fake/${a}/${e}`)}function j(a,e){return b.post(a,e)}export{U as a,w as b,S as c,E as d,$ as e,y as f,x as g,A as h,L as i,M as j,j as s};