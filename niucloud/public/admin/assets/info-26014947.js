import{d as M,bZ as P,x as Q,f as Y,r as k,n as Z,a2 as z,R as G,h as r,c as _,e,w as t,u as a,aQ as K,a as o,t as i,i as v,q as d,s as f,A as E,F as h,T,B as $,E as U,aR as W,a7 as X,L as ee,J as te,al as oe,a1 as se,M as ae,Y as le}from"./index-6405d5ac.js";/* empty css                   *//* empty css                     *//* empty css               *//* empty css                 *//* empty css                        *//* empty css                *//* empty css                       *//* empty css                  */import{_ as ie}from"./site_logo-5ed68b79.js";import{n as ne}from"./site-0fb01aff.js";import{_ as re}from"./edit-site.vue_vue_type_script_setup_true_lang-9c80b2df.js";/* empty css                  *//* empty css                   *//* empty css                       *//* empty css                 *//* empty css                     *//* empty css                  *//* empty css                  *//* empty css                  *//* empty css                  */import"./member_head-d9fd7b2c.js";import"./user-d23e65b7.js";import"./addon-97b299e7.js";const de={class:"main-container"},ce={class:"text-large font-600 mr-3"},_e={class:"input-width"},ue={key:1,class:"w-20 h-20",src:ie,alt:""},pe={class:"input-width"},me={class:"input-width"},fe={class:"input-width"},ve={class:"input-width"},he={class:"input-width"},be={class:"flex flex-wrap"},xe={key:0,class:"flex w-[300px] border border-[var(--el-color-info-light-7)] border-solid p-[10px] !mr-[10px] !mb-[10px] rounded-md"},ge={class:"w-[60px] h-[60px] mr-[10px] rounded-md overflow-hidden"},we={class:"image-error"},ye={class:"flex-1 w-0 flex flex-col justify-center leading-tight"},ke={class:"font-bold truncate"},Ee=["title"],De={class:"flex flex-wrap"},Ce={key:0,class:"flex w-[300px] border border-[var(--el-color-info-light-7)] border-solid p-[10px] !mr-[10px] !mb-[10px] rounded-md"},Se={class:"w-[60px] h-[60px] mr-[10px] rounded-md overflow-hidden"},Be={class:"image-error"},Fe={class:"flex-1 w-0 flex flex-col justify-center leading-tight"},Ne={class:"font-bold truncate"},Te=["title"],$e={class:"fixed-footer-wrap"},Ie={class:"fixed-footer"},lt=M({__name:"info",setup(Re){const I=P(),b=Q(),R=Y(),j=b.meta.title,x=parseInt(b.query.id),g=k(!0),D={site_id:0,site_name:"",expire_time:0,group_id:0,keywords:"",business_hours:"",logo:"",desc:"",latitude:"",longitude:"",province_id:"",city_id:"",district_id:"",address:"",full_address:"",phone:"",group_name:"",status:0,create_time:0,site_addons:[],status_name:"",site_domain:""},l=Z({...D}),C=async(p=0)=>{Object.assign(l,D);const n=await(await ne(p)).data;Object.keys(l).forEach(u=>{n[u]!=null&&(l[u]=n[u])}),g.value=!1};x?C(x):g.value=!1;const L=()=>{C(x)},w=k(),y=k(null),V=p=>{y.value.setFormData(l),y.value.showDialog=!0},q=async p=>{S()},S=()=>{I.removeTab(b.path),R.push({path:"/admin/site/list"})};return(p,n)=>{const u=U,O=W,B=X,c=ee,m=te,A=oe,F=z("icon-picture"),N=se,H=ae,J=le;return G((r(),_("div",de,[e(B,{class:"card !border-none",shadow:"never"},{default:t(()=>[e(O,{icon:a(K),onBack:n[1]||(n[1]=s=>p.$router.back())},{content:t(()=>[o("span",ce,i(a(j)),1)]),extra:t(()=>[e(u,{class:"w-[100px]",type:"primary",onClick:n[0]||(n[0]=s=>V(w.value))},{default:t(()=>[v(i(a(d)("edit")),1)]),_:1})]),_:1},8,["icon"])]),_:1}),e(H,{class:"page-form mt-[15px]",model:l,"label-width":"90px",ref_key:"formRef",ref:w},{default:t(()=>[e(B,{class:"box-card !border-none relative",shadow:"never"},{default:t(()=>[e(c,{label:a(d)("siteName")},{default:t(()=>[o("div",_e,i(l.site_name),1)]),_:1},8,["label"]),e(c,{label:a(d)("siteLogo")},{default:t(()=>[l.logo?(r(),f(m,{key:0,class:"w-20 h-20",src:a(E)(l.logo),fit:"contain"},null,8,["src"])):(r(),_("img",ue))]),_:1},8,["label"]),e(c,{label:a(d)("siteDomain")},{default:t(()=>[o("div",pe,i(l.site_domain||""),1)]),_:1},8,["label"]),e(c,{label:a(d)("groupName")},{default:t(()=>[o("div",me,i(l.group_name||""),1)]),_:1},8,["label"]),e(c,{label:a(d)("keywords")},{default:t(()=>[o("div",fe,i(l.keywords||""),1)]),_:1},8,["label"]),e(c,{label:a(d)("status")},{default:t(({})=>[e(A,{class:"ml-2",type:l.status==1?"success":"error"},{default:t(()=>[v(i(l.status_name),1)]),_:1},8,["type"])]),_:1},8,["label"]),e(c,{label:a(d)("createTime")},{default:t(()=>[o("div",ve,i(l.create_time||""),1)]),_:1},8,["label"]),e(c,{label:a(d)("expireTime")},{default:t(()=>[o("div",he,i(l.expire_time||""),1)]),_:1},8,["label"]),e(c,{label:a(d)("app")},{default:t(()=>[o("div",be,[(r(!0),_(h,null,T(l.site_addons,s=>(r(),_(h,null,[s.type=="app"?(r(),_("div",xe,[o("div",ge,[s.icon?(r(),f(m,{key:0,src:a(E)(s.icon),class:"w-full h-full"},null,8,["src"])):(r(),f(m,{key:1,class:"w-full h-full"},{error:t(()=>[o("div",we,[e(N,null,{default:t(()=>[e(F)]),_:1})])]),_:1}))]),o("div",ye,[o("div",ke,i(s.title),1),o("div",{class:"text-gray-400 mt-[10px] truncate",title:s.desc},i(s.desc),9,Ee)])])):$("",!0)],64))),256))])]),_:1},8,["label"]),e(c,{label:a(d)("addon")},{default:t(()=>[o("div",De,[(r(!0),_(h,null,T(l.site_addons,s=>(r(),_(h,null,[s.type=="addon"?(r(),_("div",Ce,[o("div",Se,[s.icon?(r(),f(m,{key:0,src:a(E)(s.icon),class:"w-full h-full"},null,8,["src"])):(r(),f(m,{key:1,class:"w-full h-full"},{error:t(()=>[o("div",Be,[e(N,null,{default:t(()=>[e(F)]),_:1})])]),_:1}))]),o("div",Fe,[o("div",Ne,i(s.title),1),o("div",{class:"text-gray-400 mt-[10px] truncate",title:s.desc},i(s.desc),9,Te)])])):$("",!0)],64))),256))])]),_:1},8,["label"])]),_:1})]),_:1},8,["model"]),e(re,{ref_key:"editSiteDialog",ref:y,onComplete:n[2]||(n[2]=s=>L())},null,512),o("div",$e,[o("div",Ie,[e(u,{type:"primary",onClick:n[3]||(n[3]=s=>q(w.value))},{default:t(()=>[v(i(a(d)("confirm")),1)]),_:1}),e(u,{onClick:n[4]||(n[4]=s=>S())},{default:t(()=>[v(i(a(d)("cancel")),1)]),_:1})])])])),[[J,g.value]])}}});export{lt as default};
