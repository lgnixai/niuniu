import{bE as r}from"./index-6e20b00f.js";function e(e){return r.get("verify_records",e)}function t(){return r.get("check_verifier")}function n(e){return r.get(`get_verify_by_code/${e}`)}function o(e){return r.post(`verify/${e}`,{},{showErrorMessage:!0})}function s(e){return r.get(`verify_detail/${e}`,{},{showErrorMessage:!0})}export{n as a,s as b,e as c,t as g,o as v};
