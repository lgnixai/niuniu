import{d as w,r as S,D as C,cO as D,cP as E,l as c,h as T,c as U,e as n,w as f,a as s,t as _,u as o,q as i,br as p,aT as j,bv as B,V as $,bH as N,cQ as x,G as P}from"./index-6405d5ac.js";/* empty css                  *//* empty css                   *//* empty css                     *//* empty css                        *//* empty css                 *//* empty css                  *//* empty css                  */import{_ as q}from"./index.vue_vue_type_script_setup_true_lang-c21881a6.js";import{_ as z}from"./_plugin-vue_export-helper-c27b6911.js";const G={class:"flex"},H={class:"setting-item flex items-center justify-between mb-[10px]"},I={class:"title text-base text-tx-secondary"},M={class:"setting-item flex items-center justify-between mb-[10px]"},O={class:"title text-base text-tx-secondary"},Q={class:"setting-item flex items-center justify-between mb-[10px]"},R={class:"title text-base text-tx-secondary"},A=w({__name:"layout-setting",setup(F){const r=S(!1),t=C(),g=D(),y=E(g),u=c({get(){return t.dark},set(a){t.setTheme("dark",a),y(a),x(t.theme,t.dark?"dark":"light")}}),d=c({get(){return t.tab},set(a){t.$patch(e=>{e.tab=a,P.set({key:"tab",data:a})})}}),m=c({get(){return t.theme},set(a){t.setTheme("theme",a),x(t.theme,t.dark?"dark":"light")}});return(a,e)=>{const b=q,v=j,k=B,V=$,h=N;return T(),U("div",G,[n(b,{name:"element Setting",onClick:e[0]||(e[0]=l=>r.value=!0)}),n(h,{modelValue:r.value,"onUpdate:modelValue":e[4]||(e[4]=l=>r.value=l),title:o(i)("layout.layoutSetting"),size:"300px"},{default:f(()=>[n(V,null,{default:f(()=>[s("div",H,[s("div",I,_(o(i)("layout.darkMode")),1),s("div",null,[n(v,{modelValue:o(u),"onUpdate:modelValue":e[1]||(e[1]=l=>p(u)?u.value=l:null),"active-value":!0,"inactive-value":!1},null,8,["modelValue"])])]),s("div",M,[s("div",O,_(o(i)("layout.themeColor")),1),s("div",null,[n(k,{modelValue:o(m),"onUpdate:modelValue":e[2]||(e[2]=l=>p(m)?m.value=l:null)},null,8,["modelValue"])])]),s("div",Q,[s("div",R,_(o(i)("layout.tab")),1),s("div",null,[n(v,{modelValue:o(d),"onUpdate:modelValue":e[3]||(e[3]=l=>p(d)?d.value=l:null),"active-value":!0,"inactive-value":!1},null,8,["modelValue"])])])]),_:1})]),_:1},8,["modelValue","title"])])}}});const ae=z(A,[["__scopeId","data-v-7ae84374"]]);export{ae as default};
