import{d as e,j as l,r as a,l as t,k as r,p as o,s,t as i,a as n,q as u,O as d,U as p,o as m,c,w as x,b as g,y as b,z as f,u as h,V as v,W as _,f as y,X as k,A as w,n as C,F as V,Y as T,Z as F,H as S,$ as A,a0 as P,i as L,g as j,h as z,D as U,C as q,G as B,R as O,S as R,T as I,I as $,J as D,_ as E}from"./index-06110d51.js";import{_ as G}from"./sms-code.vue_vue_type_script_setup_true_lang.79681ef1.js";import{t as H}from"./topTabbar.88fd7aa2.js";const J=E(e({__name:"login",setup(e){let E={};H().setTopTabbarParam({title:"",topStatusBar:{bgColor:"#fff",textColor:"#333"}}),l((()=>Object.keys(E).length?B(Number(E.height))+B(E.top)+B(8)+"rpx":"auto"));const J=a(!0),N=t(),W=r(),X=a(""),Y=a(!1),Z=a(!1);o((async e=>{await W.getLoginConfig(),s()||W.login.is_username||W.login.is_mobile||(i({title:"商家未开启普通账号登录",icon:"none"}),setTimeout((()=>{n({url:"/app/pages/index/index",mode:"reLaunch"})}),100)),e.type?"mobile"==e.type?W.login.is_mobile&&(X.value=e.type,uni.getStorageSync("pid")&&Object.assign(K,{pid:uni.getStorageSync("pid")})):"username"==e.type&&W.login.is_username&&(X.value=e.type):W.login.is_username?X.value="username":W.login.is_mobile&&(X.value="mobile"),u()?!W.login.is_username||W.login.is_mobile||W.login.is_auth_register?Z.value=!0:Z.value=!1:W.login.is_username&&!W.login.is_mobile?Z.value=!1:Z.value=!0}));const K=d({username:"",password:"",mobile:"",mobile_code:"",mobile_key:""});p((()=>{setTimeout((()=>{J.value=!1}),800)}));const M=()=>{Y.value=!Y.value},Q=()=>{X.value="username"==X.value?"mobile":"username"},ee=a(!1),le=l((()=>({username:{type:"string",required:"username"==X.value,message:V("usernamePlaceholder"),trigger:["blur","change"]},password:{type:"string",required:"username"==X.value,message:V("passwordPlaceholder"),trigger:["blur","change"]},mobile:[{type:"string",required:"mobile"==X.value,message:V("mobilePlaceholder"),trigger:["blur","change"]},{validator:(e,l)=>"mobile"!=X.value||uni.$u.test.mobile(l),message:V("mobileError"),trigger:["change","blur"]}],mobile_code:{type:"string",required:"mobile"==X.value,message:V("codePlaceholder"),trigger:["blur","change"]}}))),ae=a(null),te=()=>{ae.value.validate().then((()=>{if(W.login.agreement_show&&!Y.value)return i({title:V("isAgreeTips"),icon:"none"}),!1;if(ee.value)return;ee.value=!0;("username"==X.value?T:F)(K).then((e=>{N.setToken(e.data.token),W.login.is_bind_mobile&&!e.data.mobile&&uni.setStorageSync("isbindmobile",!0),S().handleLoginBack()})).catch((()=>{ee.value=!1}))}))},re=()=>{const e=A();if(e.length>1){"app/pages/auth/index"==e[e.length-2].route?P({delta:1}):n({url:"/app/pages/auth/index",mode:"redirectTo"})}else n({url:"/app/pages/auth/index",mode:"redirectTo"})};return(e,l)=>{const a=L,t=j(z("u-input"),O),r=j(z("u-form-item"),R),o=j(z("sms-code"),G),s=j(z("u-form"),I),i=j(z("u-checkbox"),$),u=j(z("u-checkbox-group"),D),d=U,p=q;return X.value?(m(),c(a,{key:0,class:"w-screen h-screen flex flex-col",style:C(e.themeColor())},{default:x((()=>[g(a,{class:"mx-[60rpx]"},{default:x((()=>[g(a,{class:"pt-[140rpx] text-[44rpx] font-500 text-[#333]"},{default:x((()=>[b(f("username"==X.value?h(V)("accountLogin"):h(V)("mobileLogin")),1)])),_:1}),g(a,{class:"text-[26rpx] leading-[39rpx] text-[var(--text-color-light6)] mt-[16rpx] mb-[80rpx]"},{default:x((()=>[b(f("username"==X.value?h(V)("accountLoginTip"):h(V)("mobileLoginTip")),1)])),_:1}),g(s,{labelPosition:"left",model:K,errorType:"toast",rules:h(le),ref_key:"formRef",ref:ae},{default:x((()=>["username"==X.value?(m(),v(_,{key:0},[g(a,{class:"h-[88rpx] flex w-full items-center px-[30rpx] rounded-[var(--goods-rounded-mid)] box-border bg-[#F6F6F6]"},{default:x((()=>[g(r,{label:"",prop:"username","border-bottom":!1},{default:x((()=>[g(t,{modelValue:K.username,"onUpdate:modelValue":l[0]||(l[0]=e=>K.username=e),border:"none",maxlength:"40",placeholder:h(V)("usernamePlaceholder"),autocomplete:"off",class:"!bg-transparent",disabled:J.value,fontSize:"26rpx",placeholderClass:"!text-[var(--text-color-light9)] text-[26rpx]"},null,8,["modelValue","placeholder","disabled"])])),_:1})])),_:1}),g(a,{class:"h-[88rpx] flex w-full items-center px-[30rpx] rounded-[var(--goods-rounded-mid)] box-border bg-[#F6F6F6] mt-[40rpx]"},{default:x((()=>[g(r,{label:"",prop:"password","border-bottom":!1},{default:x((()=>[g(t,{modelValue:K.password,"onUpdate:modelValue":l[1]||(l[1]=e=>K.password=e),border:"none",type:"password",maxlength:"40",placeholder:h(V)("passwordPlaceholder"),autocomplete:"new-password",class:"!bg-transparent",disabled:J.value,fontSize:"26rpx",placeholderClass:"!text-[var(--text-color-light9)] text-[26rpx]"},null,8,["modelValue","placeholder","disabled"])])),_:1})])),_:1})],64)):y("v-if",!0),"mobile"==X.value?(m(),v(_,{key:1},[g(a,{class:"h-[88rpx] flex w-full items-center px-[30rpx] rounded-[var(--goods-rounded-mid)] box-border bg-[#F6F6F6]"},{default:x((()=>[g(r,{label:"",prop:"mobile","border-bottom":!1},{default:x((()=>[g(t,{modelValue:K.mobile,"onUpdate:modelValue":l[2]||(l[2]=e=>K.mobile=e),type:"number",maxlength:"11",border:"none",placeholder:h(V)("mobilePlaceholder"),autocomplete:"off",class:"!bg-transparent",disabled:J.value,fontSize:"26rpx",placeholderClass:"!text-[var(--text-color-light9)] text-[26rpx]"},null,8,["modelValue","placeholder","disabled"])])),_:1})])),_:1}),g(a,{class:"h-[88rpx] flex w-full items-center px-[30rpx] rounded-[var(--goods-rounded-mid)] box-border bg-[#F6F6F6] mt-[40rpx] text-[26rpx]"},{default:x((()=>[g(r,{label:"",prop:"mobile_code","border-bottom":!1},{default:x((()=>[g(t,{modelValue:K.mobile_code,"onUpdate:modelValue":l[5]||(l[5]=e=>K.mobile_code=e),type:"number",maxlength:"4",border:"none",class:"!bg-transparent",fontSize:"26rpx",disabled:J.value,placeholder:h(V)("codePlaceholder"),placeholderClass:"!text-[var(--text-color-light9)] text-[26rpx]"},{suffix:x((()=>[h(W).login.agreement_show?(m(),c(o,{key:0,mobile:K.mobile,type:"login",modelValue:K.mobile_key,"onUpdate:modelValue":l[3]||(l[3]=e=>K.mobile_key=e),isAgree:Y.value},null,8,["mobile","modelValue","isAgree"])):(m(),c(o,{key:1,mobile:K.mobile,type:"login",modelValue:K.mobile_key,"onUpdate:modelValue":l[4]||(l[4]=e=>K.mobile_key=e)},null,8,["mobile","modelValue"]))])),_:1},8,["modelValue","disabled","placeholder"])])),_:1})])),_:1})],64)):y("v-if",!0)])),_:1},8,["model","rules"]),"username"==X.value?(m(),c(a,{key:0,class:"text-right text-[24rpx] text-[var(--text-color-light9)] leading-[34rpx] mt-[20rpx]",onClick:l[6]||(l[6]=e=>h(n)({url:"/app/pages/auth/resetpwd"}))},{default:x((()=>[b(f(h(V)("resetpwd")),1)])),_:1})):y("v-if",!0),g(a,{class:k({"mt-[160rpx]":"username"!=X.value,"mt-[106rpx]":"username"==X.value})},{default:x((()=>[h(W).login.agreement_show?(m(),c(a,{key:0,class:"flex items-center mb-[20rpx] py-[10rpx]",onClick:w(M,["stop"])},{default:x((()=>[g(u,{onChange:M},{default:x((()=>[g(i,{activeColor:"var(--primary-color)",checked:Y.value,shape:"circle",size:"24rpx",customStyle:{marginTop:"4rpx"}},null,8,["checked"])])),_:1}),g(a,{class:"text-[24rpx] text-[var(--text-color-light6)] flex items-center flex-wrap"},{default:x((()=>[g(d,null,{default:x((()=>[b(f(h(V)("agreeTips")),1)])),_:1}),g(d,{onClick:l[7]||(l[7]=w((e=>h(n)({url:"/app/pages/auth/agreement?key=privacy"})),["stop"])),class:"text-primary"},{default:x((()=>[b("《"+f(h(V)("privacyAgreement"))+"》",1)])),_:1}),g(d,null,{default:x((()=>[b(f(h(V)("and")),1)])),_:1}),g(d,{onClick:l[8]||(l[8]=w((e=>h(n)({url:"/app/pages/auth/agreement?key=service"})),["stop"])),class:"text-primary"},{default:x((()=>[b("《"+f(h(V)("userAgreement"))+"》",1)])),_:1})])),_:1})])),_:1},8,["onClick"])):y("v-if",!0),g(p,{class:"w-full h-[80rpx] !bg-[var(--primary-color)] text-[26rpx] rounded-[40rpx] leading-[80rpx] font-500 !text-[#fff] !mx-[0]",loadingText:h(V)("logining"),onClick:te},{default:x((()=>[b(f(h(V)("login")),1)])),_:1},8,["loadingText"]),g(a,{class:"flex items-center justify-between mt-[30rpx]"},{default:x((()=>["username"==X.value&&h(W).login.is_mobile||"mobile"==X.value&&h(W).login.is_username?(m(),c(a,{key:0,class:"text-[26rpx] text-[var(--text-color-light6)] leading-[34rpx]",onClick:Q},{default:x((()=>[b(f("username"==X.value?h(V)("mobileLogin"):h(V)("accountLogin")),1)])),_:1})):y("v-if",!0),g(a,{class:"text-[26rpx] text-[#333] leading-[34rpx]",onClick:l[9]||(l[9]=e=>h(n)({url:"/app/pages/auth/register",param:{type:X.value}}))},{default:x((()=>[g(d,null,{default:x((()=>[b(f(h(V)("noAccount"))+",",1)])),_:1}),g(d,{class:"text-primary"},{default:x((()=>[b(f(h(V)("toRegister")),1)])),_:1})])),_:1})])),_:1})])),_:1},8,["class"])])),_:1}),Z.value?(m(),c(a,{key:0,class:"footer w-full"},{default:x((()=>[g(a,{class:"text-[26rpx] leading-[36rpx] text-[#333] text-center mb-[30rpx] font-400"},{default:x((()=>[b(f(h(V)("oneClicklogin")),1)])),_:1}),g(a,{class:"flex justify-center"},{default:x((()=>[g(p,{class:"h-[80rpx] w-[80rpx] text-[46rpx] !text-[#1AAB37] text-center !p-0 !bg-transparent leading-[79rpx] border-[2rpx] rounded-[50%] border-solid border-[#ddd] nc-iconfont nc-icon-weixinV6mm overflow-hidden",onClick:re})])),_:1})])),_:1})):y("v-if",!0)])),_:1},8,["style"])):y("v-if",!0)}}}),[["__scopeId","data-v-6d83aeb8"]]);export{J as default};
