import{d as T,r as m,l as O,q as o,H as x,h as b,s as V,w as s,a as f,e as u,i as h,t as _,u as r,R as j,c as z,F as A,T as H,B as K,K as X,L as Y,aw as J,bV as Q,ad as W,ae as Z,M as ee,V as le,E as ae,X as oe,Y as te}from"./index-6405d5ac.js";/* empty css                   *//* empty css                  *//* empty css                   *//* empty css                  *//* empty css                     *//* empty css                     *//* empty css                 *//* empty css                    */import"./el-tooltip-4ed993c7.js";/* empty css                  *//* empty css                        *//* empty css               *//* empty css                          */import re from"./index-4b0a6750.js";/* empty css                 */import{m as ue}from"./site-0fb01aff.js";import{d as se,f as ie,h as ne}from"./user-d23e65b7.js";const de={class:"max-h-[60vh]"},me={class:"w-full"},pe={class:"dialog-footer"},$e=T({__name:"user-edit",emits:["complete"],setup(_e,{expose:B,emit:M}){const p=m(!1),d=m(!0),l=m({uid:0,username:"",password:"",head_img:"",real_name:"",confirm_password:"",create_site_limit:[],group_ids:[]}),c=m({}),P=m(),N=O(()=>({username:[{required:!0,message:o("usernamePlaceholder"),trigger:"blur"}],password:[{required:l.value.uid==0,message:o("passwordPlaceholder"),trigger:"blur"}],real_name:[{required:!0,message:o("userRealNamePlaceholder"),trigger:"blur"}],confirm_password:[{required:l.value.uid==0,message:o("confirmPasswordPlaceholder"),trigger:"blur"},{validator:(i,e,t)=>{e!=l.value.password?t(new Error(o("confirmPasswordError"))):t()},trigger:"blur"}],create_site_limit:[{validator:(i,e,t)=>{l.value.uid&&t();let n=!0;for(let w=0;w<l.value.create_site_limit.length;w++){const v=l.value.create_site_limit[w];if(x.empty(v.num)){t(o("siteNumPlaceholder")),n=!1;break}if(v.num<1){t(o("siteNumCannotLtOne")),n=!1;break}if(x.empty(v.month)){t(o("siteMonthPlaceholder")),n=!1;break}if(v.month<0){t(o("siteMonthCannotLtOne")),n=!1;break}}n&&t()}}]}));ue().then(({data:i})=>{const e={};i.forEach(t=>{e[t.group_id]=t}),c.value=e});const $=(i=0)=>{i?se(i).then(({data:e})=>{l.value.uid=e.uid,l.value.username=e.username,l.value.real_name=e.real_name,l.value.head_img=e.head_img,d.value=!1,p.value=!0}):(l.value={uid:0,username:"",password:"",head_img:"",real_name:"",confirm_password:"",create_site_limit:[],group_ids:[]},d.value=!1,p.value=!0)},I=i=>{let e=[];i.forEach(t=>{e.push({group_id:t,num:1,month:1})}),l.value.create_site_limit=e},L=async i=>{d.value||!i||await i.validate(async e=>{e&&(d.value=!0,(l.value.uid?ie:ne)(l.value).then(()=>{d.value=!1,p.value=!1,M("complete")}).catch(()=>{d.value=!1}))})},g=m(!0),y=m(!0),C=m(!0);return B({showDialog:p,setFormData:$}),(i,e)=>{const t=X,n=Y,w=re,v=J,R=Q,U=W,S=Z,D=ee,q=le,k=ae,F=oe,G=te;return b(),V(F,{modelValue:p.value,"onUpdate:modelValue":e[16]||(e[16]=a=>p.value=a),title:l.value.uid?r(o)("updateUser"):r(o)("addUser"),width:"750px","destroy-on-close":!0},{footer:s(()=>[f("span",pe,[u(k,{onClick:e[14]||(e[14]=a=>p.value=!1)},{default:s(()=>[h(_(r(o)("cancel")),1)]),_:1}),u(k,{type:"primary",loading:d.value,onClick:e[15]||(e[15]=a=>L(P.value))},{default:s(()=>[h(_(r(o)("confirm")),1)]),_:1},8,["loading"])])]),default:s(()=>[u(q,null,{default:s(()=>[f("div",de,[j((b(),V(D,{model:l.value,"label-width":"120px",ref_key:"formRef",ref:P,rules:r(N),class:"page-form",autocomplete:"off"},{default:s(()=>[u(n,{label:r(o)("username"),prop:"username"},{default:s(()=>[u(t,{modelValue:l.value.username,"onUpdate:modelValue":e[0]||(e[0]=a=>l.value.username=a),modelModifiers:{trim:!0},clearable:"",placeholder:r(o)("usernamePlaceholder"),class:"input-width",readonly:l.value.uid,disabled:l.value.uid,onClick:e[1]||(e[1]=a=>g.value=!1),onBlur:e[2]||(e[2]=a=>g.value=!0)},null,8,["modelValue","placeholder","readonly","disabled"])]),_:1},8,["label"]),u(n,{label:r(o)("headImg")},{default:s(()=>[u(w,{modelValue:l.value.head_img,"onUpdate:modelValue":e[3]||(e[3]=a=>l.value.head_img=a)},null,8,["modelValue"])]),_:1},8,["label"]),u(n,{label:r(o)("userRealName"),prop:"real_name"},{default:s(()=>[u(t,{modelValue:l.value.real_name,"onUpdate:modelValue":e[4]||(e[4]=a=>l.value.real_name=a),modelModifiers:{trim:!0},placeholder:r(o)("userRealNamePlaceholder"),readonly:g.value,onClick:e[5]||(e[5]=a=>g.value=!1),onBlur:e[6]||(e[6]=a=>g.value=!0),clearable:"",class:"input-width",maxlength:"10","show-word-limit":""},null,8,["modelValue","placeholder","readonly"])]),_:1},8,["label"]),u(n,{label:r(o)("password"),prop:"password"},{default:s(()=>[u(t,{modelValue:l.value.password,"onUpdate:modelValue":e[7]||(e[7]=a=>l.value.password=a),modelModifiers:{trim:!0},clearable:"",placeholder:r(o)("passwordPlaceholder"),class:"input-width","show-password":!0,type:"password",readonly:y.value,onClick:e[8]||(e[8]=a=>y.value=!1),onBlur:e[9]||(e[9]=a=>y.value=!0)},null,8,["modelValue","placeholder","readonly"])]),_:1},8,["label"]),u(n,{label:r(o)("confirmPassword"),prop:"confirm_password"},{default:s(()=>[u(t,{modelValue:l.value.confirm_password,"onUpdate:modelValue":e[10]||(e[10]=a=>l.value.confirm_password=a),modelModifiers:{trim:!0},placeholder:r(o)("confirmPasswordPlaceholder"),type:"password","show-password":!0,clearable:"",class:"input-width",readonly:C.value,onClick:e[11]||(e[11]=a=>C.value=!1),onBlur:e[12]||(e[12]=a=>C.value=!0)},null,8,["modelValue","placeholder","readonly"])]),_:1},8,["label"]),!l.value.uid&&Object.keys(c.value).length?(b(),V(n,{key:0,label:r(o)("userCreateSiteLimit"),prop:"create_site_limit"},{default:s(()=>[f("div",null,[f("div",null,_(r(o)("siteGroup")),1),u(R,{modelValue:l.value.group_ids,"onUpdate:modelValue":e[13]||(e[13]=a=>l.value.group_ids=a),onChange:I},{default:s(()=>[(b(!0),z(A,null,H(c.value,a=>(b(),V(v,{label:a.group_id},{default:s(()=>[h(_(a.group_name),1)]),_:2},1032,["label"]))),256))]),_:1},8,["modelValue"])]),f("div",me,[f("div",null,_(r(o)("userCreateSiteLimit")),1),u(S,{data:l.value.create_site_limit,size:"large",class:"w-full"},{default:s(()=>[u(U,{label:r(o)("siteGroup"),"show-overflow-tooltip":!0},{default:s(({row:a})=>[h(_(c.value[a.group_id]?c.value[a.group_id].group_name:""),1)]),_:1},8,["label"]),u(U,{label:r(o)("createSiteNum")},{default:s(({$index:a})=>[u(t,{modelValue:l.value.create_site_limit[a].num,"onUpdate:modelValue":E=>l.value.create_site_limit[a].num=E,modelModifiers:{number:!0,trim:!0}},null,8,["modelValue","onUpdate:modelValue"])]),_:1},8,["label"]),u(U,{label:r(o)("siteMonth")},{default:s(({$index:a})=>[u(t,{modelValue:l.value.create_site_limit[a].month,"onUpdate:modelValue":E=>l.value.create_site_limit[a].month=E,modelModifiers:{number:!0,trim:!0}},{append:s(()=>[h(_(r(o)("month")),1)]),_:2},1032,["modelValue","onUpdate:modelValue"])]),_:1},8,["label"])]),_:1},8,["data"])])]),_:1},8,["label"])):K("",!0)]),_:1},8,["model","rules"])),[[G,d.value]])])]),_:1})]),_:1},8,["modelValue","title"])}}});export{$e as _};
