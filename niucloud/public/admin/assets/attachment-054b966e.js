import{d as Oe,r as L,n as $,Q as J,l as ie,b9 as Se,G as Le,U as ce,ap as C,A as U,h as s,c as p,a as d,e as n,u as o,q as i,w as l,v as B,t as u,F as D,T as R,s as v,i as k,B as x,ba as Te,R as de,a0 as je,aq as re,bb as Fe,bc as Be,a5 as ue,bd as De,be as Me,bf as Re,K as Ne,bg as Pe,bh as qe,bi as Ke,V as Ge,E as Je,bj as Qe,aN as We,aO as Xe,J as Ye,aa as He,aw as Ze,W as et,ac as tt,aD as at,L as lt,M as nt,X as ot,bk as st,Y as it,p as ct,g as dt,bl as rt,bm as ut,bn as mt,bo as pt}from"./index-6405d5ac.js";/* empty css                   */import{_ as ft}from"./index.vue_vue_type_script_setup_true_lang-f80d36ce.js";/* empty css                        *//* empty css                  *//* empty css                   *//* empty css                     *//* empty css               *//* empty css                  *//* empty css                  *//* empty css                     *//* empty css                  *//* empty css                      *//* empty css                 *//* empty css                    */import"./el-tooltip-4ed993c7.js";/* empty css                 *//* empty css               *//* empty css                    *//* empty css                  *//* empty css                    */import"./el-dropdown-item-4ed993c7.js";import{_ as _t}from"./index.vue_vue_type_script_setup_true_lang-0e5521b7.js";import{_ as ht}from"./index.vue_vue_type_script_setup_true_lang-c21881a6.js";import{_ as vt}from"./_plugin-vue_export-helper-c27b6911.js";/* empty css                   */const gt=""+new URL("no_attachment-6030c8d3.png",import.meta.url).href,yt=r=>(ct("data-v-6207b4d0"),r=r(),dt(),r),xt={class:"group-wrap w-[180px] p-[15px] h-full border-r border-color flex flex-col"},bt={class:"group-list flex-1 my-[10px] h-0"},wt=["onClick"],kt={key:0,class:"leading-none operate py-[10px]"},Ct={class:"text-center w-full"},Vt={class:"attachment-list-wrap flex flex-col p-[15px] flex-1 overflow-hidden"},Et={class:"flex"},$t={key:1},It={class:"flex-1 my-[15px] h-0"},At={key:0,class:"flex flex-wrap"},zt=["onClick"],Ut=["src"],Ot={class:"absolute z-[1] flex items-center justify-center w-full h-full inset-0 bg-black bg-opacity-60"},St={class:"file-box-active absolute z-[1] bottom-0 right-0 w-full h-full"},Lt={class:"absolute bottom-[2px] right-[2px] text-white z-[2] leading-none"},Tt={class:"flex items-center"},jt={class:"truncate my-[10px] cursor-pointer text-base flex-1 text-center"},Ft={class:"text-center w-full"},Bt={class:"text-center w-full"},Dt={class:"text-center w-full"},Mt={class:"text-center w-full"},Rt={key:1,class:"flex flex-wrap"},Nt={class:"attachment-wrap w-full rounded cursor-pointer overflow-hidden relative flex items-center justify-center h-[120px]"},Pt=["src","onClick"],qt={class:"flex items-center"},Kt={class:"truncate my-[10px] cursor-pointer text-base flex-1 text-center"},Gt={key:2,class:"flex absolute top-0 left-0 right-0 bottom-0 items-center justify-center"},Jt={key:0,class:"flex flex-col items-center"},Qt=yt(()=>d("img",{src:gt,class:"max-w-[130px] max-h-[130px] mb-[15px]"},null,-1)),Wt={class:"text-[var(--el-text-color-secondary)] text-[14px]"},Xt={class:"flex items-center"},Yt={class:"flex h-full justify-end items-center"},Ht={class:"dialog-footer"},Zt=Oe({__name:"attachment",props:{limit:{type:Number,default:1},type:{type:String,default:"image"},scene:{type:String,default:"select"}},setup(r,{expose:me}){const m=r,N=L(""),O=L(!1),f=$({}),b=$([]),I=$({data:[]}),c=$({loading:!0,page:1,total:0,limit:m.scene=="select"?10:20,data:[]});m.scene=="select"?(c.limit=10,m.type=="icon"&&(c.limit=20)):(c.limit=20,m.type=="icon"&&(c.limit=30));const P=$({name:""}),V=$({real_name:"",cate_id:0}),q=re(()=>{(m.type=="icon"?rt:ut)({type:m.type,...P}).then(e=>{I.data=e.data}).catch(()=>{})});q();const A=re((a=1)=>{const e=m.type=="icon"?mt:pt;c.loading=!0,c.page=a,e({page:c.page,limit:c.limit,att_type:m.type,...V}).then(_=>{if(c.data=_.data.data,c.total=_.data.total,c.loading=!1,m.scene=="attachment"&&X(),m.type!="icon")for(let g=0;g<c.data.length;g++)c.data[g].image_list=[],c.data[g].image_list.push(U(_.data.data[g].url))}).catch(()=>{c.loading=!1})});A(),J(()=>V.cate_id,()=>{A()});const pe=a=>{Fe({type:m.type,name:a}).then(e=>{N.value="",q(1)}).catch(()=>{})},fe=(a,e)=>{Be({id:I.data[e].id,name:a}).then(_=>{I.data[e].name=a}).catch(()=>{})},_e=a=>{ue.confirm(i("upload.deleteCategoryTips"),i("warning"),{confirmButtonText:i("confirm"),cancelButtonText:i("cancel"),type:"warning"}).then(()=>{De(I.data[a].id).then(()=>{I.data.splice(a,1)}).catch(()=>{})})},Q=L(null),S=L(null),he=ie(()=>{const a={};return a.token=Se(),a["site-id"]=Le.get("siteId")||0,{action:`${"/adminapi/".substr(-1)=="/"?"/adminapi/":"/adminapi//"}sys/${m.type}`,multiple:!0,data:{cate_id:V.cate_id},headers:a,onSuccess:(_,g,G)=>{var E;_.code>=1?(A(),(E=Q.value)==null||E.handleRemove(g)):S.value==null?S.value=setTimeout(()=>{g.status="fail",ve({message:_.msg,type:"error"}),clearTimeout(S.value),S.value=null},500):(clearTimeout(S.value),S.value=null)}}}),W=new Map,ve=a=>{const e=a.message,_=W.get(e);(!_||Date.now()-_.timestamp>5e3)&&(W.set(e,{timestamp:Date.now()}),ce(a))},T=L(!1);J(T,()=>{if(T.value){const a=Object.keys(C(f));c.data.forEach(e=>{a.includes(e.att_id)||(f[e.att_id]=C(e),b.push(e.att_id))})}else X()});const X=()=>{const a=Object.keys(C(f));a.length&&(a.forEach(e=>{delete f[e],b.splice(b.indexOf(e),1)}),T.value=!1)},ge=a=>{if(f[a.att_id])delete f[a.att_id],b.splice(b.indexOf(a.att_id),1);else if(m.scene=="select"){const e=Object.keys(C(f)),_=e.length;if(m.limit==1&&_==m.limit)delete f[e[0]],b.splice(b.indexOf(e[0]),1);else if(m.limit&&_>=m.limit){ce.info(i("upload.triggerUpperLimit"));return}f[a.att_id]=C(a),b.push(a.att_id)}else f[a.att_id]=C(a),b.push(a.att_id)},ye=a=>{let e=b.indexOf(a);return e==-1?0:e+1},Y=(a=null)=>{const e=a===null?Object.keys(C(f)):[c.data[a].att_id];ue.confirm(i("upload.deleteAttachmentTips"),i("warning"),{confirmButtonText:i("confirm"),cancelButtonText:i("cancel"),type:"warning"}).then(()=>{Me({att_ids:e}).then(()=>{A()}).catch(()=>{})})},h=$({cateId:"",loading:!1,visible:!1}),H=(a=null)=>{const e=a===null?Object.keys(C(f)):[c.data[a].att_id];h.visible=!0,h.cateId=I.data[0].id,h.confirm=()=>{h.loading=!0,Re({cate_id:h.cateId,att_ids:e}).then(()=>{h.visible=!1,h.loading=!1,A()}).catch(()=>{h.loading=!1})}},K=L(!0);J(f,()=>{K.value=Object.keys(C(f)).length==0});const j=$({show:!1,index:0}),xe=a=>{j.show=!0,j.index=a},be=ie(()=>C(c.data).map(a=>U(a.url))),F=$({visible:!1,src:""}),Z=a=>{F.visible=!0,F.src=U(c.data[a].url)};return me({selectedFile:f,selectedFileIndex:b}),(a,e)=>{const _=Ne,g=ht,G=_t,E=Pe,ee=qe,te=Ke,ae=Ge,z=Je,we=Qe,M=We,le=Xe,ne=Ye,oe=He,ke=Ze,Ce=et,Ve=tt,Ee=at,$e=lt,Ie=nt,se=ot,Ae=st,ze=ft,Ue=it;return s(),p("div",{class:B(["flex border-t border-b main-wrap border-color w-full",r.scene=="select"?"h-[40vh]":"h-full"])},[d("div",xt,[n(_,{modelValue:P.name,"onUpdate:modelValue":e[0]||(e[0]=t=>P.name=t),class:"m-0",placeholder:o(i)("upload.attachmentCategoryPlaceholder"),clearable:"","prefix-icon":"Search",onInput:e[1]||(e[1]=t=>o(q)())},null,8,["modelValue","placeholder"]),d("div",bt,[n(ae,null,{default:l(()=>[d("div",{class:B(["group-item p-[10px] leading-none text-xs rounded cursor-pointer",{active:V.cate_id==0}]),onClick:e[2]||(e[2]=t=>V.cate_id=0)},u(o(i)("selectPlaceholder")),3),(s(!0),p(D,null,R(I.data,(t,y)=>(s(),p("div",{class:B(["group-item px-[10px] text-xs rounded cursor-pointer flex",{active:V.cate_id==t.id}]),key:y},[d("div",{class:"flex-1 leading-none truncate py-[10px]",onClick:w=>V.cate_id=t.id},u(t.name),9,wt),r.scene=="attachment"&&m.type!="icon"?(s(),p("div",kt,[r.scene=="attachment"?(s(),v(te,{key:0,"hide-on-click":!1},{dropdown:l(()=>[n(ee,null,{default:l(()=>[n(E,{class:"text-center"},{default:l(()=>[n(G,{placeholder:o(i)("upload.attachmentCategoryPlaceholder"),onConfirm:w=>fe(w,y),modelValue:t.name,"onUpdate:modelValue":w=>t.name=w},{default:l(()=>[d("span",null,u(o(i)("edit")),1)]),_:2},1032,["placeholder","onConfirm","modelValue","onUpdate:modelValue"])]),_:2},1024),n(E,{onClick:w=>_e(y)},{default:l(()=>[d("div",Ct,u(o(i)("delete")),1)]),_:2},1032,["onClick"])]),_:2},1024)]),default:l(()=>[n(g,{name:"element MoreFilled",class:"cursor-pointer ml-[10px]",size:"14px"}),k(" "+u(t.name)+" ",1)]),_:2},1024)):x("",!0)])):x("",!0)],2))),128))]),_:1})]),m.type!="icon"?(s(),v(G,{key:0,placeholder:o(i)("upload.attachmentCategoryPlaceholder"),onConfirm:pe,modelValue:N.value,"onUpdate:modelValue":e[3]||(e[3]=t=>N.value=t)},{default:l(()=>[n(z,null,{default:l(()=>[k(u(o(i)("upload.addAttachmentCategory")),1)]),_:1})]),_:1},8,["placeholder","modelValue"])):x("",!0)]),d("div",Vt,[n(le,{gutter:15,class:"h-[32px]"},{default:l(()=>[n(M,{span:10},{default:l(()=>[d("div",Et,[m.type!="icon"?(s(),v(we,Te({key:0},o(he),{ref_key:"uploadRef",ref:Q}),{default:l(()=>[n(z,{type:"primary"},{default:l(()=>[k(u(o(i)("upload.upload"+r.type))+" "+u(a.isOpen),1)]),_:1})]),_:1},16)):x("",!0),r.scene=="attachment"&&m.type!="icon"?(s(),p("div",$t,[O.value===!1?(s(),v(z,{key:0,class:"ml-[10px]",type:"primary",onClick:e[4]||(e[4]=t=>O.value=!0)},{default:l(()=>[k(u(o(i)("edit")),1)]),_:1})):(s(),v(z,{key:1,class:"ml-[10px]",type:"primary",onClick:e[5]||(e[5]=t=>O.value=!1)},{default:l(()=>[k(u(o(i)("complete")),1)]),_:1}))])):x("",!0)])]),_:1}),n(M,{span:14,class:"text-right"},{default:l(()=>[n(_,{modelValue:V.real_name,"onUpdate:modelValue":e[6]||(e[6]=t=>V.real_name=t),class:"m-0 !w-[200px]",clearable:"",placeholder:o(i)("upload.placeholder"+r.type+"Name"),"prefix-icon":"Search",onInput:e[7]||(e[7]=t=>o(A)())},null,8,["modelValue","placeholder"])]),_:1})]),_:1}),de((s(),p("div",It,[n(ae,null,{default:l(()=>[c.data.length&&(O.value===!0||r.scene!="attachment")?(s(),p("div",At,[(s(!0),p(D,null,R(c.data,(t,y)=>(s(),p("div",{class:B(["attachment-item mr-[10px]",r.scene=="select"?"w-[100px]":"w-[120px]"]),key:y},[d("div",{class:B(["attachment-wrap w-full rounded cursor-pointer overflow-hidden relative flex items-center justify-center",r.scene=="select"?"h-[100px]":"h-[120px]"]),onClick:w=>ge(t)},[r.type=="image"?(s(),v(ne,{key:0,src:o(U)(t.url),fit:"contain"},null,8,["src"])):r.type=="video"?(s(),p("video",{key:1,src:o(U)(t.url)},null,8,Ut)):r.type=="icon"?(s(),v(g,{key:2,name:t.url,size:"24px"},null,8,["name"])):x("",!0),de(d("div",Ot,[n(g,{name:"element Select",color:"#fff",size:"40px"}),d("div",St,[d("span",Lt,u(ye(t.att_id)),1)])],512),[[je,f[t.att_id]]])],10,zt),d("div",Tt,[n(oe,{placement:"top"},{content:l(()=>[k(u(t.real_name),1)]),default:l(()=>[d("div",jt,u(t.real_name),1)]),_:2},1024),r.scene=="attachment"?(s(),v(te,{key:0,"hide-on-click":!1,class:"attachment-action hidden"},{dropdown:l(()=>[n(ee,null,{default:l(()=>[t.att_type=="image"?(s(),v(E,{key:0,class:"text-center",onClick:w=>xe(y)},{default:l(()=>[d("div",Ft,u(o(i)("lookOver")),1)]),_:2},1032,["onClick"])):x("",!0),t.att_type=="video"?(s(),v(E,{key:1,class:"text-center",onClick:w=>Z(y)},{default:l(()=>[d("div",Bt,u(o(i)("lookOver")),1)]),_:2},1032,["onClick"])):x("",!0),n(E,{class:"text-center",onClick:w=>H(y)},{default:l(()=>[d("div",Dt,u(o(i)("upload.move")),1)]),_:2},1032,["onClick"]),n(E,{onClick:w=>Y(y)},{default:l(()=>[d("div",Mt,u(o(i)("delete")),1)]),_:2},1032,["onClick"])]),_:2},1024)]),default:l(()=>[n(g,{name:"element MoreFilled",class:"cursor-pointer ml-[8px]",size:"14px"})]),_:2},1024)):x("",!0)])],2))),128))])):c.data.length&&O.value===!1?(s(),p("div",Rt,[(s(!0),p(D,null,R(c.data,(t,y)=>(s(),p("div",{class:"attachment-item mr-[10px] w-[120px]",key:y},[d("div",Nt,[r.type=="image"?(s(),v(ne,{key:0,src:o(U)(t.url),fit:"contain","preview-src-list":t.image_list},null,8,["src","preview-src-list"])):r.type=="video"?(s(),p("video",{key:1,src:o(U)(t.url),onClick:w=>Z(y)},null,8,Pt)):r.type=="icon"?(s(),v(g,{key:2,name:t.url,size:"24px"},null,8,["name"])):x("",!0)]),d("div",qt,[n(oe,{placement:"top"},{content:l(()=>[k(u(t.real_name),1)]),default:l(()=>[d("div",Kt,u(t.real_name),1)]),_:2},1024)])]))),128))])):(s(),p("div",Gt,[c.loading?x("",!0):(s(),p("div",Jt,[Qt,d("span",Wt,u(r.type=="icon"?o(i)("upload.iconEmpty"):o(i)("upload.attachmentEmpty")),1)]))]))]),_:1})])),[[Ue,c.loading]]),n(le,{gutter:20},{default:l(()=>[r.scene=="attachment"&&O.value===!0?(s(),v(M,{key:0,span:8},{default:l(()=>[d("div",Xt,[n(ke,{modelValue:T.value,"onUpdate:modelValue":e[8]||(e[8]=t=>T.value=t),label:o(i)("selectAll"),size:"large"},null,8,["modelValue","label"]),n(z,{class:"ml-[15px]",disabled:K.value,onClick:e[9]||(e[9]=t=>Y())},{default:l(()=>[k(u(o(i)("delete")),1)]),_:1},8,["disabled"]),n(z,{disabled:K.value,onClick:e[10]||(e[10]=t=>H())},{default:l(()=>[k(u(o(i)("upload.move")),1)]),_:1},8,["disabled"])])]),_:1})):x("",!0),n(M,{span:24},{default:l(()=>[d("div",Yt,[n(Ce,{"current-page":c.page,"onUpdate:current-page":e[11]||(e[11]=t=>c.page=t),small:!0,"page-size":c.limit,"onUpdate:page-size":e[12]||(e[12]=t=>c.limit=t),"page-sizes":[10,20,30,40,60],layout:"total, sizes, prev, pager, next, jumper",total:c.total,onSizeChange:e[13]||(e[13]=t=>o(A)()),onCurrentChange:o(A)},null,8,["current-page","page-size","total","onCurrentChange"])])]),_:1})]),_:1})]),r.scene=="attachment"?(s(),p(D,{key:0},[n(se,{modelValue:h.visible,"onUpdate:modelValue":e[17]||(e[17]=t=>h.visible=t),title:o(i)("upload.moveCategory"),width:"350px"},{footer:l(()=>[d("span",Ht,[n(z,{onClick:e[15]||(e[15]=t=>h.visible=!1)},{default:l(()=>[k(u(o(i)("cancel")),1)]),_:1}),n(z,{type:"primary",loading:h.loading,onClick:e[16]||(e[16]=t=>h.confirm())},{default:l(()=>[k(u(o(i)("confirm")),1)]),_:1},8,["loading"])])]),default:l(()=>[n(Ie,{"label-width":"60px"},{default:l(()=>[n($e,{label:o(i)("upload.moveTo"),style:{"margin-bottom":"0"}},{default:l(()=>[n(Ee,{modelValue:h.cateId,"onUpdate:modelValue":e[14]||(e[14]=t=>h.cateId=t),class:"input-width"},{default:l(()=>[(s(!0),p(D,null,R(I.data,(t,y)=>(s(),v(Ve,{label:t.name,value:t.id,key:y},null,8,["label","value"]))),128))]),_:1},8,["modelValue"])]),_:1},8,["label"])]),_:1})]),_:1},8,["modelValue","title"]),j.show?(s(),v(Ae,{key:0,"url-list":o(be),onClose:e[18]||(e[18]=t=>j.show=!1),"initial-index":j.index,"zoom-rate":1},null,8,["url-list","initial-index"])):x("",!0),n(se,{modelValue:F.visible,"onUpdate:modelValue":e[19]||(e[19]=t=>F.visible=t),width:"50%","align-center":"","destroy-on-close":!0,"custom-class":"video-preview"},{default:l(()=>[n(ze,{src:F.src,width:"100%"},null,8,["src"])]),_:1},8,["modelValue"])],64)):x("",!0)],2)}}});const Ea=vt(Zt,[["__scopeId","data-v-6207b4d0"]]);export{Ea as default};
