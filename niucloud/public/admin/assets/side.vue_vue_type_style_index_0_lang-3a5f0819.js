import{d as A,D as q,j as z,r as g,l as H,bM as C,Q as J,h as n,s as d,w as l,e as i,a as r,u as c,c as _,A as K,T as M,F as k,t as S,bt as L,B as w,x as Q,f as T,J as G,bE as O,cM as P,cK as W,V as X,N as Y,z as Z}from"./index-a7efb343.js";/* empty css                     *//* empty css                */import"./el-tooltip-4ed993c7.js";/* empty css                  */import"./el-sub-menu-4ed993c7.js";import{_ as I}from"./index.vue_vue_type_script_setup_true_lang-3b487378.js";/* empty css                 *//* empty css                        */import{_ as ee}from"./icon-addon-9edd5c99.js";import{_ as ae}from"./menu-item.vue_vue_type_style_index_0_lang-8fe52f72.js";const te={class:"w-[124px] px-[8px] bg-[#282c34] h-screen one-menu"},se={key:0,class:"logo flex items-center m-auto h-[64px]"},ne=r("div",{class:"flex justify-center items-center w-full h-[40px]"},[r("img",{class:"max-w-[40px]",src:ee,alt:"","object-fit":"contain"})],-1),oe={key:1,class:"logo flex items-center justify-center h-[64px]"},le=r("i",{class:"text-3xl iconfont iconyunkongjian"},null,-1),ce=[le],re={key:0,class:"w-[16px] h-[16px] relative flex justify-center"},ue={class:"relative flex-1 w-0"},de={class:"ml-[10px] w-full truncate"},ie=r("div",{class:"h-[48px]"},null,-1),_e={class:"w-[140px] h-[64px] flex items-center justify-center text-[16px] border-0 border-b-[1px] border-solid border-[#eee]"},pe=r("div",{class:"h-[48px]"},null,-1),Se=A({__name:"side",setup(he){const x=q(),p=z(),s=Q(),j=T(),a=p.siteInfo,R=p.routers,B=p.addonIndexRoute,h=g([]),u=g([]),v={},V=H(()=>p.siteInfo.icon?p.siteInfo.icon:x.website.icon);if(R.forEach(e=>{e.original_name=e.name,e.meta.addon==""?(e.children&&e.children.length&&(e.name=C(e.children)),h.value.push(e)):e.meta.addon!=""&&(a==null?void 0:a.apps.length)<=1&&(a==null?void 0:a.apps[0].key)==e.meta.addon?e.children?(e.children.forEach(t=>{t.original_name=t.name,t.children&&t.children.length&&(t.name=C(t.children))}),h.value.unshift(...e.children)):h.value.unshift(e):v[e.meta.addon]=e}),(a==null?void 0:a.apps.length)>1){const e=[];a==null||a.apps.forEach(t=>{var f;e.push({path:v[t.key]?v[t.key].path:"",meta:{icon:((f=v[t.key])==null?void 0:f.meta.icon)||"element Setting",addon:t.key,title:t.title,app:t.app,show:!0},original_name:t.key,name:B[t.key]})}),h.value.unshift(...e)}const m=g(s.matched[1].name);return J(s,()=>{(a==null?void 0:a.apps.length)>1?(u.value=s.matched[1].children,m.value=s.matched[1].name):s.meta.addon==""?(m.value=s.matched[1].name,u.value=s.matched[1].children??[]):s.meta.addon&&s.meta.addon!=(a==null?void 0:a.apps[0].key)?(m.value="/site/app",u.value=s.matched[1].children??[]):(m.value=s.matched[2].name,u.value=s.matched[2].children??[])},{immediate:!0}),(e,t)=>{const f=G,D=O,N=I,F=P,b=W,E=X,U=Y,$=Z;return n(),d($,{class:"w-100 h-screen"},{default:l(()=>[i(U,{class:"p-0 flex"},{default:l(()=>[r("div",te,[i(D,{class:"logo-wrap"},{default:l(()=>[c(x).menuIsCollapse?(n(),_("div",oe,ce)):(n(),_("div",se,[i(f,{style:{width:"40px",height:"40px"},src:c(K)(c(V)),fit:"contain"},{error:l(()=>[ne]),_:1},8,["src"])]))]),_:1}),i(E,{class:"h-[calc( 100vh - 64px )]"},{default:l(()=>[i(b,{"default-active":m.value,router:!0,class:"aside-menu","unique-opened":!0,collapse:c(x).menuIsCollapse},{default:l(()=>[(n(!0),_(k,null,M(h.value,(o,y)=>(n(),_(k,{key:y},[o.meta.show?(n(),d(F,{key:0,index:o.original_name,onClick:me=>c(j).push({name:o.name})},{title:l(()=>[r("div",ue,[r("span",de,S(o.meta.short_title||o.meta.title),1)])]),default:l(()=>[o.meta.icon?(n(),_("div",re,[c(L)(o.meta.icon)?(n(),d(f,{key:0,class:"w-[16px] h-[16px] rounded-[50%] overflow-hidden",src:o.meta.icon,fit:"fill"},null,8,["src"])):(n(),d(N,{key:1,name:o.meta.icon,class:"absolute top-[50%] -translate-y-[50%]"},null,8,["name"]))])):w("",!0)]),_:2},1032,["index","onClick"])):w("",!0)],64))),128))]),_:1},8,["default-active","collapse"]),ie]),_:1})]),u.value.length?(n(),d(E,{key:0,class:"two-menu w-[140px]"},{default:l(()=>[r("div",_e,S(c(s).matched[1].meta.title),1),i(b,{"default-active":c(s).name,router:!0,class:"aside-menu",collapse:c(x).menuIsCollapse},{default:l(()=>[(n(!0),_(k,null,M(u.value,(o,y)=>(n(),d(ae,{routes:o,key:y},null,8,["routes"]))),128))]),_:1},8,["default-active","collapse"]),pe]),_:1})):w("",!0)]),_:1})]),_:1})}}});export{Se as _};
