import{d as z,x as L,n as M,r as g,h as D,c as N,e as t,w as n,a as _,t as m,u as o,i as p,q as a,R,s as U,a5 as j,E as I,K as S,L as q,M as K,a7 as W,ad as Y,ae as A,W as G,Y as H}from"./index-6405d5ac.js";/* empty css                   *//* empty css                      *//* empty css               *//* empty css                  *//* empty css                  *//* empty css                     *//* empty css                  *//* empty css                 *//* empty css                 *//* empty css                    */import"./el-tooltip-4ed993c7.js";/* empty css                        *//* empty css                *//* empty css                     *//* empty css                  */import{b as J,d as O}from"./dict-fcda5e48.js";import{_ as Q}from"./edit.vue_vue_type_style_index_0_lang-f38d52d0.js";import{_ as X}from"./dict.vue_vue_type_style_index_0_lang-d3fb28bb.js";/* empty css                  *//* empty css                   *//* empty css                        */const Z={class:"main-container"},ee={class:"flex justify-between items-center"},te={class:"text-page-title"},ae={class:"mt-[10px]"},le={class:"mt-[16px] flex justify-end"},Fe=z({__name:"list",setup(oe){const x=L().meta.title,e=M({page:1,limit:10,total:0,loading:!0,data:[],searchParam:{name:"",key:""}}),h=g(),s=(r=1)=>{e.loading=!0,e.page=r,J({page:e.page,limit:e.limit,...e.searchParam}).then(l=>{e.loading=!1,e.data=l.data.data,e.total=l.data.total}).catch(()=>{e.loading=!1})};s();const c=g(null),C=()=>{c.value.setFormData(),c.value.showDialog=!0},w=r=>{c.value.setFormData(r),c.value.showDialog=!0},y=g(null),E=r=>{y.value.setFormData(r)},P=r=>{j.confirm(a("dictDeleteTips"),a("warning"),{confirmButtonText:a("confirm"),cancelButtonText:a("cancel"),type:"warning"}).then(()=>{O(r).then(()=>{s()}).catch(()=>{})})},F=r=>{r&&(r.resetFields(),s())};return(r,l)=>{const d=I,b=S,f=q,V=K,k=W,u=Y,B=A,T=G,$=H;return D(),N("div",Z,[t(k,{class:"box-card !border-none",shadow:"never"},{default:n(()=>[_("div",ee,[_("span",te,m(o(x)),1),t(d,{type:"primary",onClick:C},{default:n(()=>[p(m(o(a)("addDict")),1)]),_:1})]),t(k,{class:"box-card !border-none my-[10px] table-search-wrap",shadow:"never"},{default:n(()=>[t(V,{inline:!0,model:e.searchParam,ref_key:"searchFormRef",ref:h},{default:n(()=>[t(f,{label:o(a)("name"),prop:"name"},{default:n(()=>[t(b,{modelValue:e.searchParam.name,"onUpdate:modelValue":l[0]||(l[0]=i=>e.searchParam.name=i),modelModifiers:{trim:!0},placeholder:o(a)("namePlaceholder")},null,8,["modelValue","placeholder"])]),_:1},8,["label"]),t(f,{label:o(a)("key"),prop:"key"},{default:n(()=>[t(b,{modelValue:e.searchParam.key,"onUpdate:modelValue":l[1]||(l[1]=i=>e.searchParam.key=i),modelModifiers:{trim:!0},placeholder:o(a)("keyPlaceholder")},null,8,["modelValue","placeholder"])]),_:1},8,["label"]),t(f,null,{default:n(()=>[t(d,{type:"primary",onClick:l[2]||(l[2]=i=>s())},{default:n(()=>[p(m(o(a)("search")),1)]),_:1}),t(d,{onClick:l[3]||(l[3]=i=>F(h.value))},{default:n(()=>[p(m(o(a)("reset")),1)]),_:1})]),_:1})]),_:1},8,["model"])]),_:1}),_("div",ae,[R((D(),U(B,{data:e.data,size:"large"},{empty:n(()=>[_("span",null,m(e.loading?"":o(a)("emptyData")),1)]),default:n(()=>[t(u,{prop:"name",label:o(a)("name"),"min-width":"120"},null,8,["label"]),t(u,{prop:"key",label:o(a)("key"),"min-width":"120"},null,8,["label"]),t(u,{prop:"memo",label:o(a)("memo"),"min-width":"120"},null,8,["label"]),t(u,{prop:"create_time",label:o(a)("createTime"),"min-width":"120"},null,8,["label"]),t(u,{label:o(a)("operation"),align:"right",fixed:"right","min-width":"120"},{default:n(({row:i})=>[t(d,{type:"primary",link:"",onClick:v=>E(i)},{default:n(()=>[p(m(o(a)("dictData")),1)]),_:2},1032,["onClick"]),t(d,{type:"primary",link:"",onClick:v=>w(i)},{default:n(()=>[p(m(o(a)("edit")),1)]),_:2},1032,["onClick"]),t(d,{type:"primary",link:"",onClick:v=>P(i.id)},{default:n(()=>[p(m(o(a)("delete")),1)]),_:2},1032,["onClick"])]),_:1},8,["label"])]),_:1},8,["data"])),[[$,e.loading]]),_("div",le,[t(T,{"current-page":e.page,"onUpdate:current-page":l[4]||(l[4]=i=>e.page=i),"page-size":e.limit,"onUpdate:page-size":l[5]||(l[5]=i=>e.limit=i),layout:"total, sizes, prev, pager, next, jumper",total:e.total,onSizeChange:l[6]||(l[6]=i=>s()),onCurrentChange:s},null,8,["current-page","page-size","total"])])]),t(Q,{ref_key:"editDictDialog",ref:c,onComplete:s},null,512),t(X,{ref_key:"dictDialog",ref:y,onComplete:s},null,512)]),_:1})])}}});export{Fe as default};
