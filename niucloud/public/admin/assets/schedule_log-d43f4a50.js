import{d as te,x as ne,n as j,r as d,h as y,c as A,e,w as t,a as u,t as r,u as n,q as a,F as oe,T as se,s as V,i as g,R as M,cu as ie,cC as re,a5 as B,cD as Y,U as ue,cE as ce,aR as de,a7 as me,ac as pe,aD as fe,L as _e,bG as ge,E as ve,M as he,aw as be,ad as xe,ae as ye,W as ke,X as we,Y as Ce}from"./index-a7efb343.js";/* empty css                   *//* empty css                  *//* empty css                   *//* empty css                      *//* empty css               *//* empty css                  *//* empty css                  *//* empty css                     *//* empty css                  *//* empty css                 *//* empty css                 *//* empty css                    */import"./el-tooltip-4ed993c7.js";/* empty css                        *//* empty css                *//* empty css                  *//* empty css                       */import"./el-form-item-4ed993c7.js";/* empty css                *//* empty css                       */const Te={class:"main-container"},Ee={class:"text-large font-600 mr-3"},Le={class:"flex justify-between"},De={class:"mt-[20px]"},Ve={class:"mb-[10px] flex items-center"},Be={class:"mt-[16px] flex justify-end"},Pe={class:"input-width"},Re={class:"input-width"},ze={class:"input-width"},Fe={class:"input-width"},$e={class:"input-width"},Se={class:"input-width"},Ue={class:"dialog-footer"},ia=te({__name:"schedule_log",setup(je){const E=ne(),N=E.meta.title,o=j({page:1,limit:10,total:0,loading:!0,data:[],searchParam:{schedule_id:E.query.id,key:"",status:"all",execute_time:[]}}),P=d([]),R=d(),q=i=>{i&&(i.resetFields(),_())};(async()=>{P.value=await(await ie()).data})();const _=(i=1)=>{o.loading=!0,o.page=i,re({page:o.page,limit:o.limit,...o.searchParam}).then(l=>{o.loading=!1,o.data=l.data.data,o.total=l.data.total}).catch(()=>{o.loading=!1})};_();const k=d(!1),L=d(!0),c=d(!1),w=d(!1),C=d(!1),z={id:"",name:"",key:"",execute_result:"",status_name:"",class:"",job:"",execute_time:""},m=j({...z}),H=i=>{L.value=!0,Object.assign(m,z),i&&Object.keys(m).forEach(l=>{i[l]!=null&&(m[l]=i[l])}),L.value=!1,k.value=!0},I=i=>{B.confirm(a("deleteTips"),a("warning"),{confirmButtonText:a("confirm"),cancelButtonText:a("cancel"),type:"warning"}).then(()=>{c.value||(c.value=!0,Y({ids:i.id}).then(l=>{l.code==1&&_(),c.value=!1}).catch(()=>{c.value=!1}))})},b=d(),T=d(!1),O=i=>{T.value=!1,F.value.toggleAllSelection()},F=d(),v=d([]),G=i=>{v.value=i,b.value=!1,v.value.length>0&&v.value.length<o.data.length?T.value=!0:T.value=!1,v.value.length==o.data.length&&o.data.length&&v.value.length&&(b.value=!0)},W=()=>{if(v.value.length==0){ue({type:"warning",message:`${a("batchEmptySelectedCronLogTips")}`});return}B.confirm(a("batchDeleteTips"),a("warning"),{confirmButtonText:a("confirm"),cancelButtonText:a("cancel"),type:"warning"}).then(()=>{if(c.value)return;c.value=!0,w.value=!0;const i=[];v.value.forEach(l=>{i.push(l.id)}),Y({ids:i}).then(()=>{_(),b.value=!1,c.value=!1,w.value=!1}).catch(()=>{c.value=!1,w.value=!1})})},X=()=>{B.confirm(a("clearAllTips"),a("warning"),{confirmButtonText:a("confirm"),cancelButtonText:a("cancel"),type:"warning"}).then(()=>{if(c.value)return;c.value=!0,C.value=!0;const i=E.query.id??"";ce({schedule_id:i}).then(()=>{_(),b.value=!1,c.value=!1,C.value=!1}).catch(()=>{c.value=!1,C.value=!1})})};return(i,l)=>{const J=de,D=me,x=pe,$=fe,p=_e,K=ge,h=ve,S=he,Q=be,f=xe,Z=ye,ee=ke,ae=we,U=Ce;return y(),A("div",Te,[e(D,{class:"card !border-none",shadow:"never"},{default:t(()=>[e(J,{icon:i.ArrowLeft,onBack:l[0]||(l[0]=s=>i.$router.back())},{content:t(()=>[u("span",Ee,r(n(N)),1)]),_:1},8,["icon"])]),_:1}),e(D,{class:"box-card !border-none",shadow:"never"},{default:t(()=>[e(D,{class:"box-card !border-none mb-[10px] table-search-wrap",shadow:"never"},{default:t(()=>[u("div",Le,[e(S,{inline:!0,model:o.searchParam,ref_key:"searchFormRef",ref:R},{default:t(()=>[e(p,{label:n(a)("name"),prop:"key"},{default:t(()=>[e($,{modelValue:o.searchParam.key,"onUpdate:modelValue":l[1]||(l[1]=s=>o.searchParam.key=s),placeholder:"全部",filterable:"",remote:"",clearable:""},{default:t(()=>[e(x,{label:"全部",value:"all"}),(y(!0),A(oe,null,se(P.value,s=>(y(),V(x,{key:s.key,label:s.name,value:s.key},null,8,["label","value"]))),128))]),_:1},8,["modelValue"])]),_:1},8,["label"]),e(p,{label:n(a)("status"),prop:"status"},{default:t(()=>[e($,{modelValue:o.searchParam.status,"onUpdate:modelValue":l[2]||(l[2]=s=>o.searchParam.status=s),placeholder:"全部",filterable:"",remote:"",clearable:""},{default:t(()=>[e(x,{label:"全部",value:"all"}),e(x,{label:"成功",value:"success"}),e(x,{label:"失败",value:"error"})]),_:1},8,["modelValue"])]),_:1},8,["label"]),e(p,{label:n(a)("executeTime"),prop:"execute_time"},{default:t(()=>[e(K,{modelValue:o.searchParam.execute_time,"onUpdate:modelValue":l[3]||(l[3]=s=>o.searchParam.execute_time=s),type:"datetimerange","value-format":"YYYY-MM-DD HH:mm:ss","start-placeholder":n(a)("startDate"),"end-placeholder":n(a)("endDate")},null,8,["modelValue","start-placeholder","end-placeholder"])]),_:1},8,["label"]),e(p,null,{default:t(()=>[e(h,{type:"primary",onClick:l[4]||(l[4]=s=>_())},{default:t(()=>[g(r(n(a)("search")),1)]),_:1}),e(h,{onClick:l[5]||(l[5]=s=>q(R.value))},{default:t(()=>[g(r(n(a)("reset")),1)]),_:1})]),_:1})]),_:1},8,["model"])])]),_:1}),u("div",De,[u("div",Ve,[e(Q,{modelValue:b.value,"onUpdate:modelValue":l[6]||(l[6]=s=>b.value=s),size:"large",class:"px-[14px]",onChange:O,indeterminate:T.value},null,8,["modelValue","indeterminate"]),e(h,{onClick:W,size:"small",loading:w.value},{default:t(()=>[g(r(n(a)("batchDelete")),1)]),_:1},8,["loading"]),e(h,{onClick:X,size:"small",loading:C.value},{default:t(()=>[g(r(n(a)("clearAll")),1)]),_:1},8,["loading"])]),M((y(),V(Z,{data:o.data,size:"large",ref_key:"cronLogListTableRef",ref:F,onSelectionChange:G},{empty:t(()=>[u("span",null,r(o.loading?"":n(a)("emptyData")),1)]),default:t(()=>[e(f,{type:"selection",width:"55"}),e(f,{prop:"id",label:n(a)("id"),"min-width":"80"},null,8,["label"]),e(f,{prop:"name",label:n(a)("name"),"min-width":"150"},null,8,["label"]),e(f,{prop:"key",label:n(a)("key"),"min-width":"150"},null,8,["label"]),e(f,{prop:"class",label:n(a)("class"),"min-width":"150"},null,8,["label"]),e(f,{label:n(a)("executeResult"),"min-width":"150"},{default:t(({row:s})=>[g(r(s.execute_result),1)]),_:1},8,["label"]),e(f,{prop:"status_name",label:n(a)("status"),"min-width":"100"},null,8,["label"]),e(f,{prop:"execute_time",label:n(a)("executeTime"),"min-width":"100"},null,8,["label"]),e(f,{label:n(a)("operation"),align:"right",fixed:"right",width:"130"},{default:t(({row:s})=>[e(h,{type:"primary",link:"",onClick:le=>H(s)},{default:t(()=>[g(r(n(a)("info")),1)]),_:2},1032,["onClick"]),e(h,{type:"primary",link:"",onClick:le=>I(s)},{default:t(()=>[g(r(n(a)("delete")),1)]),_:2},1032,["onClick"])]),_:1},8,["label"])]),_:1},8,["data"])),[[U,o.loading]]),u("div",Be,[e(ee,{"current-page":o.page,"onUpdate:current-page":l[7]||(l[7]=s=>o.page=s),"page-size":o.limit,"onUpdate:page-size":l[8]||(l[8]=s=>o.limit=s),layout:"total, sizes, prev, pager, next, jumper",total:o.total,onSizeChange:l[9]||(l[9]=s=>_()),onCurrentChange:_},null,8,["current-page","page-size","total"])])])]),_:1}),e(ae,{modelValue:k.value,"onUpdate:modelValue":l[11]||(l[11]=s=>k.value=s),title:n(a)("cronInfo"),width:"550px","destroy-on-close":!0},{footer:t(()=>[u("span",Ue,[e(h,{type:"primary",onClick:l[10]||(l[10]=s=>k.value=!1)},{default:t(()=>[g(r(n(a)("confirm")),1)]),_:1})])]),default:t(()=>[M((y(),V(S,{model:m,"label-width":"110px",ref:"formRef",class:"page-form"},{default:t(()=>[e(p,{label:n(a)("name")},{default:t(()=>[u("div",Pe,r(m.name),1)]),_:1},8,["label"]),e(p,{label:n(a)("key")},{default:t(()=>[u("div",Re,r(m.key),1)]),_:1},8,["label"]),e(p,{label:n(a)("class")},{default:t(()=>[u("div",ze,r(m.class),1)]),_:1},8,["label"]),e(p,{label:n(a)("executeResult")},{default:t(()=>[u("div",Fe,r(m.execute_result),1)]),_:1},8,["label"]),e(p,{label:n(a)("status")},{default:t(()=>[u("div",$e,r(m.status_name),1)]),_:1},8,["label"]),e(p,{label:n(a)("executeTime")},{default:t(()=>[u("div",Se,r(m.execute_time),1)]),_:1},8,["label"])]),_:1},8,["model"])),[[U,L.value]])]),_:1},8,["modelValue","title"])])}}});export{ia as default};
