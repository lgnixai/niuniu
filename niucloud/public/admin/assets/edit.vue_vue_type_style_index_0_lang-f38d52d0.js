import{d as P,r as c,n as q,l as B,q as a,h as y,s as h,w as i,a as w,e as d,i as b,t as p,u as o,R as C,K as M,L as R,M as U,E as I,X as N,Y as T}from"./index-6405d5ac.js";/* empty css                   *//* empty css                  *//* empty css                   *//* empty css                  *//* empty css                     *//* empty css                 */import{e as $,a as j,g as L}from"./dict-fcda5e48.js";const O={class:"form-tip"},z={class:"dialog-footer"},W=P({__name:"edit",emits:["complete"],setup(A,{expose:V,emit:k}){const m=c(!1),s=c(!1),f={id:"",name:"",key:"",memo:""},t=q({...f}),_=c(),D=B(()=>({name:[{required:!0,message:a("namePlaceholder"),trigger:"blur"}],key:[{required:!0,message:a("keyPlaceholder"),trigger:"blur"},{validator:(n,e,l)=>{/^[a-zA-Z_]+$/.test(e)?l():l(new Error(a("keyFormatTips")))},trigger:"blur"}],data:[{required:!0,message:a("dataPlaceholder"),trigger:"blur"}]})),x=async n=>{if(s.value||!n)return;const e=t.id?$:j;await n.validate(async l=>{l&&(s.value=!0,e(t).then(g=>{s.value=!1,m.value=!1,k("complete")}).catch(()=>{s.value=!1}))})};return V({showDialog:m,setFormData:async(n=null)=>{if(Object.assign(t,f),s.value=!0,n){const e=await(await L(n.id)).data;e&&Object.keys(t).forEach(l=>{e[l]!=null&&(t[l]=e[l])})}s.value=!1}}),(n,e)=>{const l=M,u=R,g=U,v=I,E=N,F=T;return y(),h(E,{modelValue:m.value,"onUpdate:modelValue":e[5]||(e[5]=r=>m.value=r),title:t.id?o(a)("updateDict"):o(a)("addDict"),width:"480",class:"diy-dialog-wrap","destroy-on-close":!0},{footer:i(()=>[w("span",z,[d(v,{onClick:e[3]||(e[3]=r=>m.value=!1)},{default:i(()=>[b(p(o(a)("cancel")),1)]),_:1}),d(v,{type:"primary",loading:s.value,onClick:e[4]||(e[4]=r=>x(_.value))},{default:i(()=>[b(p(o(a)("confirm")),1)]),_:1},8,["loading"])])]),default:i(()=>[C((y(),h(g,{model:t,"label-width":"120px",ref_key:"formRef",ref:_,rules:o(D),class:"page-form"},{default:i(()=>[d(u,{label:o(a)("name"),prop:"name"},{default:i(()=>[d(l,{modelValue:t.name,"onUpdate:modelValue":e[0]||(e[0]=r=>t.name=r),modelModifiers:{trim:!0},clearable:"",maxlength:"40","show-word-limit":"",placeholder:o(a)("namePlaceholder"),class:"input-width"},null,8,["modelValue","placeholder"])]),_:1},8,["label"]),d(u,{label:o(a)("key"),prop:"key"},{default:i(()=>[d(l,{modelValue:t.key,"onUpdate:modelValue":e[1]||(e[1]=r=>t.key=r),modelModifiers:{trim:!0},clearable:"",maxlength:"40","show-word-limit":"",placeholder:o(a)("keyPlaceholder"),class:"input-width"},null,8,["modelValue","placeholder"]),w("p",O,p(o(a)("keyFormatTips")),1)]),_:1},8,["label"]),d(u,{label:o(a)("memo")},{default:i(()=>[d(l,{modelValue:t.memo,"onUpdate:modelValue":e[2]||(e[2]=r=>t.memo=r),modelModifiers:{trim:!0},type:"textarea",clearable:"",placeholder:o(a)("memoPlaceholder"),class:"input-width"},null,8,["modelValue","placeholder"])]),_:1},8,["label"])]),_:1},8,["model","rules"])),[[F,s.value]])]),_:1},8,["modelValue","title"])}}});export{W as _};