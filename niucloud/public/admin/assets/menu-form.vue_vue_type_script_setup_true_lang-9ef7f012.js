import{d as T,r as R,l as c,q as a,bs as f,bt as q,h,c as v,a as m,t as d,u as e,e as o,w as u,F as w,i as b,R as V,a0 as y,B as k,K as C,L as F,au as A,av as D,E as L,M as S}from"./index-a7efb343.js";/* empty css                *//* empty css                  *//* empty css                       *//* empty css                 */import"./el-form-item-4ed993c7.js";/* empty css                 */const W={class:"panel-title"},j={class:"form-tip"},G={class:"mt-[40px]"},Z=T({__name:"menu-form",props:{data:{type:Object,default:()=>{}},index:{type:Number,default:0},subIndex:{type:Number,default:-1}},emits:["delete"],setup(N,{expose:x,emit:E}){const i=N,_=R(),l=c({get(){return i.data},set(s){}}),P=c(()=>({name:[{required:!0,message:a("menuNamePlaceholder"),trigger:"blur"},{validator:(s,t,r)=>{l.value.sub_button&&f(t)>8?r(new Error(a("menuNameTips"))):!l.value.sub_button&&f(t)>16?r(new Error(a("subMenuNameTips"))):r()},trigger:["blur","change"]}],url:[{required:!l.value.sub_button||!l.value.sub_button.length,message:a("webpageUrlPlaceholder"),trigger:"blur"},{validator:(s,t,r)=>{!l.value.sub_button||!l.value.sub_button.length?q(t)?r():r(new Error(a("menuUrlErrorTips"))):r()}}],appid:[{required:(!l.value.sub_button||!l.value.sub_button.length)&&l.value.type=="miniprogram",message:a("weappAppidPlaceholder"),trigger:"blur"}],pagepath:[{required:(!l.value.sub_button||!l.value.sub_button.length)&&l.value.type=="miniprogram",message:a("weappPagePlaceholder"),trigger:"blur"}]})),U=()=>{E("delete")};return x({validate:async()=>{let s=!1;return await _.value.validate(async t=>{s=t}),s},index:i.index,subIndex:i.subIndex}),(s,t)=>{const r=C,n=F,g=A,M=D,B=L,I=S;return h(),v(w,null,[m("div",W,d(e(l).sub_button?e(a)("menuNameInfo"):e(a)("subMenuNameInfo")),1),o(I,{model:e(l),"label-width":"140px",ref_key:"formRef",ref:_,rules:e(P),class:"page-form mt-[30px]"},{default:u(()=>[o(n,{label:e(a)("menuName"),prop:"name"},{default:u(()=>[o(r,{modelValue:e(l).name,"onUpdate:modelValue":t[0]||(t[0]=p=>e(l).name=p),modelModifiers:{trim:!0},placeholder:e(a)("menuNamePlaceholder"),class:"input-width",clearable:""},null,8,["modelValue","placeholder"]),m("div",j,d(e(l).sub_button?e(a)("menuNameTips"):e(a)("subMenuNameTips")),1)]),_:1},8,["label"]),!e(l).sub_button||!e(l).sub_button.length?(h(),v(w,{key:0},[o(n,{label:e(a)("messageType")},{default:u(()=>[o(M,{modelValue:e(l).type,"onUpdate:modelValue":t[1]||(t[1]=p=>e(l).type=p)},{default:u(()=>[o(g,{label:"view"},{default:u(()=>[b(d(e(a)("skipWebpage")),1)]),_:1}),o(g,{label:"miniprogram"},{default:u(()=>[b(d(e(a)("skipWeapp")),1)]),_:1})]),_:1},8,["modelValue"])]),_:1},8,["label"]),o(n,{label:e(a)("webpageUrl"),prop:"url"},{default:u(()=>[o(r,{modelValue:e(l).url,"onUpdate:modelValue":t[2]||(t[2]=p=>e(l).url=p),modelModifiers:{trim:!0},placeholder:e(a)("webpageUrlPlaceholder"),class:"input-width",clearable:""},null,8,["modelValue","placeholder"])]),_:1},8,["label"]),V(o(n,{label:e(a)("weappAppid"),prop:"appid"},{default:u(()=>[o(r,{modelValue:e(l).appid,"onUpdate:modelValue":t[3]||(t[3]=p=>e(l).appid=p),modelModifiers:{trim:!0},placeholder:e(a)("weappAppidPlaceholder"),class:"input-width",clearable:""},null,8,["modelValue","placeholder"])]),_:1},8,["label"]),[[y,e(l).type=="miniprogram"]]),V(o(n,{label:e(a)("weappPage"),prop:"pagepath"},{default:u(()=>[o(r,{modelValue:e(l).pagepath,"onUpdate:modelValue":t[4]||(t[4]=p=>e(l).pagepath=p),modelModifiers:{trim:!0},placeholder:e(a)("weappPagePlaceholder"),class:"input-width",clearable:""},null,8,["modelValue","placeholder"])]),_:1},8,["label"]),[[y,e(l).type=="miniprogram"]])],64)):k("",!0),m("div",G,[o(B,{type:"primary",link:"",onClick:U},{default:u(()=>[b(d(e(a)("deleteMemu")),1)]),_:1})])]),_:1},8,["model","rules"])],64)}}});export{Z as _};
