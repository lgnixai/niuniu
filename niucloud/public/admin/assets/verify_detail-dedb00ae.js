import{d as F,x as N,f as T,bR as L,r as v,R as q,h as a,c as l,e as i,w as x,u as n,aQ as A,a as e,t,q as o,F as _,T as m,s as S,A as $,U as j,aR as z,a7 as G,ad as H,ae as M,Y as O}from"./index-a7efb343.js";/* empty css                   *//* empty css                 *//* empty css                    */import"./el-tooltip-4ed993c7.js";/* empty css                  *//* empty css                     *//* empty css                        *//* empty css               *//* empty css                *//* empty css                       */import{g as P}from"./verify-b0c8f697.js";const Q={class:"main-container"},U={class:"panel-title !text-sm"},Y={class:"flex items-center mt-[15px]"},J={class:"text-[14px] w-[130px] text-right mr-[20px]"},K={class:"text-[14px] text-[#666666]"},W={class:"flex items-center mt-[15px]"},X={class:"text-[14px] w-[130px] text-right mr-[20px]"},Z=e("span",{class:"text-[14px] text-[#666666]"}," 已核销 ",-1),I={class:"flex items-center mt-[15px]"},ee={class:"text-[14px] w-[130px] text-right mr-[20px]"},te={class:"text-[14px] text-[#666666]"},se={class:"flex items-center mt-[15px]"},ae={class:"text-[14px] w-[130px] text-right mr-[20px]"},ne={class:"text-[14px] text-[#666666]"},le={class:"text-[14px] w-[130px] text-right mr-[20px]"},oe={class:"text-[14px] text-[#666666]"},re={class:"text-[14px] w-[130px] text-right mr-[20px]"},ie={class:"text-[14px] text-[#666666]"},ce={class:"panel-title !text-sm"},xe={class:"text-[14px] w-[130px] text-right mr-[20px]"},pe={class:"text-[14px] text-[#666666]"},de={class:"panel-title !text-sm"},_e={class:"flex"},me={class:"flex items-center shrink-0"},ue=["src"],he={class:"flex flex-col"},ve={class:"multi-hidden text-[14px]"},Te=F({__name:"verify_detail",setup(fe){const b=N(),E=T(),B=b.meta.title;L();const u=v(!0),w=b.query.code,c=v({}),f=v({}),y=v([]);return(async()=>{if(u.value=!0,w){const r=await(await P(w)).data;if(!r||Object.keys(r).length==0)return j.error(o("memberNull")),setTimeout(()=>{E.go(-1)},2e3),!1;c.value=r,f.value=r.value.content||{},y.value=r.value.list||[],u.value=!1}else u.value=!1})(),(r,k)=>{const C=z,h=G,D=H,R=M,V=O;return q((a(),l("div",Q,[i(h,{class:"card !border-none",shadow:"never"},{default:x(()=>[i(C,{content:n(B),icon:n(A),onBack:k[0]||(k[0]=s=>r.$router.back())},null,8,["content","icon"])]),_:1}),i(h,{class:"box-card mt-[15px] !border-none",shadow:"never"},{default:x(()=>[e("h3",U,t(n(o)("核销信息")),1),e("div",Y,[e("span",J,t(n(o)("核销类型")),1),e("span",K,t(c.value.type_name),1)]),e("div",W,[e("span",X,t(n(o)("核销状态")),1),Z]),e("div",I,[e("span",ee,t(n(o)("核销人员")),1),e("span",te,t(c.value.member?c.value.member.nickname:"--"),1)]),e("div",se,[e("span",ae,t(n(o)("核销时间")),1),e("span",ne,t(c.value.create_time),1)]),(a(!0),l(_,null,m(f.value.fixed,(s,p)=>(a(),l("div",{class:"flex items-center mt-[15px]",key:p},[e("span",le,t(s.title),1),e("span",oe,t(s.value),1)]))),128)),(a(!0),l(_,null,m(c.value.verify_info,(s,p)=>(a(),l("div",{key:p},[(a(!0),l(_,null,m(s,(d,g)=>(a(),l("div",{class:"flex items-center mt-[15px]",key:g},[e("span",re,t(d.name),1),e("span",ie,t(d.value),1)]))),128))]))),128))]),_:1}),(a(!0),l(_,null,m(f.value.diy,(s,p)=>(a(),S(h,{class:"box-card mt-[15px] !border-none",shadow:"never",key:p},{default:x(()=>[e("h3",ce,t(s.title),1),(a(!0),l(_,null,m(s.list,(d,g)=>(a(),l("div",{class:"flex items-center mt-[15px]",key:g},[e("span",xe,t(d.title),1),e("span",pe,t(d.value),1)]))),128))]),_:2},1024))),128)),i(h,{class:"box-card mt-[15px] !border-none",shadow:"never"},{default:x(()=>[e("h3",de,t(n(o)("商品信息")),1),i(R,{data:y.value,size:"large"},{default:x(()=>[i(D,{label:n(o)("商品名称"),align:"left",width:"300"},{default:x(({row:s})=>[e("div",_e,[e("div",me,[e("img",{class:"w-[50px] h-[50px] mr-[10px]",src:n($)(s.cover)},null,8,ue)]),e("div",he,[e("p",ve,t(s.name),1)])])]),_:1},8,["label"]),i(D,{prop:"num",label:n(o)("数量"),"min-width":"50",align:"right"},null,8,["label"])]),_:1},8,["data"])]),_:1})])),[[V,u.value]])}}});export{Te as default};