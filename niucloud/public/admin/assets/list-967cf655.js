import{d as pe,x as ue,f as me,n as T,l as G,q as t,r as g,h as p,c as b,e as o,w as n,a as w,t as d,u as a,i as m,F as E,T as S,s as v,R as ce,B as U,a5 as fe,E as _e,K as ye,L as he,ac as ge,aD as be,M as ve,a7 as we,ad as Ve,ae as Pe,W as ke,X as Ce,ay as xe,az as De,Y as Te}from"./index-6405d5ac.js";/* empty css                   */import Ee from"./index-4b0a6750.js";/* empty css                    *//* empty css                  *//* empty css                   *//* empty css                      *//* empty css               *//* empty css                  *//* empty css                  *//* empty css                     *//* empty css                  *//* empty css                 *//* empty css                 *//* empty css                    */import"./el-tooltip-4ed993c7.js";/* empty css                        *//* empty css                *//* empty css                     *//* empty css                  */import{h as Ue,j as Fe,k as $e,s as Re,l as Se,m as Ne}from"./diy-83303beb.js";/* empty css                        */import"./index.vue_vue_type_style_index_0_lang-56168b85.js";import"./attachment-054b966e.js";import"./index.vue_vue_type_script_setup_true_lang-f80d36ce.js";/* empty css                 *//* empty css               *//* empty css                    *//* empty css                    */import"./el-dropdown-item-4ed993c7.js";import"./index.vue_vue_type_script_setup_true_lang-0e5521b7.js";/* empty css                   */import"./index.vue_vue_type_script_setup_true_lang-c21881a6.js";import"./_plugin-vue_export-helper-c27b6911.js";import"./sortable.esm-be94e56d.js";const Be={class:"main-container"},Ae={class:"flex justify-between items-center"},ze={class:"text-page-title"},Ie={key:0},qe={key:0,class:"text-primary"},Me={key:1},Le={class:"mt-[16px] flex justify-end"},je={class:"dialog-footer"},Ye={class:"dialog-footer"},Dl=pe({__name:"list",setup(Ge){const O=ue(),F=me(),J=O.meta.title,k=T({}),y=T({title:"",type:""}),K=G(()=>({title:[{required:!0,message:t("titlePlaceholder"),trigger:"blur"}],type:[{required:!0,message:t("pageTypePlaceholder"),trigger:"blur"}]})),N=g(),C=g(!1),W=async r=>{r&&await r.validate(async e=>{if(e){const s={type:y.type,title:y.title},V=F.resolve({path:"/decorate/edit",query:s});window.open(V.href),C.value=!1,y.title="",y.type=""}})},B=(r="")=>{Fe({mode:"",addon:r}).then(e=>{for(let s in k)delete k[s];for(const s in e.data)k[s]=e.data[s]})};B();const A=T({});Ue().then(r=>{if(r.data)for(const e in r.data)A[e]=r.data[e]});const X=r=>{i.searchParam.type="",B(r)},i=T({page:1,limit:10,total:0,loading:!0,data:[],searchParam:{title:"",type:"",mode:"",addon_name:""}}),z=g(),h=(r=1)=>{i.loading=!0,i.page=r,$e({page:i.page,limit:i.limit,...i.searchParam}).then(e=>{i.loading=!1,i.data=e.data.data,i.total=e.data.total}).catch(()=>{i.loading=!1})};h();const H=r=>{const e=F.resolve({path:"/decorate/edit",query:{id:r.id}});window.open(e.href)},Q=r=>{Re({id:r}).then(()=>{h()})},Z=r=>{fe.confirm(t("diyPageDeleteTips"),t("warning"),{confirmButtonText:t("confirm"),cancelButtonText:t("cancel"),type:"warning"}).then(()=>{Se(r).then(()=>{h()}).catch(()=>{})})},ee=r=>{const e=F.resolve({path:"/preview/wap",query:{page:r.type_page+"?id="+r.id}});window.open(e.href)},c=g("wechat"),I=g(""),q=g(0),f=T({wechat:{title:"",desc:"",url:""},weapp:{title:"",url:""}}),x=g(!1),le=G(()=>({})),M=g(),te=async r=>{q.value=r.id,I.value=r.title;const e=r.share?JSON.parse(r.share):{wechat:{title:"",desc:"",url:""},weapp:{title:"",url:""}};e&&(f.wechat=e.wechat,f.weapp=e.weapp),x.value=!0},ae=async r=>{r&&await r.validate(async e=>{e&&Ne({id:q.value,share:JSON.stringify(f)}).then(()=>{h(),x.value=!1}).catch(()=>{})})},oe=r=>{r&&(r.resetFields(),h())};return(r,e)=>{const s=_e,V=ye,_=he,D=ge,$=be,R=ve,L=we,P=Ve,ne=Pe,re=ke,j=Ce,Y=xe,ie=De,se=Ee,de=Te;return p(),b("div",Be,[o(L,{class:"box-card !border-none",shadow:"never"},{default:n(()=>[w("div",Ae,[w("span",ze,d(a(J)),1),o(s,{type:"primary",class:"w-[100px]",onClick:e[0]||(e[0]=l=>C.value=!0)},{default:n(()=>[m(d(a(t)("addDiyPage")),1)]),_:1})]),o(L,{class:"box-card !border-none my-[10px] table-search-wrap",shadow:"never"},{default:n(()=>[o(R,{inline:!0,model:i.searchParam,ref_key:"searchFormDiyPageRef",ref:z},{default:n(()=>[o(_,{label:a(t)("title"),prop:"title"},{default:n(()=>[o(V,{modelValue:i.searchParam.title,"onUpdate:modelValue":e[1]||(e[1]=l=>i.searchParam.title=l),modelModifiers:{trim:!0},placeholder:a(t)("titlePlaceholder")},null,8,["modelValue","placeholder"])]),_:1},8,["label"]),o(_,{label:a(t)("forAddon"),prop:"addon_name"},{default:n(()=>[o($,{modelValue:i.searchParam.addon_name,"onUpdate:modelValue":e[2]||(e[2]=l=>i.searchParam.addon_name=l),placeholder:a(t)("forAddonPlaceholder"),onChange:X},{default:n(()=>[o(D,{label:a(t)("all"),value:""},null,8,["label"]),(p(!0),b(E,null,S(A,(l,u)=>(p(),v(D,{label:l.title,value:u,key:u},null,8,["label","value"]))),128))]),_:1},8,["modelValue","placeholder"])]),_:1},8,["label"]),o(_,{label:a(t)("typeName"),prop:"type"},{default:n(()=>[o($,{modelValue:i.searchParam.type,"onUpdate:modelValue":e[3]||(e[3]=l=>i.searchParam.type=l),placeholder:a(t)("pageTypePlaceholder")},{default:n(()=>[o(D,{label:a(t)("all"),value:""},null,8,["label"]),(p(!0),b(E,null,S(k,(l,u)=>(p(),v(D,{label:l.title,value:u,key:u},null,8,["label","value"]))),128))]),_:1},8,["modelValue","placeholder"])]),_:1},8,["label"]),o(_,null,{default:n(()=>[o(s,{type:"primary",onClick:e[4]||(e[4]=l=>h())},{default:n(()=>[m(d(a(t)("search")),1)]),_:1}),o(s,{onClick:e[5]||(e[5]=l=>oe(z.value))},{default:n(()=>[m(d(a(t)("reset")),1)]),_:1})]),_:1})]),_:1},8,["model"])]),_:1}),ce((p(),v(ne,{data:i.data,size:"large"},{empty:n(()=>[w("span",null,d(i.loading?"":a(t)("emptyData")),1)]),default:n(()=>[o(P,{prop:"page_title",label:a(t)("title"),"min-width":"120"},null,8,["label"]),o(P,{prop:"addon_name",label:a(t)("forAddon"),"min-width":"80"},null,8,["label"]),o(P,{prop:"type_name",label:a(t)("typeName"),"min-width":"80"},null,8,["label"]),o(P,{label:a(t)("status"),"min-width":"80"},{default:n(({row:l})=>[l.type=="DIY_PAGE"?(p(),b("span",Ie,"-")):(p(),b(E,{key:1},[l.is_default==1?(p(),b("span",qe,d(a(t)("isUse")),1)):(p(),b("span",Me,d(a(t)("unused")),1))],64))]),_:1},8,["label"]),o(P,{prop:"update_time",label:a(t)("updateTime"),"min-width":"120"},null,8,["label"]),o(P,{label:a(t)("operation"),fixed:"right",align:"right","min-width":"160"},{default:n(({row:l})=>[o(s,{type:"primary",link:"",onClick:u=>ee(l)},{default:n(()=>[m(d(a(t)("preview")),1)]),_:2},1032,["onClick"]),l.is_default==0?(p(),v(s,{key:0,type:"primary",link:"",onClick:u=>Q(l.id)},{default:n(()=>[m(d(a(t)("use")),1)]),_:2},1032,["onClick"])):U("",!0),l.type=="DIY_PAGE"?(p(),v(s,{key:1,type:"primary",link:"",onClick:u=>te(l)},{default:n(()=>[m(d(a(t)("shareSet")),1)]),_:2},1032,["onClick"])):U("",!0),o(s,{type:"primary",link:"",onClick:u=>H(l)},{default:n(()=>[m(d(a(t)("edit")),1)]),_:2},1032,["onClick"]),l.is_default==0||l.type=="DIY_PAGE"?(p(),v(s,{key:2,type:"primary",link:"",onClick:u=>Z(l.id)},{default:n(()=>[m(d(a(t)("delete")),1)]),_:2},1032,["onClick"])):U("",!0)]),_:1},8,["label"])]),_:1},8,["data"])),[[de,i.loading]]),w("div",Le,[o(re,{"current-page":i.page,"onUpdate:current-page":e[6]||(e[6]=l=>i.page=l),"page-size":i.limit,"onUpdate:page-size":e[7]||(e[7]=l=>i.limit=l),layout:"total, sizes, prev, pager, next, jumper",total:i.total,onSizeChange:e[8]||(e[8]=l=>h()),onCurrentChange:h},null,8,["current-page","page-size","total"])])]),_:1}),o(j,{modelValue:C.value,"onUpdate:modelValue":e[13]||(e[13]=l=>C.value=l),title:a(t)("addPageTips"),width:"350px"},{footer:n(()=>[w("span",je,[o(s,{onClick:e[11]||(e[11]=l=>C.value=!1)},{default:n(()=>[m(d(a(t)("cancel")),1)]),_:1}),o(s,{type:"primary",onClick:e[12]||(e[12]=l=>W(N.value))},{default:n(()=>[m(d(a(t)("confirm")),1)]),_:1})])]),default:n(()=>[o(R,{model:y,"label-width":"90px",ref_key:"formRef",ref:N,rules:a(K)},{default:n(()=>[o(_,{label:a(t)("title"),prop:"title"},{default:n(()=>[o(V,{modelValue:y.title,"onUpdate:modelValue":e[9]||(e[9]=l=>y.title=l),modelModifiers:{trim:!0},placeholder:a(t)("titlePlaceholder"),clearable:"",maxlength:"12","show-word-limit":"",class:"w-full"},null,8,["modelValue","placeholder"])]),_:1},8,["label"]),o(_,{label:a(t)("typeName"),prop:"type"},{default:n(()=>[o($,{modelValue:y.type,"onUpdate:modelValue":e[10]||(e[10]=l=>y.type=l),placeholder:a(t)("pageTypePlaceholder"),class:"!w-full"},{default:n(()=>[(p(!0),b(E,null,S(k,(l,u)=>(p(),v(D,{label:l.title,value:u,key:u},null,8,["label","value"]))),128))]),_:1},8,["modelValue","placeholder"])]),_:1},8,["label"])]),_:1},8,["model","rules"])]),_:1},8,["modelValue","title"]),o(j,{modelValue:x.value,"onUpdate:modelValue":e[20]||(e[20]=l=>x.value=l),title:a(t)("shareSet"),width:"30%"},{footer:n(()=>[w("span",Ye,[o(s,{onClick:e[18]||(e[18]=l=>x.value=!1)},{default:n(()=>[m(d(a(t)("cancel")),1)]),_:1}),o(s,{type:"primary",onClick:e[19]||(e[19]=l=>ae(M.value))},{default:n(()=>[m(d(a(t)("confirm")),1)]),_:1})])]),default:n(()=>[o(ie,{modelValue:c.value,"onUpdate:modelValue":e[14]||(e[14]=l=>c.value=l)},{default:n(()=>[o(Y,{label:a(t)("wechat"),name:"wechat"},null,8,["label"]),o(Y,{label:a(t)("weapp"),name:"weapp"},null,8,["label"])]),_:1},8,["modelValue"]),o(R,{model:f[c.value],"label-width":"90px",ref_key:"shareFormRef",ref:M,rules:a(le)},{default:n(()=>[o(_,{label:a(t)("sharePage")},{default:n(()=>[w("span",null,d(I.value),1)]),_:1},8,["label"]),o(_,{label:a(t)("shareTitle"),prop:"title"},{default:n(()=>[o(V,{modelValue:f[c.value].title,"onUpdate:modelValue":e[15]||(e[15]=l=>f[c.value].title=l),modelModifiers:{trim:!0},placeholder:a(t)("shareTitlePlaceholder"),clearable:"",maxlength:"30","show-word-limit":""},null,8,["modelValue","placeholder"])]),_:1},8,["label"]),c.value=="wechat"?(p(),v(_,{key:0,label:a(t)("shareDesc"),prop:"desc"},{default:n(()=>[o(V,{modelValue:f[c.value].desc,"onUpdate:modelValue":e[16]||(e[16]=l=>f[c.value].desc=l),modelModifiers:{trim:!0},placeholder:a(t)("shareDescPlaceholder"),type:"textarea",rows:"4",clearable:"",maxlength:"100","show-word-limit":""},null,8,["modelValue","placeholder"])]),_:1},8,["label"])):U("",!0),o(_,{label:a(t)("shareImageUrl"),prop:"url"},{default:n(()=>[o(se,{modelValue:f[c.value].url,"onUpdate:modelValue":e[17]||(e[17]=l=>f[c.value].url=l),limit:1},null,8,["modelValue"])]),_:1},8,["label"])]),_:1},8,["model","rules"])]),_:1},8,["modelValue","title"])])}}});export{Dl as default};
