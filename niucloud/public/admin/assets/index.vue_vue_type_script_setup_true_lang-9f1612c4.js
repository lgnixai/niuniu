import{d as y,r as v,l as k,f as C,h as V,s as b,w as l,a as i,e as d,i as f,t as p,u as o,q as r,br as B,bT as E,bU as D,U as P,E as T,X as N}from"./index-6405d5ac.js";/* empty css                  *//* empty css                   *//* empty css                  */const U={class:"dialog-footer"},F=y({__name:"index",props:{show:{type:Boolean,default:!1},type:{type:String,default:""},searchParam:{type:Object,default:()=>({})}},emits:["update:show","close"],setup(m,{emit:n}){const e=m,t=v(!1),c=k({get(){return e.show},set(s){n("update:show",s)}}),h=C(),_=()=>{t.value=!0;const s=h.resolve({path:"/site/setting/export"});E(e.type,{page:1,limit:1,...e.searchParam}).then(a=>{a.data?D(e.type,e.searchParam).then(()=>{t.value=!1,n("close",!1),setTimeout(()=>{window.open(s.href)},100)}):(t.value=!1,P.error(a.msg))}).catch(()=>{t.value=!1})},g=()=>{n("close",!1)};return(s,a)=>{const u=T,x=N;return V(),b(x,{modelValue:o(c),"onUpdate:modelValue":a[0]||(a[0]=w=>B(c)?c.value=w:null),title:o(r)("exportTip"),width:"300px","close-on-click-modal":!0,"close-on-press-escape":!1,"show-close":!1},{footer:l(()=>[i("span",U,[d(u,{onClick:g},{default:l(()=>[f(p(o(r)("cancel")),1)]),_:1}),d(u,{type:"primary",onClick:_,loading:t.value},{default:l(()=>[f(p(o(r)("exportConfirm")),1)]),_:1},8,["loading"])])]),default:l(()=>[i("span",null,p(o(r)("exportPlaceholder")),1)]),_:1},8,["modelValue","title"])}}});export{F as _};