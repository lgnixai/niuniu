import{d as B,r as p,n as U,l as F,q as t,h as b,s as y,w as r,a as M,e as o,i as V,t as k,u as i,R as C,K as P,L as R,M as q,E as A,X as I,Y as j}from"./index-6405d5ac.js";/* empty css                   *//* empty css                  *//* empty css                   *//* empty css                  *//* empty css                     *//* empty css                 */import{g as L,a as O}from"./api-c38e4264.js";import{_ as $}from"./_plugin-vue_export-helper-c27b6911.js";const K={class:"dialog-footer"},S=B({__name:"api_edit",emits:["complete"],setup(T,{expose:w,emit:x}){const u=p(!1),s=p(!1),_=p(""),f={api_name:"",api_key:"",api_secret:"",callback_url:""},a=U({...f}),v=p(),h=F(()=>({api_name:[{required:!0,message:t("apiNamePlaceholder"),trigger:"blur"}],callback_url:[{required:!0,message:t("urlPlaceholder"),trigger:"blur"}]})),D=async n=>{if(s.value||!n)return;const e=O;await n.validate(async d=>{d&&(s.value=!0,e(a).then(c=>{s.value=!1,u.value=!1,x("complete")}).catch(c=>{s.value=!1}))})};return w({showDialog:u,setFormData:async()=>{Object.assign(a,f),s.value=!0;const n=await(await L()).data;_.value=t("addApi"),n&&Object.keys(a).forEach(e=>{n[e]!=null&&(a[e]=n[e])}),s.value=!1}}),(n,e)=>{const d=P,m=R,c=q,g=A,E=I,N=j;return b(),y(E,{modelValue:u.value,"onUpdate:modelValue":e[8]||(e[8]=l=>u.value=l),title:_.value,width:"700px",class:"diy-dialog-wrap","destroy-on-close":!0},{footer:r(()=>[M("span",K,[o(g,{onClick:e[6]||(e[6]=l=>u.value=!1)},{default:r(()=>[V(k(i(t)("cancel")),1)]),_:1}),o(g,{type:"primary",loading:s.value,onClick:e[7]||(e[7]=l=>D(v.value))},{default:r(()=>[V(k(i(t)("confirm")),1)]),_:1},8,["loading"])])]),default:r(()=>[C((b(),y(c,{model:a,"label-width":"100px",ref_key:"formRef",ref:v,rules:i(h),class:"page-form"},{default:r(()=>[o(m,{label:i(t)("apiName"),prop:"api_name"},{default:r(()=>[o(d,{modelValue:a.api_name,"onUpdate:modelValue":e[0]||(e[0]=l=>a.api_name=l),modelModifiers:{trim:!0},clearable:"",placeholder:i(t)("apiNamePlaceholder"),class:"input-width",maxlength:"10",onBlur:e[1]||(e[1]=l=>a.api_name=l.target.value)},null,8,["modelValue","placeholder"])]),_:1},8,["label"]),o(m,{label:i(t)("api_key")},{default:r(()=>[o(d,{modelValue:a.api_key,"onUpdate:modelValue":e[2]||(e[2]=l=>a.api_key=l),modelModifiers:{trim:!0},readonly:"",maxlength:"100",class:"input-width"},null,8,["modelValue"])]),_:1},8,["label"]),o(m,{label:i(t)("api_secret")},{default:r(()=>[o(d,{modelValue:a.api_secret,"onUpdate:modelValue":e[3]||(e[3]=l=>a.api_secret=l),modelModifiers:{trim:!0},readonly:"",maxlength:"100",class:"input-width"},null,8,["modelValue"])]),_:1},8,["label"]),o(m,{label:i(t)("callbackUrl"),prop:"callback_url"},{default:r(()=>[o(d,{modelValue:a.callback_url,"onUpdate:modelValue":e[4]||(e[4]=l=>a.callback_url=l),modelModifiers:{trim:!0},clearable:"",placeholder:i(t)("urlPlaceholder"),class:"input-width",onBlur:e[5]||(e[5]=l=>a.callback_url=l.target.value)},null,8,["modelValue","placeholder"])]),_:1},8,["label"])]),_:1},8,["model","rules"])),[[N,s.value]])]),_:1},8,["modelValue","title"])}}});const ae=$(S,[["__scopeId","data-v-c5d1cb88"]]);export{ae as default};