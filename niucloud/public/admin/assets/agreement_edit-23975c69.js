import{d as q,x as M,f as N,r as y,bZ as P,n as S,l as T,q as r,h,c as I,e as a,w as s,u as n,aQ as U,R as j,s as A,a as w,i as k,t as x,b_ as L,b$ as O,aR as H,a7 as K,K as Q,L as Y,M as Z,E as z,Y as G}from"./index-a7efb343.js";/* empty css                   *//* empty css                  *//* empty css                */import{_ as J}from"./index.vue_vue_type_script_setup_true_lang-3db8e433.js";import"./el-form-item-4ed993c7.js";/* empty css                 *//* empty css                *//* empty css                       */import"./index.vue_vue_type_style_index_0_lang-780ddbe3.js";/* empty css                  *//* empty css                   */import"./attachment-3f73eb3a.js";import"./index.vue_vue_type_script_setup_true_lang-f01f3fe6.js";/* empty css                        *//* empty css               *//* empty css                  *//* empty css                  *//* empty css                     *//* empty css                  *//* empty css                      *//* empty css                    */import"./el-tooltip-4ed993c7.js";/* empty css                 *//* empty css               *//* empty css                    *//* empty css                    */import"./el-dropdown-item-4ed993c7.js";import"./index.vue_vue_type_script_setup_true_lang-f863d122.js";/* empty css                   */import"./index.vue_vue_type_script_setup_true_lang-3b487378.js";import"./_plugin-vue_export-helper-c27b6911.js";const W={class:"main-container"},X={class:"fixed-footer-wrap"},ee={class:"fixed-footer"},Pe=q({__name:"agreement_edit",setup(te){const d=M(),V=N(),u=d.query.key||"",i=y(!1),E=P(),R=d.meta.title,_={agreement_key:"",content:"",title:"",agreement_key_name:""},t=S({..._});i.value=!0,u&&(async(m="")=>{Object.assign(t,_);const e=await(await L(m)).data;Object.keys(t).forEach(o=>{e[o]!=null&&(t[o]=e[o])}),i.value=!1})(u);const f=y(),B=T(()=>({title:[{required:!0,message:r("titlePlaceholder"),trigger:"blur"}],content:[{required:!0,trigger:["blur","change"],validator:(m,e,o)=>{if(e==="")o(new Error(r("contentPlaceholder")));else{if(e.length<5||e.length>5e4)return o(new Error(r("contentMaxTips"))),!1;o()}}}]})),D=async m=>{i.value||!m||await m.validate(async e=>{if(e){i.value=!0;const o=t;o.key=t.agreement_key,O(o).then(p=>{i.value=!1,g()}).catch(()=>{i.value=!1})}})},g=()=>{E.removeTab(d.path),V.push({path:"/setting/agreement"})};return(m,e)=>{const o=H,p=K,v=Q,c=Y,$=J,C=Z,b=z,F=G;return h(),I("div",W,[a(p,{class:"card !border-none",shadow:"never"},{default:s(()=>[a(o,{content:n(R),icon:n(U),onBack:e[0]||(e[0]=l=>m.$router.back())},null,8,["content","icon"])]),_:1}),j((h(),A(p,{class:"box-card mt-[15px] !border-none",shadow:"never"},{default:s(()=>[a(C,{model:t,"label-width":"90px",ref_key:"formRef",ref:f,rules:n(B),class:"page-form"},{default:s(()=>[a(c,{label:n(r)("type")},{default:s(()=>[a(v,{modelValue:t.agreement_key_name,"onUpdate:modelValue":e[1]||(e[1]=l=>t.agreement_key_name=l),modelModifiers:{trim:!0},readonly:"",class:"input-width"},null,8,["modelValue"])]),_:1},8,["label"]),a(c,{label:n(r)("title"),prop:"title"},{default:s(()=>[a(v,{modelValue:t.title,"onUpdate:modelValue":e[2]||(e[2]=l=>t.title=l),modelModifiers:{trim:!0},clearable:"",placeholder:n(r)("titlePlaceholder"),class:"input-width",maxlength:"20"},null,8,["modelValue","placeholder"])]),_:1},8,["label"]),a(c,{label:n(r)("content"),prop:"content"},{default:s(()=>[a($,{modelValue:t.content,"onUpdate:modelValue":e[3]||(e[3]=l=>t.content=l)},null,8,["modelValue"])]),_:1},8,["label"])]),_:1},8,["model","rules"])]),_:1})),[[F,i.value]]),w("div",X,[w("div",ee,[a(b,{type:"primary",onClick:e[4]||(e[4]=l=>D(f.value))},{default:s(()=>[k(x(n(r)("save")),1)]),_:1}),a(b,{onClick:e[5]||(e[5]=l=>g())},{default:s(()=>[k(x(n(r)("cancel")),1)]),_:1})])])])}}});export{Pe as default};