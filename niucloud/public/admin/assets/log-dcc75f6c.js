import{d as E,x as L,n as F,r as h,h as v,c as U,e as t,w as n,a as p,t as d,u as o,q as r,i as c,R as z,s as $,K as B,L as T,E as j,M,ad as N,ae as R,W as S,a7 as I,Y as q}from"./index-6405d5ac.js";/* empty css                   *//* empty css                *//* empty css                      *//* empty css               *//* empty css                  *//* empty css                  *//* empty css                     *//* empty css                  *//* empty css                 *//* empty css                 *//* empty css                    */import"./el-tooltip-4ed993c7.js";/* empty css                        *//* empty css                     *//* empty css                  */import{a as K}from"./site-0fb01aff.js";import{_ as W}from"./user-log-detail.vue_vue_type_script_setup_true_lang-3aad71d4.js";/* empty css                  *//* empty css                   *//* empty css                             */const Y={class:"main-container"},A={class:"flex justify-between items-center"},G={class:"text-page-title"},H={class:"flex justify-between items-center mt-[20px]"},J={class:"mt-[16px] flex justify-end"},ye=E({__name:"log",setup(O){const y=L().meta.title,e=F({page:1,limit:10,total:0,loading:!0,data:[],searchParam:{ip:"",username:"",url:""}}),b=h(),x=i=>{i&&(i.resetFields(),s())},s=(i=1)=>{e.loading=!0,e.page=i,K({page:e.page,limit:e.limit,...e.searchParam}).then(a=>{e.loading=!1,e.data=a.data.data,e.total=a.data.total}).catch(()=>{e.loading=!1})};s();const _=h(null),w=i=>{_.value.setFormData(i),_.value.showDialog=!0};return(i,a)=>{const g=B,u=T,f=j,P=M,m=N,C=R,V=S,k=I,D=q;return v(),U("div",Y,[t(k,{class:"box-card !border-none",shadow:"never"},{default:n(()=>[p("div",A,[p("span",G,d(o(y)),1)]),p("div",H,[t(P,{inline:!0,model:e.searchParam,ref_key:"searchFormRef",ref:b},{default:n(()=>[t(u,{label:o(r)("ip"),prop:"ip"},{default:n(()=>[t(g,{modelValue:e.searchParam.ip,"onUpdate:modelValue":a[0]||(a[0]=l=>e.searchParam.ip=l),modelModifiers:{trim:!0},placeholder:o(r)("ipPlaceholder")},null,8,["modelValue","placeholder"])]),_:1},8,["label"]),t(u,{label:o(r)("username"),prop:"username"},{default:n(()=>[t(g,{modelValue:e.searchParam.username,"onUpdate:modelValue":a[1]||(a[1]=l=>e.searchParam.username=l),modelModifiers:{trim:!0},placeholder:o(r)("usernamePlaceholder")},null,8,["modelValue","placeholder"])]),_:1},8,["label"]),t(u,{label:o(r)("url"),prop:"url"},{default:n(()=>[t(g,{modelValue:e.searchParam.url,"onUpdate:modelValue":a[2]||(a[2]=l=>e.searchParam.url=l),modelModifiers:{trim:!0},placeholder:o(r)("urlPlaceholder")},null,8,["modelValue","placeholder"])]),_:1},8,["label"]),t(u,null,{default:n(()=>[t(f,{type:"primary",onClick:a[3]||(a[3]=l=>s())},{default:n(()=>[c(d(o(r)("search")),1)]),_:1}),t(f,{onClick:a[4]||(a[4]=l=>x(b.value))},{default:n(()=>[c(d(o(r)("reset")),1)]),_:1})]),_:1})]),_:1},8,["model"])]),p("div",null,[z((v(),$(C,{data:e.data,size:"large"},{empty:n(()=>[p("span",null,d(e.loading?"":o(r)("emptyData")),1)]),default:n(()=>[t(m,{prop:"username",label:o(r)("username"),"min-width":"120"},null,8,["label"]),t(m,{prop:"ip",label:o(r)("ip"),"min-width":"100",align:"left"},null,8,["label"]),t(m,{prop:"url",label:o(r)("url"),"min-width":"180"},null,8,["label"]),t(m,{prop:"type",label:o(r)("type"),"min-width":"100",align:"center"},null,8,["label"]),t(m,{label:o(r)("createTime"),"min-width":"180",align:"center"},{default:n(({row:l})=>[c(d(l.create_time||""),1)]),_:1},8,["label"]),t(m,{label:o(r)("operation"),align:"right",fixed:"right",width:"130"},{default:n(({row:l})=>[t(f,{type:"primary",link:"",onClick:X=>w(l)},{default:n(()=>[c(d(o(r)("detail")),1)]),_:2},1032,["onClick"])]),_:1},8,["label"])]),_:1},8,["data"])),[[D,e.loading]]),p("div",J,[t(V,{"current-page":e.page,"onUpdate:current-page":a[5]||(a[5]=l=>e.page=l),"page-size":e.limit,"onUpdate:page-size":a[6]||(a[6]=l=>e.limit=l),layout:"total, sizes, prev, pager, next, jumper",total:e.total,onSizeChange:a[7]||(a[7]=l=>s()),onCurrentChange:s},null,8,["current-page","page-size","total"])]),t(W,{ref_key:"userLogDetailDialog",ref:_,onComplete:a[8]||(a[8]=l=>s())},null,512)])]),_:1})])}}});export{ye as default};
