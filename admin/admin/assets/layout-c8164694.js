import{d as G,x as H,r as i,q as u,h as m,c as b,a as t,e as r,w as s,t as d,u as n,R as K,s as Q,i as x,F as S,T as W,v as L,A as O,B as Z,cb as ee,cc as te,cd as oe,ce as le,J as ae,ad as se,E as ne,ae as ue,a7 as re,bv as ce,V as ie,X as de,Y as _e,p as pe,g as ve}from"./index-6405d5ac.js";/* empty css                   *//* empty css                  *//* empty css                   *//* empty css                     *//* empty css                        *//* empty css                 *//* empty css                  *//* empty css                *//* empty css                 *//* empty css                    */import"./el-tooltip-4ed993c7.js";/* empty css                  *//* empty css                        *//* empty css               *//* empty css                 *//* empty css                        */import{_ as me}from"./icon-addon-9edd5c99.js";import{g as ye}from"./addon-97b299e7.js";import{_ as fe}from"./_plugin-vue_export-helper-c27b6911.js";const E="bussiness",V="/static/resource/images/system/layout_bussiness.png",ge={layout:E,cover:V},be=Object.freeze(Object.defineProperty({__proto__:null,cover:V,default:ge,layout:E},Symbol.toStringTag,{value:"Module"})),T="darkside",z="/static/resource/images/system/layout_darkside.png",he={layout:T,cover:z},xe=Object.freeze(Object.defineProperty({__proto__:null,cover:z,default:he,layout:T},Symbol.toStringTag,{value:"Module"})),B="default",I="/static/resource/images/system/layout_default.png",ke={layout:B,cover:I},je=Object.freeze(Object.defineProperty({__proto__:null,cover:I,default:ke,layout:B},Symbol.toStringTag,{value:"Module"})),D="profession",N="/static/resource/images/system/layout_profession.png",Ce={layout:D,cover:N},we=Object.freeze(Object.defineProperty({__proto__:null,cover:N,default:Ce,layout:D},Symbol.toStringTag,{value:"Module"})),$e=y=>(pe("data-v-93fbdd7e"),y=y(),ve(),y),Se={class:"main-container"},Le={class:"flex justify-between items-center"},Oe={class:"text-page-title"},Ee={class:"mt-[20px]"},Ve={class:"flex items-center"},Te=$e(()=>t("div",{class:"flex items-center w-full h-full"},[t("img",{class:"w-full h-full",src:me,alt:""})],-1)),ze={class:"flex-1 ml-2 truncate"},Be={class:"h-[300px]"},Ie={class:"panel-title !text-sm"},De={class:"flex justify-items-stretch"},Ne=["onClick"],Pe=["src"],Ae=["src"],Me={class:"panel-title !text-sm"},Fe={class:"flex justify-items-stretch"},Re={class:"dialog-footer"},Ue=G({__name:"layout",setup(y){const P=H().meta.title,f=i(!0),c=i({}),k=i([]),_=i(null),p=i({}),j=i([{title:u("manyApp"),key:"system",icon:""}]),C=Object.assign({"/src/layout/bussiness/layout.json":be,"/src/layout/darkside/layout.json":xe,"/src/layout/default/layout.json":je,"/src/layout/profession/layout.json":we});for(const a in C){const e=C[a];k.value.push(e.default)}const w=Object.assign({});ye().then(({data:a})=>{Object.keys(a).forEach(e=>{const g=a[e];g.type=="app"&&j.value.push(g)}),f.value=!1}),(()=>{ee().then(({data:a})=>{c.value=a}),te().then(({data:a})=>{p.value=a})})();const l=i(""),v=i(!1),A=async a=>{a!="system"&&(_.value=null,Object.keys(w).forEach(e=>{e.indexOf(`/addon/${a}/`)!=-1&&(_.value=w[e].default)})),l.value=a,v.value=!0},M=()=>{oe({key:l.value,value:p.value[l.value]?p.value[l.value]:""}),le({key:l.value,value:c.value[l.value]?c.value[l.value]:"default"}),v.value=!1};return(a,e)=>{const g=ae,$=se,h=ne,F=ue,R=re,U=ce,q=ie,J=de,X=_e;return m(),b(S,null,[t("div",Se,[r(R,{class:"box-card !border-none",shadow:"never"},{default:s(()=>[t("div",Le,[t("span",Oe,d(n(P)),1)]),t("div",Ee,[K((m(),Q(F,{data:j.value,size:"large"},{empty:s(()=>[t("span",null,d(f.value?"":n(u)("emptyData")),1)]),default:s(()=>[r($,{prop:"title",label:n(u)("app"),"min-width":"120"},{default:s(({row:o})=>[t("div",Ve,[r(g,{class:"w-[40px] h-[40px] rounded-md overflow-hidden",src:o.icon,fit:"contain"},{error:s(()=>[Te]),_:2},1032,["src"]),t("div",ze,d(o.title),1)])]),_:1},8,["label"]),r($,{label:n(u)("operation"),align:"right",fixed:"right",width:"100"},{default:s(({row:o})=>[r(h,{type:"primary",link:"",onClick:Y=>A(o.key)},{default:s(()=>[x(d(n(u)("setting")),1)]),_:2},1032,["onClick"])]),_:1},8,["label"])]),_:1},8,["data"])),[[X,f.value]])])]),_:1})]),r(J,{modelValue:v.value,"onUpdate:modelValue":e[4]||(e[4]=o=>v.value=o),title:n(u)("selectLayout"),width:"800","destroy-on-close":!0},{footer:s(()=>[t("span",Re,[r(h,{onClick:e[2]||(e[2]=o=>v.value=!1)},{default:s(()=>[x(d(n(u)("cancel")),1)]),_:1}),r(h,{type:"primary",loading:f.value,onClick:e[3]||(e[3]=o=>M())},{default:s(()=>[x(d(n(u)("confirm")),1)]),_:1},8,["loading"])])]),default:s(()=>[t("div",Be,[r(q,null,{default:s(()=>[t("h3",Ie,d(n(u)("layout")),1),t("div",De,[(m(!0),b(S,null,W(k.value,o=>(m(),b("div",{class:L(["w-[180px] h-[130px] mr-[10px] mb-[10px] border hover:border-primary cursor-pointer",{"border-primary":!c.value[l.value]&&o.layout=="default"||c.value[l.value]==o.layout}]),onClick:Y=>c.value[l.value]=o.layout},[t("img",{src:n(O)(o.cover),class:"w-full h-full"},null,8,Pe)],10,Ne))),256)),_.value?(m(),b("div",{key:0,class:L(["w-[180px] h-[130px] mr-[20px] border hover:border-primary cursor-pointer",{"border-primary":!c.value[l.value]&&_.value.layout=="default"||c.value[l.value]==_.value.layout}]),onClick:e[0]||(e[0]=o=>c.value[l.value]=_.value.layout)},[t("img",{src:n(O)(_.value.cover),class:"w-full h-full"},null,8,Ae)],2)):Z("",!0)]),t("h3",Me,d(n(u)("themeColor")),1),t("div",Fe,[r(U,{modelValue:p.value[l.value],"onUpdate:modelValue":e[1]||(e[1]=o=>p.value[l.value]=o),size:"large"},null,8,["modelValue"])])]),_:1})])]),_:1},8,["modelValue","title"])],64)}}});const _t=fe(Ue,[["__scopeId","data-v-93fbdd7e"]]);export{_t as default};
