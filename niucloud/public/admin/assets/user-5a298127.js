import{O as s}from"./index-a7efb343.js";function r(e){return s.get("user/user",{params:e})}function u(e){return s.get(`user/user/${e}`)}function i(e){return s.post("user/user",e,{showSuccessMessage:!0})}function n(e){return s.delete(`user/user/${e}`,{showSuccessMessage:!0})}function c(e){return s.put(`user/user/${e.uid}`,e,{showSuccessMessage:!0})}function a(e){return s.get("user/user_all",{params:e})}function o(e){return s.get("user/user_select",{params:e})}function g(e){return s.get(`user/user/create_site_limit/${e}`)}function f(e){return s.get(`user/user/create_site_limit/info/${e}`)}function l(e){return s.post("user/user/create_site_limit",e,{showSuccessMessage:!0})}function d(e){return s.put(`user/user/create_site_limit/${e.id}`,e,{showSuccessMessage:!0})}function S(e){return s.delete(`user/user/create_site_limit/${e}`,{showSuccessMessage:!0})}export{l as a,f as b,o as c,u as d,d as e,c as f,a as g,i as h,r as i,n as j,g as k,S as l};