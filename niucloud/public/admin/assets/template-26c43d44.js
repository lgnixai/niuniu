import{d as A,x as $,f as j,n as R,r as x,h as u,c as y,e as t,w as o,a as _,t as p,u as e,i as b,q as a,R as z,s as C,B as I,F as M,T as U,aV as O,E as P,ay as W,az as Y,ad as G,aa as H,ae as J,a7 as K,Y as Q}from"./index-a7efb343.js";/* empty css                   *//* empty css                *//* empty css                 *//* empty css                    */import"./el-tooltip-4ed993c7.js";/* empty css                  *//* empty css                     */import{_ as X}from"./index.vue_vue_type_script_setup_true_lang-3b487378.js";/* empty css                        *//* empty css               *//* empty css                    *//* empty css                  */import{p as Z,q as ee}from"./wechat-14ab7f4e.js";import{e as ae}from"./notice-d84d1577.js";import{_ as te}from"./_plugin-vue_export-helper-c27b6911.js";const ne={class:"main-container"},le={class:"flex justify-between items-center"},oe={class:"text-page-title"},se={class:"flex items-center"},ce={class:"mr-[5px]"},ie=A({__name:"template",setup(re){const E=$(),T=j(),N=E.meta.title,c=R({loading:!0,data:[]}),f=x("/channel/wechat/message"),V=s=>{T.push({path:f.value})},g=(s=1)=>{c.loading=!0,Z().then(l=>{c.loading=!1;let d=[];l.data.forEach(i=>{if(i.notice.length){const m=[];Object.keys(i.notice).forEach((r,k)=>{const h=i.notice[r];h.addon_name=i.title,m.push(h)}),m.length&&(m[0].rowspan=m.length,d=d.concat(m))}}),c.data=d}).catch(l=>{c.loading=!1})};g();const B=s=>{if(s.columnIndex===0)return s.row.rowspan?{rowspan:s.row.rowspan,colspan:1}:{rowspan:0,colspan:0}},v=(s=null)=>{const l=O.service({lock:!0,background:"rgba(0, 0, 0, 0)"});ee({keys:s?[s.key]:[]}).then(()=>{g(),l.close()}).catch(()=>{l.close()})},q=s=>{const l=x({key:"",type:"",status:0});l.value.status=s.is_wechat?0:1,l.value.key=s.key,l.value.type="wechat",c.loading=!0,ae(l.value).then(d=>{g()}).catch(()=>{c.loading=!1})};return(s,l)=>{const d=P,i=W,m=Y,r=G,k=X,h=H,D=J,F=K,L=Q;return u(),y("div",ne,[t(F,{class:"card !border-none",shadow:"never"},{default:o(()=>[_("div",le,[_("span",oe,p(e(N)),1),t(d,{type:"primary",class:"w-[100px]",onClick:l[0]||(l[0]=n=>v())},{default:o(()=>[b(p(e(a)("batchAcquisition")),1)]),_:1})]),t(m,{modelValue:f.value,"onUpdate:modelValue":l[1]||(l[1]=n=>f.value=n),class:"my-[20px]",onTabChange:V},{default:o(()=>[t(i,{label:e(a)("wechatAccessFlow"),name:"/channel/wechat"},null,8,["label"]),t(i,{label:e(a)("customMenu"),name:"/channel/wechat/menu"},null,8,["label"]),t(i,{label:e(a)("wechatTemplate"),name:"/channel/wechat/message"},null,8,["label"]),t(i,{label:e(a)("reply"),name:"/channel/wechat/reply"},null,8,["label"])]),_:1},8,["modelValue"]),z((u(),C(D,{data:c.data,"span-method":B,size:"large"},{empty:o(()=>[_("span",null,p(c.loading?"":e(a)("emptyData")),1)]),default:o(()=>[t(r,{prop:"addon_name",label:e(a)("addon"),"min-width":"120"},null,8,["label"]),t(r,{prop:"name","show-overflow-tooltip":!0,label:e(a)("name"),"min-width":"150"},{default:o(({row:n})=>[_("div",se,[_("span",ce,p(n.name),1),n.wechat.tips?(u(),C(h,{key:0,content:n.wechat.tips,placement:"top"},{default:o(()=>[t(k,{name:"element WarningFilled"})]),_:2},1032,["content"])):I("",!0)])]),_:1},8,["label"]),t(r,{label:e(a)("messageType"),"min-width":"100",align:"center"},{default:o(({row:n})=>[_("span",null,p(n.message_type==1?e(a)("buyerNews"):e(a)("sellerMessage")),1)]),_:1},8,["label"]),t(r,{label:e(a)("isStart"),"min-width":"100",align:"center"},{default:o(({row:n})=>[b(p(n.is_wechat==1?e(a)("startUsing"):e(a)("statusDeactivate")),1)]),_:1},8,["label"]),t(r,{label:e(a)("response"),"min-width":"180"},{default:o(({row:n})=>[(u(!0),y(M,null,U(n.wechat.content,(w,S)=>(u(),y("div",{key:"a"+S,class:"text-left"},p(w.join("：")),1))),128))]),_:1},8,["label"]),t(r,{prop:"wechat_template_id",label:e(a)("serialNumber"),"min-width":"140"},null,8,["label"]),t(r,{label:e(a)("operation"),fixed:"right",align:"right",width:"200"},{default:o(({row:n})=>[t(d,{type:"primary",link:"",onClick:w=>q(n)},{default:o(()=>[b(p(n.is_wechat==1?e(a)("close"):e(a)("open")),1)]),_:2},1032,["onClick"]),t(d,{type:"primary",link:"",onClick:w=>v(n)},{default:o(()=>[b(p(e(a)("regain")),1)]),_:2},1032,["onClick"])]),_:1},8,["label"])]),_:1},8,["data"])),[[L,c.loading]])]),_:1})])}}});const Te=te(ie,[["__scopeId","data-v-c813a7b4"]]);export{Te as default};
