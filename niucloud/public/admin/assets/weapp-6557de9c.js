import{d as I,x as S,n as E,r as g,l as W,q as t,h as b,c as K,e as l,w as r,a as d,t as m,u as i,i as v,R as C,s as k,a5 as X,E as Y,ad as A,ae as G,W as H,a7 as J,K as O,L as Q,M as Z,X as ee,Y as te}from"./index-a7efb343.js";/* empty css                   *//* empty css                  *//* empty css                   *//* empty css                */import{_ as ae}from"./index.vue_vue_type_style_index_0_lang-152a96dd.js";import"./el-form-item-4ed993c7.js";/* empty css                 *//* empty css                *//* empty css                      *//* empty css               *//* empty css                  *//* empty css                  *//* empty css                     *//* empty css                  *//* empty css                 *//* empty css                    */import"./el-tooltip-4ed993c7.js";/* empty css                        *//* empty css                  */import{h as oe,i as le,j as ne,k as ie}from"./weapp-bf96780a.js";import{_ as se}from"./cron-info.vue_vue_type_script_setup_true_lang-8bcf85eb.js";/* empty css                    */const re={class:"main-container"},pe={class:"flex justify-between items-center"},de={class:"text-page-title"},me={class:"mt-[20px]"},ue={class:"mt-[16px] flex justify-end"},ce={class:"dialog-footer"},qe=I({__name:"weapp",setup(fe){const D=S().meta.title,a=E({page:1,limit:10,total:0,loading:!0,data:[],searchParam:{title:"",type:"",last_time:""}}),u=(s=1)=>{a.loading=!0,a.page=s,oe({page:a.page,limit:a.limit,...a.searchParam}).then(e=>{a.loading=!1,a.data=e.data.data,a.total=e.data.total}).catch(()=>{a.loading=!1})};u();const c=g(!1),o=E({...{id:0,desc:"",path:"",version:"",type:"weapp"}}),y=g(),T=()=>{o.id=0,o.desc="",o.path="",o.version="",c.value=!0},B=W(()=>({version:[{required:!0,message:t("versionPlaceholder"),trigger:"blur"}],path:[{required:!0,validator:P,trigger:"blur"}]})),P=(s,e,p)=>o.path==""?p(new Error(t("filePlaceholder"))):p(),f=g(!1),z=async s=>{f.value||!s||await s.validate(async e=>{if(e){f.value=!0;const p=o;(o.id>0?le:ne)(p).then(w=>{f.value=!1,c.value=!1,u()}).catch(()=>{f.value=!1})}})},U=s=>{o.id=s.id,o.desc=s.desc,o.path=s.path,o.version=s.version,c.value=!0},$=s=>{X.confirm(t("weappVersionDeleteTips"),t("warning"),{confirmButtonText:t("confirm"),cancelButtonText:t("cancel"),type:"warning"}).then(()=>{ie(s).then(()=>{u()}).catch(()=>{})})},R=g(null);return(s,e)=>{const p=Y,_=A,w=G,j=H,F=J,V=O,h=Q,L=ae,M=Z,N=ee,x=te;return b(),K("div",re,[l(F,{class:"box-card !border-none",shadow:"never"},{default:r(()=>[d("div",pe,[d("span",de,m(i(D)),1),l(p,{type:"primary",onClick:T},{default:r(()=>[v(m(i(t)("addVersion")),1)]),_:1})]),d("div",me,[C((b(),k(w,{data:a.data,size:"large"},{empty:r(()=>[d("span",null,m(a.loading?"":i(t)("emptyData")),1)]),default:r(()=>[l(_,{prop:"version",label:i(t)("version"),"min-width":"150"},null,8,["label"]),l(_,{prop:"create_time",label:i(t)("createTime"),"min-width":"150"},null,8,["label"]),l(_,{label:i(t)("operation"),align:"right",fixed:"right",width:"130"},{default:r(({row:n})=>[l(p,{type:"primary",link:"",onClick:q=>U(n)},{default:r(()=>[v(m(i(t)("edit")),1)]),_:2},1032,["onClick"]),l(p,{type:"primary",link:"",onClick:q=>$(n.id)},{default:r(()=>[v(m(i(t)("delete")),1)]),_:2},1032,["onClick"])]),_:1},8,["label"])]),_:1},8,["data"])),[[x,a.loading]]),d("div",ue,[l(j,{"current-page":a.page,"onUpdate:current-page":e[0]||(e[0]=n=>a.page=n),"page-size":a.limit,"onUpdate:page-size":e[1]||(e[1]=n=>a.limit=n),layout:"total, sizes, prev, pager, next, jumper",total:a.total,onSizeChange:e[2]||(e[2]=n=>u()),onCurrentChange:u},null,8,["current-page","page-size","total"])])])]),_:1}),l(se,{ref_key:"cronDialog",ref:R,onComplete:a},null,8,["onComplete"]),l(N,{modelValue:c.value,"onUpdate:modelValue":e[7]||(e[7]=n=>c.value=n),title:i(t)("editVersion"),width:"550px","destroy-on-close":!0},{footer:r(()=>[d("span",ce,[l(p,{type:"primary",onClick:e[6]||(e[6]=n=>z(y.value))},{default:r(()=>[v(m(i(t)("confirm")),1)]),_:1})])]),default:r(()=>[C((b(),k(M,{model:o,"label-width":"110px",ref_key:"formRef",ref:y,rules:i(B),class:"page-form"},{default:r(()=>[l(h,{label:i(t)("version"),prop:"version"},{default:r(()=>[l(V,{modelValue:o.version,"onUpdate:modelValue":e[3]||(e[3]=n=>o.version=n),modelModifiers:{trim:!0},placeholder:i(t)("versionPlaceholder"),class:"input-width"},null,8,["modelValue","placeholder"])]),_:1},8,["label"]),l(h,{label:i(t)("file"),prop:"path"},{default:r(()=>[l(L,{modelValue:o.path,"onUpdate:modelValue":e[4]||(e[4]=n=>o.path=n),class:"input-width",api:"applet/upload"},null,8,["modelValue"])]),_:1},8,["label"]),l(h,{label:i(t)("desc")},{default:r(()=>[l(V,{type:"textarea",modelValue:o.desc,"onUpdate:modelValue":e[5]||(e[5]=n=>o.desc=n),modelModifiers:{trim:!0},class:"input-width",clearable:""},null,8,["modelValue"])]),_:1},8,["label"])]),_:1},8,["model","rules"])),[[x,s.loading]])]),_:1},8,["modelValue","title"])])}}});export{qe as default};