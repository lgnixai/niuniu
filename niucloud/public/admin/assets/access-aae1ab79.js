import{d as $,x as T,f as U,r as d,aK as j,aU as z,o as F,h as w,c as g,e as n,w as s,a,t as o,u as e,q as t,i as r,F as C,A as L,ay as M,az as I,E as D,aL as G,aM as J,aN as K,J as O,aO as P,a7 as Q}from"./index-6405d5ac.js";/* empty css                *//* empty css               *//* empty css                 *//* empty css                        *//* empty css                *//* empty css                  *//* empty css                    */import{g as H}from"./weapp-660adaa9.js";import{a as X}from"./wxoplatform-afe3c9c6.js";const Y={class:"main-container"},Z={class:"flex justify-between items-center"},ee={class:"text-page-title"},te={class:"p-[20px]"},se={class:"panel-title !text-sm"},ae={class:"text-[14px] font-[700]"},ne={class:"text-[#999]"},oe={class:"mt-[20px] mb-[40px] h-[32px]"},le={class:"text-[14px] font-[700]"},pe={class:"text-[#999]"},ie={class:"mt-[20px] mb-[40px] h-[32px]"},ce={class:"text-[14px] font-[700]"},re={class:"text-[#999]"},_e={class:"mt-[20px] mb-[40px] h-[32px]"},de={class:"text-[14px] font-[700]"},ue={class:"text-[#999]"},me=a("div",{class:"mt-[20px] mb-[40px] h-[32px]"},null,-1),he={class:"flex justify-center"},fe={class:"w-[100%] h-[100%] flex items-center justify-center bg-[#f5f7fa]"},xe={class:"mt-[22px] text-center"},ve={class:"text-[12px]"},Ne=$({__name:"access",setup(we){const k=T(),_=U(),E=k.meta.title,h=d("/channel/weapp");d(2);const u=d(""),f=d({}),x=d({}),b=async()=>{await H().then(({data:p})=>{f.value=p,u.value=p.qr_code})};j(async()=>{b(),await z().then(({data:p})=>{x.value=p}),document.addEventListener("visibilitychange",()=>{document.visibilityState==="visible"&&b()})}),F(()=>{document.removeEventListener("visibilitychange",()=>{})});const A=p=>{window.open(p,"_blank")},S=p=>{_.push({path:h.value})},B=()=>{X().then(({data:p})=>{window.open(p)})};return(p,l)=>{const v=M,V=I,i=D,m=G,N=J,y=K,q=O,R=P,W=Q;return w(),g("div",Y,[n(W,{class:"card !border-none",shadow:"never"},{default:s(()=>[a("div",Z,[a("span",ee,o(e(E)),1)]),n(V,{modelValue:h.value,"onUpdate:modelValue":l[0]||(l[0]=c=>h.value=c),class:"mt-[20px]",onTabChange:S},{default:s(()=>[n(v,{label:e(t)("weappAccessFlow"),name:"/channel/weapp"},null,8,["label"]),n(v,{label:e(t)("subscribeMessage"),name:"/channel/weapp/message"},null,8,["label"]),n(v,{label:e(t)("weappRelease"),name:"/channel/weapp/code"},null,8,["label"])]),_:1},8,["modelValue"]),a("div",te,[a("h3",se,o(e(t)("weappInlet")),1),n(R,null,{default:s(()=>[n(y,{span:20},{default:s(()=>[n(N,{class:"!mt-[10px]",active:4,direction:"vertical"},{default:s(()=>[n(m,null,{title:s(()=>[a("p",ae,o(e(t)("weappAttestation")),1)]),description:s(()=>[a("span",ne,o(e(t)("weappAttest")),1),a("div",oe,[n(i,{type:"primary",onClick:l[1]||(l[1]=c=>A("https://mp.weixin.qq.com/"))},{default:s(()=>[r(o(e(t)("clickAccess")),1)]),_:1})])]),_:1}),n(m,null,{title:s(()=>[a("p",le,o(e(t)("weappSetting")),1)]),description:s(()=>[a("span",pe,o(e(t)("emplace")),1),a("div",ie,[x.value.app_id&&x.value.app_secret?(w(),g(C,{key:0},[n(i,{type:"primary",onClick:l[2]||(l[2]=c=>e(_).push("/channel/weapp/config"))},{default:s(()=>[r(o(f.value.app_id?e(t)("seeConfig"):e(t)("weappSettingBtn")),1)]),_:1}),n(i,{type:"primary",plain:"",onClick:B},{default:s(()=>[r(o(f.value.is_authorization?e(t)("refreshAuth"):e(t)("authWeapp")),1)]),_:1})],64)):(w(),g(C,{key:1},[n(i,{type:"primary",onClick:l[3]||(l[3]=c=>e(_).push("/channel/weapp/config"))},{default:s(()=>[r(o(e(t)("weappSettingBtn")),1)]),_:1}),n(i,{type:"primary",plain:"",onClick:l[4]||(l[4]=c=>e(_).push("/channel/weapp/course"))},{default:s(()=>[r("配置教程")]),_:1})],64))])]),_:1}),n(m,null,{title:s(()=>[a("p",ce,o(e(t)("uploadVersion")),1)]),description:s(()=>[a("span",re,o(e(t)("releaseCourse")),1),a("div",_e,[n(i,{type:"primary",plain:"",onClick:l[5]||(l[5]=c=>e(_).push("/channel/weapp/code"))},{default:s(()=>[r(o(e(t)("weappRelease")),1)]),_:1})])]),_:1}),n(m,null,{title:s(()=>[a("p",de,o(e(t)("completeAccess")),1)]),description:s(()=>[a("span",ue,o(e(t)("releaseCourse")),1),me]),_:1})]),_:1})]),_:1}),n(y,{span:4},{default:s(()=>[a("div",he,[n(q,{class:"w-[180px] h-[180px]",src:u.value?e(L)(u.value):""},{error:s(()=>[a("div",fe,[a("span",null,o(u.value?e(t)("fileErr"):e(t)("emptyQrCode")),1)])]),_:1},8,["src"])]),a("div",xe,[a("p",ve,o(e(t)("clickAccess2")),1)])]),_:1})]),_:1})])]),_:1})])}}});export{Ne as default};
