import{d as h,r as m,n as y,l as w,Q as i,h as E,s as N,w as d,e as r,a as u,aw as j,K as k,L as B,M as C}from"./index-6405d5ac.js";/* empty css                     *//* empty css                 *//* empty css                    */const O=u("span",{class:"ml-[10px] el-form-item__label"},"送",-1),R={class:"w-[70px]"},$=u("span",{class:"ml-[15px] el-form-item__label"},"积分",-1),z=h({__name:"gift-point",props:{modelValue:{type:Object,default:()=>({})}},emits:["update:modelValue"],setup(p,{expose:_,emit:f}){const c=p,t=m({is_use:0,num:""}),n=m(null),v={required:/[\S]+/,number:/^\d{0,10}$/,digit:/^\d{0,10}(.?\d{0,2})$/,special:/^\d{0,10}(.?\d{0,3})$/},V=y({num:[{validator:(s,e,l)=>{t.value.is_use?e.length==0?l("请输入积分数量"):isNaN(e)||!v.number.test(e)?l("积分数量格式错误"):e<=0?l("积分数量不能小于等于0"):l():l()},trigger:"blur"}]}),o=w({get(){return c.modelValue},set(s){f("update:modelValue",s)}});return i(()=>o.value,(s,e)=>{(!e||!Object.keys(e).length)&&Object.keys(s).length&&(t.value=o.value)},{immediate:!0}),i(()=>t.value,()=>{o.value=t.value},{deep:!0}),_({verify:async()=>{var e;let s=!0;return await((e=n.value)==null?void 0:e.validate(l=>{s=l})),s}}),(s,e)=>{const l=j,b=k,g=B,x=C;return E(),N(x,{ref_key:"formRef",ref:n,model:t.value,rules:V},{default:d(()=>[r(g,{label:"",prop:"num"},{default:d(()=>[r(l,{modelValue:t.value.is_use,"onUpdate:modelValue":e[0]||(e[0]=a=>t.value.is_use=a),"true-label":1,"false-label":0,label:"",size:"large"},null,8,["modelValue"]),O,u("div",R,[r(b,{modelValue:t.value.num,"onUpdate:modelValue":e[1]||(e[1]=a=>t.value.num=a),modelModifiers:{trim:!0},clearable:""},null,8,["modelValue"])]),$]),_:1})]),_:1},8,["model","rules"])}}});export{z as default};