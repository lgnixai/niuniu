import{d as w,h as y,c as C,a as d,t as p,u as e,q as t,e as o,w as r,i as m,R as _,a0 as u,K as T,L as U,au as h,av as E,bv as S,aT as k,M as N}from"./index-a7efb343.js";/* empty css                *//* empty css                  *//* empty css                        *//* empty css                 *//* empty css                  */import P from"./index-414a5ed7.js";/* empty css                       *//* empty css                 */import"./el-form-item-4ed993c7.js";import{u as B}from"./poster-888b483e.js";const M={class:"content-wrap"},R={class:"edit-attr-item-wrap"},j={class:"mb-[10px]"},D={class:"text-sm text-gray-400 mt-[10px]"},F={class:"text-sm text-gray-400"},I=w({__name:"edit-page",setup(L,{expose:b}){const l=B();return b({}),(O,a)=>{const c=T,n=U,i=h,g=E,f=P,V=S,v=k,x=N;return y(),C("div",M,[d("div",R,[d("h3",j,p(e(t)("pageContent")),1),o(x,{"label-width":"80px",class:"px-[10px]"},{default:r(()=>[o(n,{label:e(t)("posterName")},{default:r(()=>[o(c,{modelValue:e(l).name,"onUpdate:modelValue":a[0]||(a[0]=s=>e(l).name=s),modelModifiers:{trim:!0},placeholder:e(t)("posterNamePlaceholder"),clearable:"",maxlength:"12","show-word-limit":""},null,8,["modelValue","placeholder"])]),_:1},8,["label"]),o(n,{label:e(t)("bgType")},{default:r(()=>[o(g,{modelValue:e(l).global.bgType,"onUpdate:modelValue":a[1]||(a[1]=s=>e(l).global.bgType=s)},{default:r(()=>[o(i,{label:"url"},{default:r(()=>[m(p(e(t)("bgUrl")),1)]),_:1}),o(i,{label:"color"},{default:r(()=>[m(p(e(t)("bgColor")),1)]),_:1})]),_:1},8,["modelValue"])]),_:1},8,["label"]),_(o(n,{label:e(t)("bgUrl")},{default:r(()=>[o(f,{modelValue:e(l).global.bgUrl,"onUpdate:modelValue":a[2]||(a[2]=s=>e(l).global.bgUrl=s),limit:1},null,8,["modelValue"]),d("div",D,p(e(t)("bgUrlTips")),1)]),_:1},8,["label"]),[[u,e(l).global.bgType=="url"]]),_(o(n,{label:e(t)("bgColor")},{default:r(()=>[o(V,{modelValue:e(l).editComponent.bgColor,"onUpdate:modelValue":a[3]||(a[3]=s=>e(l).editComponent.bgColor=s),predefine:e(l).predefineColors},null,8,["modelValue","predefine"])]),_:1},8,["label"]),[[u,e(l).global.bgType=="color"]]),o(n,{label:e(t)("statusLabel"),class:"display-block"},{default:r(()=>[o(v,{modelValue:e(l).status,"onUpdate:modelValue":a[4]||(a[4]=s=>e(l).status=s),"active-value":1,"inactive-value":0},null,8,["modelValue"]),d("div",F,p(e(t)("statusTips")),1)]),_:1},8,["label"])]),_:1})])])}}}),Z=Object.freeze(Object.defineProperty({__proto__:null,default:I},Symbol.toStringTag,{value:"Module"}));export{Z as _};