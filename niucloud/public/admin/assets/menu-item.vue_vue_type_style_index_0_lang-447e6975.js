import{d as V,j as S,D as R,l as h,r as T,Q as $,u as e,h as t,c as r,s as u,w as m,B as a,a as b,t as f,F as x,T as j,e as D,i as F,f as L,cL as q,aa as A,cM as K,x as O}from"./index-a7efb343.js";import"./el-sub-menu-4ed993c7.js";import"./el-tooltip-4ed993c7.js";/* empty css                  */import{_ as Q}from"./index.vue_vue_type_script_setup_true_lang-3b487378.js";const U={key:0,class:"w-[16px] h-[16px] relative flex items-center"},z={class:"ml-[10px]"},G={key:0,class:"w-[16px] h-[16px] relative flex items-center"},H={class:"ml-[10px]"},J={key:0,class:"w-[16px] h-[16px] relative flex items-center"},P={class:"ml-[10px]"},W={key:2,class:"!border-0 !border-t-[1px] border-solid mx-[25px] bg-[#f7f7f7] my-[5px]"},E=V({__name:"menu-item",props:{routes:{type:Object,required:!0},level:{type:Number,default:1}},setup(o){const i=o,g=L(),_=O(),y=S(),B=S().routers;R();const n=h(()=>i.routes.meta),C=h(()=>{var l,c;const s={};return(l=y.siteInfo)==null||l.apps.forEach(d=>{s[d.key]=d}),(c=y.siteInfo)==null||c.site_addons.forEach(d=>{s[d.key]=d}),s}),I=h(()=>{var s;return(s=y.siteInfo)==null?void 0:s.site_addons.map(l=>l.key)}),v={};B.forEach(s=>{s.original_name=s.name,s.meta.addon&&(v[s.meta.addon]=s)});const p=T(null);return $(_,()=>{i.routes.name=="addon_list"&&(I.value.includes(_.meta.addon)&&v[_.meta.addon]?p.value=v[_.meta.addon]:p.value=null)},{immediate:!0}),(s,l)=>{const c=Q,d=q,N=A,w=K;return e(n).show?(t(),r(x,{key:0},[o.routes.children?(t(),u(d,{key:0,index:String(o.routes.name)},{title:m(()=>[i.level==1?(t(),r("div",U,[e(n).icon?(t(),u(c,{key:0,name:e(n).icon,class:"absolute !w-auto"},null,8,["name"])):a("",!0)])):a("",!0),b("span",z,f(e(n).title),1)]),default:m(()=>[(t(!0),r(x,null,j(o.routes.children,(k,M)=>(t(),u(E,{routes:k,key:M,level:i.level+1},null,8,["routes","level"]))),128)),o.routes.name=="addon_list"?(t(),r(x,{key:0},[p.value?(t(),u(E,{routes:p.value,key:s.index,level:i.level+1},null,8,["routes","level"])):a("",!0)],64)):a("",!0)]),_:1},8,["index"])):(t(),r(x,{key:1},[e(n).addon&&e(n).parent_route&&e(n).parent_route.addon==""?(t(),u(w,{key:0,index:String(o.routes.name),onClick:l[0]||(l[0]=k=>e(g).push({name:o.routes.name}))},{title:m(()=>[D(N,{placement:"right",effect:"light"},{content:m(()=>[F(" 该功能仅限"+f(e(C)[e(n).addon].title)+"使用 ",1)]),default:m(()=>[i.level==1?(t(),r("div",G,[e(n).icon?(t(),u(c,{key:0,name:e(n).icon,class:"absolute !w-auto"},null,8,["name"])):a("",!0)])):a("",!0),b("span",H,f(e(n).title),1)]),_:1})]),_:1},8,["index"])):(t(),u(w,{key:1,index:String(o.routes.name),onClick:l[1]||(l[1]=k=>e(g).push({name:o.routes.name}))},{title:m(()=>[i.level==1?(t(),r("div",J,[e(n).icon?(t(),u(c,{key:0,name:e(n).icon,class:"absolute !w-auto"},null,8,["name"])):a("",!0)])):a("",!0),b("span",P,f(e(n).title),1)]),_:1},8,["index"]))],64)),o.routes.is_border?(t(),r("div",W)):a("",!0)],64)):a("",!0)}}});export{E as _};