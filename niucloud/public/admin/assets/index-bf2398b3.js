import{d as pe,x as me,f as ue,r as u,n as _e,aK as fe,a2 as D,h as _,c as L,e as t,w as a,a as c,t as d,u as n,q as e,i as f,F as he,T as ve,s as x,R,B as be,a5 as O,U as ge,A as xe,E as ye,aL as ke,aM as we,ay as Ce,ac as Ee,aD as Te,L as Fe,K as Ve,M as De,a7 as Ne,ad as Pe,ae as Ae,W as Be,az as Le,a1 as Se,ax as $e,V as je,X as ze,Y as Ue}from"./index-a7efb343.js";/* empty css                   *//* empty css                  *//* empty css                   *//* empty css                     *//* empty css                *//* empty css                    *//* empty css                    *//* empty css                      *//* empty css               *//* empty css                  *//* empty css                  *//* empty css                  *//* empty css                 *//* empty css                 */import"./el-tooltip-4ed993c7.js";/* empty css                        *//* empty css                *//* empty css                */import"./el-form-item-4ed993c7.js";/* empty css                *//* empty css                  */import{t as Ge,g as Me,u as Re,r as Oe,s as Ie,v as Ke}from"./tools-d1d0666a.js";import{_ as qe}from"./add-table.vue_vue_type_script_setup_true_lang-2c2cd172.js";const We={class:"main-container"},Xe={class:"flex justify-between items-center"},Ye={class:"text-page-title"},He={class:"text-[14px] font-[700]"},Je={class:"text-[#999]"},Qe={class:"mt-[20px] mb-[40px] h-[32px]"},Ze={class:"text-[14px] font-[700]"},et={class:"text-[#999]"},tt=c("div",{class:"mt-[20px] mb-[40px] h-[32px]"},null,-1),at={class:"text-[14px] font-[700]"},lt={class:"text-[#999]"},nt=c("div",{class:"mt-[20px] mb-[40px] h-[32px]"},null,-1),ot={class:"text-[14px] font-[700]"},st={class:"text-[#999]"},it=c("div",{class:"mt-[20px] mb-[40px] h-[32px]"},null,-1),dt={class:"text-[14px] font-[700]"},ct={class:"text-[#999]"},rt=c("div",{class:"mt-[20px] mb-[40px] h-[32px]"},null,-1),pt={class:"mt-[16px] flex justify-end"},mt={class:"flex h-[50vh]"},ut={class:"flex items-center"},_t={class:"pl-[5px]"},ft={class:"ml-[20px]",style:{width:"calc(100% - 285px)"}},Rt=pe({__name:"index",setup(ht){const I=me().meta.title,K=ue(),N=u("codeGeneration"),s=_e({page:1,limit:10,total:0,loading:!0,data:[],searchParam:{table_name:"",table_content:"",addon_name:""}}),S=u(),q=i=>{i&&(i.resetFields(),v())};fe(()=>{window.codeActiveName&&(N.value=window.codeActiveName+"",window.codeActiveName=null),v()});const v=(i=1)=>{s.loading=!0,s.page=i,Ge({page:s.page,limit:s.limit,...s.searchParam}).then(l=>{s.loading=!1,s.data=l.data.data,s.total=l.data.total}).catch(()=>{s.loading=!1})},$=u([]),W=i=>{Me({search:i}).then(l=>{$.value=l.data})},P=u(null),X=()=>{P.value.setFormData(),P.value.showDialog=!0},Y=i=>{O.confirm(e("codeDeleteTips"),e("warning"),{confirmButtonText:e("confirm"),cancelButtonText:e("cancel"),type:"warning"}).then(()=>{Re(i).then(()=>{v()}).catch(()=>{})})},H=i=>{K.push("/tools/code/edit?id="+i.id)},J=i=>{Oe({id:i}).then(l=>{s.loading=!1,O.confirm(l.msg!="2"?e("saveAndSyncText"):e("saveAndSyncText1"),e("warning"),{confirmButtonText:e("confirm"),cancelButtonText:e("cancel")}).then(()=>{j(i,3)}).catch(()=>{})}).catch(()=>{s.loading=!1})},j=(i,l)=>{s.loading=!0,Ie({id:i,generate_type:l}).then(r=>{ge({type:"success",message:"操作成功"}),l!=3?(s.loading=!1,window.open(xe(r.data.file),"_blank")):v()}).catch(()=>{s.loading=!1})},A=u([]),B=u(!1),w=u([]),C=u(!1),E=u(""),T=u(""),Q=i=>{B.value=!0,C.value=!0,E.value="",w.value=[],T.value="",Ke(i).then(l=>{A.value=l.data,w.value=ee(l.data.map(r=>r.file_dir+r.name)),E.value=A.value[0].content,C.value=!1}).catch(()=>{C.value=!1})},Z=i=>{A.value.forEach(l=>{i.path===l.file_dir+l.name&&(E.value=l.content)})},ee=i=>{const l=[];if(Array.isArray(i))for(let m=0;m<i.length;++m){const F=i[m].split("/");let b=l;for(let h=0;h<F.length;++h){const y=F[h];let p=null;for(var r=0;r<b.length;++r){const V=b[r];if(V.name===y){p=V;break}}p||(p={name:y,path:y.indexOf(".")<0?"":i[m],key:"k"+m+h+r},y.indexOf(".")<0&&(p.children=[]),p.path===i[0]&&(T.value=p.key),b.push(p)),p.children&&(b=p.children)}}return l};return(i,l)=>{const r=ye,m=ke,F=we,b=Ce,h=Ee,y=Te,p=Fe,V=Ve,te=De,z=Ne,k=Pe,ae=Ae,le=Be,ne=Le,oe=D("Folder"),se=D("FolderOpened"),U=Se,ie=D("Document"),de=$e,G=je,ce=D("highlightjs"),re=ze,M=Ue;return _(),L("div",We,[t(z,{class:"box-card !border-none",shadow:"never"},{default:a(()=>[c("div",Xe,[c("span",Ye,d(n(I)),1)]),t(ne,{modelValue:N.value,"onUpdate:modelValue":l[7]||(l[7]=o=>N.value=o),class:"mt-[20px]"},{default:a(()=>[t(b,{label:n(e)("codeGeneration"),name:"codeGeneration"},{default:a(()=>[t(F,{active:5,direction:"vertical"},{default:a(()=>[t(m,null,{title:a(()=>[c("p",He,d(n(e)("step1")),1)]),description:a(()=>[c("span",Je,d(n(e)("describe1")),1),c("div",Qe,[t(r,{type:"primary",class:"w-[100px]",onClick:X},{default:a(()=>[f(d(n(e)("btn1")),1)]),_:1})])]),_:1}),t(m,null,{title:a(()=>[c("p",Ze,d(n(e)("step2")),1)]),description:a(()=>[c("span",et,d(n(e)("describe2")),1),tt]),_:1}),t(m,null,{title:a(()=>[c("p",at,d(n(e)("step3")),1)]),description:a(()=>[c("span",lt,d(n(e)("describe3")),1),nt]),_:1}),t(m,null,{title:a(()=>[c("p",ot,d(n(e)("step4")),1)]),description:a(()=>[c("span",st,d(n(e)("describe4")),1),it]),_:1}),t(m,null,{title:a(()=>[c("p",dt,d(n(e)("step5")),1)]),description:a(()=>[c("span",ct,d(n(e)("describe5")),1),rt]),_:1})]),_:1})]),_:1},8,["label"]),t(b,{label:n(e)("codeList"),name:"codeList"},{default:a(()=>[t(z,{class:"box-card !border-none my-[10px] table-search-wrap",shadow:"never"},{default:a(()=>[t(te,{inline:!0,model:s.searchParam,ref_key:"searchFormRef",ref:S},{default:a(()=>[t(p,{label:n(e)("addonName"),prop:"addon_name"},{default:a(()=>[t(y,{modelValue:s.searchParam.addon_name,"onUpdate:modelValue":l[0]||(l[0]=o=>s.searchParam.addon_name=o),placeholder:"全部",filterable:"",remote:"",clearable:"","remote-method":W},{default:a(()=>[t(h,{label:"全部",value:""}),t(h,{label:"系统",value:"2"}),(_(!0),L(he,null,ve($.value,o=>(_(),x(h,{label:o.title,value:o.key,key:o.key},null,8,["label","value"]))),128))]),_:1},8,["modelValue"])]),_:1},8,["label"]),t(p,{label:n(e)("tableName"),prop:"table_name"},{default:a(()=>[t(V,{modelValue:s.searchParam.table_name,"onUpdate:modelValue":l[1]||(l[1]=o=>s.searchParam.table_name=o),modelModifiers:{trim:!0},placeholder:n(e)("tableNamePlaceholder")},null,8,["modelValue","placeholder"])]),_:1},8,["label"]),t(p,null,{default:a(()=>[t(r,{type:"primary",onClick:l[2]||(l[2]=o=>v())},{default:a(()=>[f(d(n(e)("search")),1)]),_:1}),t(r,{onClick:l[3]||(l[3]=o=>q(S.value))},{default:a(()=>[f(d(n(e)("reset")),1)]),_:1})]),_:1})]),_:1},8,["model"])]),_:1}),c("div",null,[R((_(),x(ae,{data:s.data,size:"large"},{empty:a(()=>[c("span",null,d(s.loading?"":n(e)("emptyData")),1)]),default:a(()=>[t(k,{prop:"table_name","show-overflow-tooltip":!0,label:n(e)("tableName"),"min-width":"120"},null,8,["label"]),t(k,{prop:"title","show-overflow-tooltip":!0,label:n(e)("addonName"),"min-width":"120"},null,8,["label"]),t(k,{prop:"table_content","show-overflow-tooltip":!0,label:n(e)("tableContent"),"min-width":"120"},null,8,["label"]),t(k,{prop:"edit_type",label:n(e)("editType"),"min-width":"150",align:"center"},{default:a(({row:o})=>[f(d(o.edit_type==1?n(e)("popup"):n(e)("page")),1)]),_:1},8,["label"]),t(k,{label:n(e)("createTime"),"min-width":"180",align:"center"},{default:a(({row:o})=>[f(d(o.create_time||""),1)]),_:1},8,["label"]),t(k,{label:n(e)("operation"),fixed:"right",align:"right",width:"330"},{default:a(({row:o})=>[t(r,{type:"primary",link:"",onClick:g=>H(o)},{default:a(()=>[f(d(n(e)("edit")),1)]),_:2},1032,["onClick"]),t(r,{type:"primary",link:"",onClick:g=>Q(o.id)},{default:a(()=>[f(d(n(e)("preview")),1)]),_:2},1032,["onClick"]),t(r,{type:"primary",link:"",onClick:g=>J(o.id)},{default:a(()=>[f(d(n(e)("saveAndSync")),1)]),_:2},1032,["onClick"]),t(r,{type:"primary",link:"",onClick:g=>j(o.id,2)},{default:a(()=>[f(d(n(e)("download")),1)]),_:2},1032,["onClick"]),t(r,{type:"primary",link:"",onClick:g=>Y(o.id)},{default:a(()=>[f(d(n(e)("delete")),1)]),_:2},1032,["onClick"])]),_:1},8,["label"])]),_:1},8,["data"])),[[M,s.loading]]),c("div",pt,[t(le,{"current-page":s.page,"onUpdate:current-page":l[4]||(l[4]=o=>s.page=o),"page-size":s.limit,"onUpdate:page-size":l[5]||(l[5]=o=>s.limit=o),layout:"total, sizes, prev, pager, next, jumper",total:s.total,onSizeChange:l[6]||(l[6]=o=>v()),onCurrentChange:v},null,8,["current-page","page-size","total"])])])]),_:1},8,["label"])]),_:1},8,["modelValue"]),t(qe,{ref_key:"addCodeDialog",ref:P},null,512),t(re,{modelValue:B.value,"onUpdate:modelValue":l[8]||(l[8]=o=>B.value=o),class:"dialog-visible",width:"70%",title:"代码预览"},{default:a(()=>[R((_(),L("div",mt,[t(G,{class:"h-[100%] w-[270px]"},{default:a(()=>[w.value.length&&T.value!=""?(_(),x(de,{key:0,data:w.value,props:{label:"name",value:"key"},"node-key":"key","current-node-key":T.value,"expand-on-click-node":!1,"highlight-current":"","default-expand-all":"",ref:"treeRef",onNodeClick:Z},{default:a(({node:o,data:g})=>[c("div",ut,[g.children?(_(),x(U,{key:0},{default:a(()=>[o.expanded?(_(),x(se,{key:1})):(_(),x(oe,{key:0}))]),_:2},1024)):(_(),x(U,{key:1},{default:a(()=>[t(ie)]),_:1})),c("span",_t,d(g.name),1)])]),_:1},8,["data","current-node-key"])):be("",!0)]),_:1}),c("div",ft,[t(G,{class:"h-[100%] w-[100%]"},{default:a(()=>[t(ce,{autodetect:"",class:"h-[100%]",code:E.value},null,8,["code"])]),_:1})])])),[[M,C.value]])]),_:1},8,["modelValue"])]),_:1})])}}});export{Rt as default};
