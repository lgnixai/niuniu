import{O as r}from"./index-6405d5ac.js";function t(e){return r.get("verify/verify/record",{params:e})}function f(e){return r.get(`verify/verify/${e}`)}function s(e){return r.get("verify/verifier",{params:e})}function n(){return r.get("verify/verifier/select")}function u(){return r.get("verify/verifier/type")}function c(e){return r.post("verify/verifier",e,{showSuccessMessage:!0})}function o(e){return r.delete(`verify/verifier/${e}`,{showSuccessMessage:!0})}export{s as a,c as b,u as c,o as d,t as e,n as f,f as g};
