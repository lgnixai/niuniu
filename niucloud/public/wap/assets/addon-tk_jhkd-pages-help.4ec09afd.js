import{d as a,r as e,o as s,V as o,b as l,w as t,W as n,ai as r,c as u,f as c,u as p,aj as i,ak as m,g as d,h as f,y as v,z as _,D as h,bY as b,bZ as g,_ as j}from"./index-06110d51.js";import{_ as k}from"./tabbar.4bca783d.js";import{h as C}from"./tkjhkd.0c7684f3.js";import{u as w,M as I}from"./useMescroll.d9213849.js";import{M}from"./mescroll-empty.5d0f3d24.js";import"./mescroll-i18n.8d7056c6.js";const x=j(a({__name:"help",setup(a){const{mescrollInit:j,downCallback:x,getMescroll:y}=w(m,i),z=e();let D=e(!1);const E=a=>{let s=e({});D.value=!1,s.value.page=a.num,s.value.page_size=a.size,C(s.value).then((e=>{let s=e.data.data;a.endSuccess(s.length),1==a.num&&(z.value=[]),z.value=z.value.concat(s),D.value=!0})).catch((e=>{console.log("erro",e),D.value=!0,a.endErr()}))};return(a,e)=>{const i=h,m=d(f("u-collapse-item"),b),C=d(f("u-collapse"),g),w=d(f("tabbar"),k);return s(),o(n,null,[l(I,{ref:"mescrollRef",onInit:p(j),onDown:p(x),onUp:E},{default:t((()=>[l(C,{onChange:a.change,onClose:a.close,onOpen:a.open},{default:t((()=>[(s(!0),o(n,null,r(z.value,((a,e)=>(s(),u(m,{title:a.title},{default:t((()=>[l(i,{class:"u-collapse-content"},{default:t((()=>[v(_(a.content),1)])),_:2},1024)])),_:2},1032,["title"])))),256))])),_:1},8,["onChange","onClose","onOpen"]),z.value?c("v-if",!0):(s(),u(M,{key:0,option:{tip:"没有地址数据"}}))])),_:1},8,["onInit","onDown"]),l(w,{addon:"tk_jhkd"})],64)}}}),[["__scopeId","data-v-81a2eb96"]]);export{x as default};
