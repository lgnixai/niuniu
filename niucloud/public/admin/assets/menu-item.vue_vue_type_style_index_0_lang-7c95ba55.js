import{d as C,j as h,D as M,l as y,r as N,Q as R,u as t,h as s,c as m,s as c,w as _,B as i,a as k,t as w,F as S,T as j,f as D,cL as F,cM as L,x as V}from"./index-a7efb343.js";import"./el-sub-menu-4ed993c7.js";import{_ as $}from"./index.vue_vue_type_script_setup_true_lang-3b487378.js";const q={key:0,class:"w-[16px] h-[16px] relative flex items-center"},A={class:"ml-[10px]"},K={key:0,class:"w-[16px] h-[16px] relative flex items-center"},O={class:"ml-[10px]"},Q=C({__name:"menu-item",props:{routes:{type:Object,required:!0},level:{type:Number,default:1}},setup(r){const u=r,b=D(),d=V(),f=h(),g=h().routers;M();const n=y(()=>u.routes.meta);y(()=>{var o,l;const e={};return(o=f.siteInfo)==null||o.apps.forEach(a=>{e[a.key]=a}),(l=f.siteInfo)==null||l.site_addons.forEach(a=>{e[a.key]=a}),e});const E=y(()=>{var e;return(e=f.siteInfo)==null?void 0:e.site_addons.map(o=>o.key)}),p={};g.forEach(e=>{e.original_name=e.name,e.meta.addon&&(p[e.meta.addon]=e)});const x=N(null);return R(d,()=>{u.routes.name=="addon_list"&&(E.value.includes(d.meta.addon)&&p[d.meta.addon]?x.value=p[d.meta.addon]:x.value=null)},{immediate:!0}),(e,o)=>{const l=$,a=F,B=L;return t(n).show?(s(),m(S,{key:0},[t(n).type==0&&r.routes.children?(s(),c(a,{key:0,index:String(r.routes.name)},{title:_(()=>[u.level==1?(s(),m("div",q,[t(n).icon?(s(),c(l,{key:0,name:t(n).icon,class:"absolute !w-auto"},null,8,["name"])):i("",!0)])):i("",!0),k("span",A,w(t(n).title),1)]),default:_(()=>[(s(!0),m(S,null,j(r.routes.children,(v,I)=>(s(),c(Q,{routes:v,key:I,level:u.level+1},null,8,["routes","level"]))),128))]),_:1},8,["index"])):(s(),c(B,{key:1,index:String(r.routes.name),onClick:o[0]||(o[0]=v=>t(b).push({name:r.routes.name}))},{title:_(()=>[k("span",O,w(t(n).title),1)]),default:_(()=>[u.level==1?(s(),m("div",K,[t(n).icon?(s(),c(l,{key:0,name:t(n).icon,class:"absolute !w-auto"},null,8,["name"])):i("",!0)])):i("",!0)]),_:1},8,["index"]))],64)):i("",!0)}}});export{Q as _};
