import{d as U,D as q,j as z,r as y,l as H,bM as E,Q as J,h as n,s as f,w as o,e as r,a as c,u,c as i,A as K,T as M,F as g,t as C,B as k,x as L,f as Q,J as T,bE as G,cM as O,cK as P,V as W,N as X,z as Y}from"./index-6405d5ac.js";/* empty css                     *//* empty css                */import"./el-tooltip-4ed993c7.js";/* empty css                  */import"./el-sub-menu-4ed993c7.js";import{_ as Z}from"./index.vue_vue_type_script_setup_true_lang-c21881a6.js";/* empty css                 *//* empty css                        */import{_ as I}from"./icon-addon-9edd5c99.js";import{_ as ee}from"./menu-item.vue_vue_type_style_index_0_lang-7f775105.js";const ae={class:"w-[64px] bg-[#282c34] h-screen one-menu"},te={key:0,class:"logo flex items-center m-auto h-[64px]"},se=c("div",{class:"flex justify-center items-center w-full h-[40px]"},[c("img",{class:"max-w-[40px]",src:I,alt:"","object-fit":"contain"})],-1),ne={key:1,class:"logo flex items-center justify-center h-[64px]"},oe=c("i",{class:"text-3xl iconfont iconyunkongjian"},null,-1),le=[oe],ce={key:0,class:"w-[16px] h-[16px] relative flex justify-center"},re={class:"relative"},ue={class:"ml-[10px] text-[15px]"},de=c("div",{class:"h-[48px]"},null,-1),ie={class:"w-[190px] h-[64px] flex items-center justify-center text-[16px] border-0 border-b-[1px] border-solid border-[#eee]"},_e=c("div",{class:"h-[48px]"},null,-1),Ce=U({__name:"side",setup(he){const x=q(),_=z(),t=L(),j=Q(),a=_.siteInfo,S=_.routers,R=_.addonIndexRoute,h=y([]),d=y([]),p={},B=H(()=>_.siteInfo.icon?_.siteInfo.icon:x.website.icon);if(S.forEach(e=>{e.original_name=e.name,e.meta.addon==""?(e.children&&e.children.length&&(e.name=E(e.children)),h.value.push(e)):e.meta.addon!=""&&(a==null?void 0:a.apps.length)<=1&&(a==null?void 0:a.apps[0].key)==e.meta.addon?e.children?(e.children.forEach(s=>{s.original_name=s.name,s.children&&s.children.length&&(s.name=E(s.children))}),h.value.unshift(...e.children)):h.value.unshift(e):p[e.meta.addon]=e}),(a==null?void 0:a.apps.length)>1){const e=[];a==null||a.apps.forEach(s=>{p[s.key]&&(p[s.key].name=R[s.key],e.push(p[s.key]))}),h.value.unshift(...e)}const m=y(t.matched[1].name);return J(t,()=>{if((a==null?void 0:a.apps.length)>1)d.value=t.matched[1].children,m.value=t.matched[1].name;else{const e=t.matched[1];e.meta.addon==""?(m.value=t.matched[1].name,d.value=t.matched[1].children??[]):e.meta.addon==(a==null?void 0:a.apps[0].key)?(m.value=t.matched[2].name,d.value=t.matched[2].children??[]):(m.value=t.matched[1].name,d.value=t.matched[1].children??[])}},{immediate:!0}),(e,s)=>{const V=T,D=G,N=Z,F=O,w=P,b=W,$=X,A=Y;return n(),f(A,{class:"w-100 h-screen"},{default:o(()=>[r($,{class:"p-0 flex"},{default:o(()=>[c("div",ae,[r(D,{class:"logo-wrap"},{default:o(()=>[u(x).menuIsCollapse?(n(),i("div",ne,le)):(n(),i("div",te,[r(V,{style:{width:"40px",height:"40px"},src:u(K)(u(B)),fit:"contain"},{error:o(()=>[se]),_:1},8,["src"])]))]),_:1}),r(b,{class:"h-[calc( 100vh - 64px )]"},{default:o(()=>[r(w,{"default-active":m.value,router:!0,class:"aside-menu","unique-opened":!0},{default:o(()=>[(n(!0),i(g,null,M(h.value,(l,v)=>(n(),i(g,{key:v},[l.meta.show?(n(),f(F,{key:0,index:l.original_name,onClick:me=>u(j).push({name:l.name})},{title:o(()=>[c("div",re,[c("span",ue,C(l.meta.short_title||l.meta.title),1)])]),default:o(()=>[l.meta.icon?(n(),i("div",ce,[r(N,{name:l.meta.icon,class:"absolute top-[50%] -translate-y-[50%]"},null,8,["name"])])):k("",!0)]),_:2},1032,["index","onClick"])):k("",!0)],64))),128))]),_:1},8,["default-active"]),de]),_:1})]),d.value.length?(n(),f(b,{key:0,class:"two-menu w-[190px]"},{default:o(()=>[c("div",ie,C(u(t).matched[1].meta.title),1),r(w,{"default-active":u(t).name,router:!0,class:"aside-menu",collapse:u(x).menuIsCollapse},{default:o(()=>[(n(!0),i(g,null,M(d.value,(l,v)=>(n(),f(ee,{routes:l,key:v},null,8,["routes"]))),128))]),_:1},8,["default-active","collapse"]),_e]),_:1})):k("",!0)]),_:1})]),_:1})}}});export{Ce as _};
