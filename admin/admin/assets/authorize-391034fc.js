import{d as Z,r as l,l as ee,n as z,q as n,a2 as N,h as r,c as C,s as f,w as a,a as e,u as i,i as p,e as o,t as m,B as E,F as te,T as ae,U as oe,a3 as se,a4 as le,a5 as ne,E as re,a1 as ie,a6 as ce,K as de,L as ue,a7 as pe,M as _e,X as me,a8 as xe,a9 as fe}from"./index-6405d5ac.js";/* empty css                  *//* empty css                   *//* empty css                     *//* empty css                *//* empty css                 *//* empty css                  *//* empty css                   *//* empty css                  */import{g as he,a as ve,s as ge}from"./module-9f8b7ad5.js";import ye from"./index-eef01836.js";import we from"./index-fd2609e9.js";import"./dark-3a1f6ef0.js";/* empty css               *//* empty css                     *//* empty css                 */import"./_plugin-vue_export-helper-c27b6911.js";/* empty css                   */const ke={class:"main-container"},Ce={class:"flex"},Ve={class:"w-[450px] mr-[20px] p-[50px] bg-[var(--el-color-info-light-9)]"},be={class:"flex items-center justify-between"},Be=e("span",{class:"text-page-title"},"版本信息",-1),Te={class:"flex-1 w-0 flex justify-end"},Ee={class:"mt-[30px] flex items-center text-[14px] text-[#797979]"},Ie=e("span",null,"当前版本",-1),Ae={class:"text-[26px] ml-[15px] mr-[10px] text-[#656668]"},Fe={key:0,class:"text-[12px]"},Le={key:1,class:"text-[12px] text-[red]"},Me={class:"flex flex-1 justify-between items-center p-[50px] bg-[var(--el-color-info-light-9)]"},De={class:"flex flex-col"},Re={class:"flex flex-wrap items-center"},Ue=e("p",{class:"text-page-title mr-[20px]"},"授权信息",-1),je={class:"text-[14px] text-[#666]"},He={class:"mt-[46px] ml-[40px] flex flex-wrap"},Pe={class:"text-[14px] mr-[84px]"},ze={class:"ml-[12px] text-[12px]"},Ne={class:"text-[14px] flex items-center"},$e=e("span",null,"授权码",-1),qe={class:"ml-[12px] mr-[10px] text-[12px]"},Se={class:"flex flex-1 flex-wrap justify-end relative"},Ke={class:"px-[18px] py-[8px]"},Xe=e("p",{class:"leading-[32px] text-[14px]"},"您在官方应用市场购买任意一款应用，即可获得授权码。输入正确授权码认证通过后，即可支持在线升级和其它相关服务",-1),Ge={class:"flex justify-end mt-[36px]"},Je={class:"mt-[20px]"},Oe={class:"text-sm mt-[10px] text-info"},Qe={class:"mt-[20px]"},We={class:"mt-[10px] text-right"},Ye=e("div",{class:"text-page-title mb-[20px]"},"历史版本",-1),Ze={key:0,class:"mt-[10px] p-[20px] bg-overlay rounded-md timeline-log-wrap whitespace-pre-wrap"},et=["innerHTML"],wt=Z({__name:"authorize",setup(tt){const I=l(null),y=l(null),A=l(null),h=l(!1),v=l(!1),V=l([]),F=l(!1),L=()=>{he().then(({data:s})=>{V.value=s,F.value?(!d.value||d.value&&d.value.version_no==k.value)&&oe({message:n("versionTips"),type:"success"}):F.value=!0})};L();const d=ee(()=>V.value.length?V.value[0]:null),$=s=>{const t=se(s);return t.slice(0,t.length/2)+t.slice(t.length/2,t.length-1).replace(/./g,"*")},B=()=>{h.value=!0},_=l({company_name:"",site_address:"",auth_code:""}),b=l(!0),w=l(!1),M=()=>{ve().then(s=>{b.value=!1,s.data.data&&s.data.data.length!=0&&(_.value=s.data.data,h.value=!1)}).catch(()=>{b.value=!1,h.value=!1})};M();const g=z({auth_code:"",auth_secret:""}),D=l(),q=z({auth_code:[{required:!0,message:n("authCodePlaceholder"),trigger:"blur"}],auth_secret:[{required:!0,message:n("authSecretPlaceholder"),trigger:"blur"}]}),S=async s=>{w.value||!s||await s.validate(async t=>{t&&(w.value=!0,ge(g).then(()=>{w.value=!1,M()}).catch(()=>{w.value=!1,h.value=!1}))})},R=()=>{window.open("https://www.niucloud.com/app")},k=l("");(()=>{le().then(s=>{k.value=s.data.version.version})})();const K=()=>{var s;if(!_.value.auth_code){B();return}(s=I.value)==null||s.open()},U=()=>{var s;if(!_.value.auth_code){B();return}if(y.value.cloudBuildTask){(s=y.value)==null||s.open();return}ne.confirm(n("cloudBuildTips"),n("warning"),{confirmButtonText:n("confirm"),cancelButtonText:n("cancel"),type:"warning"}).then(()=>{var t;(t=y.value)==null||t.open()})};return(s,t)=>{const u=re,X=N("View"),j=ie,G=N("Hide"),J=ce,H=de,P=ue,T=pe,O=_e,Q=me,W=xe,Y=fe;return r(),C("div",ke,[b.value?E("",!0):(r(),f(T,{key:0,class:"box-card !border-none",shadow:"never"},{default:a(()=>{var x;return[e("div",Ce,[e("div",Ve,[e("div",be,[Be,e("div",Te,[!i(d)||i(d)&&i(d).version_no==k.value?(r(),f(u,{key:0,class:"text-[#4C4C4C] w-[78px] h-[32px] !bg-transparent",onClick:L},{default:a(()=>[p("检测更新")]),_:1})):(r(),f(u,{key:1,class:"text-[#4C4C4C] w-[78px] h-[32px]",type:"primary",onClick:K},{default:a(()=>[p("一键升级")]),_:1})),o(u,{class:"text-[#4C4C4C] w-[78px] h-[32px]",type:"primary",onClick:U,loading:(x=y.value)==null?void 0:x.loading},{default:a(()=>[p("云编译")]),_:1},8,["loading"])])]),e("div",Ee,[Ie,e("span",Ae,m(k.value),1),!i(d)||i(d)&&i(d).version_no==k.value?(r(),C("em",Fe,"(当前已是最新版本)")):(r(),C("em",Le,"(最新版本"+m(i(d).version_no)+")",1))])]),e("div",Me,[e("div",De,[e("div",Re,[Ue,e("span",je,m(_.value.company_name||"--"),1)]),e("div",He,[e("span",Pe,[p("授权域名"),e("em",ze,m(_.value.site_address||"--"),1)]),e("span",Ne,[$e,e("em",qe,m(_.value.auth_code?v.value?_.value.auth_code:$(_.value.auth_code):"--"),1),v.value?(r(),f(j,{key:1,onClick:t[1]||(t[1]=c=>v.value=!v.value),class:"text-[12px] cursor-pointer"},{default:a(()=>[o(G)]),_:1})):(r(),f(j,{key:0,onClick:t[0]||(t[0]=c=>v.value=!v.value),class:"text-[12px] cursor-pointer"},{default:a(()=>[o(X)]),_:1}))])])]),e("div",Se,[o(u,{class:"w-[154px] !h-[48px] mt-[8px]",type:"primary",onClick:B},{default:a(()=>[p("授权码认证")]),_:1}),o(J,{ref_key:"getAuthCodeDialog",ref:A,placement:"bottom-start",width:478,trigger:"click",class:"mt-[8px]"},{reference:a(()=>[o(u,{class:"w-[154px] !h-[48px] mt-[8px] !text-[var(--el-color-primary)] hover:!text-[var(--el-color-primary)] !bg-transparent",plain:"",type:"primary"},{default:a(()=>[p("如何获取授权码?")]),_:1})]),default:a(()=>[e("div",Ke,[Xe,e("div",Ge,[o(u,{class:"w-[182px] !h-[48px]",plain:"",onClick:R},{default:a(()=>[p("去应用市场逛逛")]),_:1}),o(u,{class:"w-[100px] !h-[48px]",plain:"",onClick:t[2]||(t[2]=c=>A.value.hide())},{default:a(()=>[p("关闭")]),_:1})])])]),_:1},512)]),o(Q,{modelValue:h.value,"onUpdate:modelValue":t[6]||(t[6]=c=>h.value=c),title:"授权码认证",width:"400px"},{default:a(()=>[o(O,{model:g,"label-width":"0",ref_key:"formRef",ref:D,rules:q,class:"page-form"},{default:a(()=>[o(T,{class:"box-card !border-none",shadow:"never"},{default:a(()=>[o(P,{prop:"auth_code"},{default:a(()=>[o(H,{modelValue:g.auth_code,"onUpdate:modelValue":t[3]||(t[3]=c=>g.auth_code=c),modelModifiers:{trim:!0},placeholder:i(n)("authCodePlaceholder"),class:"input-width",clearable:"",size:"large"},null,8,["modelValue","placeholder"])]),_:1}),e("div",Je,[o(P,{prop:"auth_secret"},{default:a(()=>[o(H,{modelValue:g.auth_secret,"onUpdate:modelValue":t[4]||(t[4]=c=>g.auth_secret=c),modelModifiers:{trim:!0},clearable:"",placeholder:i(n)("authSecretPlaceholder"),class:"input-width",size:"large"},null,8,["modelValue","placeholder"])]),_:1})]),e("div",Oe,m(i(n)("authInfoTips")),1),e("div",Qe,[o(u,{type:"primary",class:"w-full",size:"large",loading:w.value,onClick:t[5]||(t[5]=c=>S(D.value))},{default:a(()=>[p(m(i(n)("confirm")),1)]),_:1},8,["loading"])]),e("div",We,[o(u,{type:"primary",link:"",onClick:R},{default:a(()=>[p(m(i(n)("notHaveAuth")),1)]),_:1})])]),_:1})]),_:1},8,["model","rules"])]),_:1},8,["modelValue"])])])]}),_:1})),b.value?E("",!0):(r(),f(T,{key:1,class:"box-card !border-none",shadow:"never"},{default:a(()=>[Ye,o(Y,null,{default:a(()=>[(r(!0),C(te,null,ae(V.value,(x,c)=>(r(),f(W,{timestamp:x.release_time+" 版本："+x.version_no,type:"primary",hollow:!0,placement:"top",key:c},{default:a(()=>[x.upgrade_log?(r(),C("div",Ze,[e("div",{innerHTML:x.upgrade_log},null,8,et)])):E("",!0)]),_:2},1032,["timestamp"]))),128))]),_:1})]),_:1})),o(ye,{ref_key:"upgradeRef",ref:I,onCloudbuild:U},null,512),o(we,{ref_key:"cloudBuildRef",ref:y},null,512)])}}});export{wt as default};
