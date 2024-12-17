import{r as ie,a as Q,b as ne,c as re}from"./index-5f2f1071.js";import{P as le,r as a,n as oe,l as se,Q as ce,aK as de,h as W,c as I,$ as c,a as r,R as ue,a0 as ve,e as he,w as fe,v as Z,t as j,B as J,aZ as ge,a_ as me,a$ as ye}from"./index-a7efb343.js";import{_ as pe}from"./_plugin-vue_export-helper-c27b6911.js";const we={name:"VerifySlide",props:{captchaType:{type:String},type:{type:String,default:"1"},mode:{type:String,default:"fixed"},vSpace:{type:Number,default:5},explain:{type:String,default:"向右滑动完成验证"},imgSize:{type:Object,default(){return{width:"310px",height:"155px"}}},blockSize:{type:Object,default(){return{width:"50px",height:"50px"}}},barSize:{type:Object,default(){return{width:"310px",height:"40px"}}}},setup(X,s){const{mode:n,captchaType:e,vSpace:U,imgSize:Y,barSize:d,type:D,blockSize:T,explain:q}=le(X),{proxy:l}=me(),u=a(""),E=a(""),F=a(""),K=a(""),g=a(""),H=a(""),_=a(""),$=a(""),v=a(""),x=a(""),P=a(""),h=oe({imgHeight:0,imgWidth:0,barHeight:0,barWidth:0}),ee=a(0),te=a(0),k=a(void 0),L=a(void 0),m=a(void 0),y=a("#ddd"),p=a(void 0),B=a("icon-right"),w=a(!1),f=a(!1),N=a(!0),O=a(""),M=a(""),R=a(0),S=se(()=>l.$el.querySelector(".verify-bar-area"));function A(){x.value=q.value,G(),ye(()=>{let{imgHeight:t,imgWidth:i,barHeight:b,barWidth:o}=ie(l);h.imgHeight=t,h.imgWidth=i,h.barHeight=b,h.barWidth=o,l.$parent.$emit("ready",l)}),window.removeEventListener("touchmove",function(t){z(t)}),window.removeEventListener("mousemove",function(t){z(t)}),window.removeEventListener("touchend",function(){C()}),window.removeEventListener("mouseup",function(){C()}),window.addEventListener("touchmove",function(t){z(t)}),window.addEventListener("mousemove",function(t){z(t)}),window.addEventListener("touchend",function(){C()}),window.addEventListener("mouseup",function(){C()})}ce(D,()=>{A()}),de(()=>{A(),l.$el.onselectstart=function(){return!1}});function ae(t){if(t=t||window.event,t.touches)var i=t.touches[0].pageX;else var i=t.clientX;R.value=Math.floor(i-S.value.getBoundingClientRect().left),H.value=+new Date,f.value==!1&&(x.value="",m.value="#337ab7",y.value="#337AB7",p.value="#fff",t.stopPropagation(),w.value=!0)}function z(t){if(t=t||window.event,w.value&&f.value==!1){if(t.touches)var i=t.touches[0].pageX;else var i=t.clientX;var b=S.value.getBoundingClientRect().left,o=i-b;o>=S.value.offsetWidth-parseInt(parseInt(T.value.width)/2)-2&&(o=S.value.offsetWidth-parseInt(parseInt(T.value.width)/2)-2),o<=0&&(o=parseInt(parseInt(T.value.width)/2)),k.value=o-R.value+"px",L.value=o-R.value+"px"}}function C(){if(_.value=+new Date,w.value&&f.value==!1){var t=parseInt((k.value||"").replace("px",""));t=t*310/parseInt(h.imgWidth);const i={captchaType:e.value,captcha_code:u.value?Q(JSON.stringify({x:t,y:5}),u.value):JSON.stringify({x:t,y:5}),captcha_key:g.value};ne(i).then(b=>{if(b.code==1){m.value="#5cb85c",y.value="#5cb85c",p.value="#fff",B.value="icon-check",N.value=!1,f.value=!0,n.value=="pop"&&setTimeout(()=>{l.$parent.clickShow=!1,V()},1500),E.value=!0,v.value=`${((_.value-H.value)/1e3).toFixed(2)}s验证成功`;var o=u.value?Q(g.value+"---"+JSON.stringify({x:t,y:5}),u.value):g.value+"---"+JSON.stringify({x:t,y:5});setTimeout(()=>{v.value="",l.$parent.closeBox(),l.$parent.$emit("success",{captchaVerification:o})},1e3)}else m.value="#d9534f",y.value="#d9534f",p.value="#fff",B.value="icon-close",E.value=!1,setTimeout(function(){V()},1e3),l.$parent.$emit("error",l),v.value="验证失败",setTimeout(()=>{v.value=""},1e3)}),w.value=!1}}const V=()=>{N.value=!0,P.value="",O.value="left .3s",k.value=0,L.value=void 0,M.value="width .3s",y.value="#ddd",m.value="#fff",p.value="#000",B.value="icon-right",f.value=!1,G(),setTimeout(()=>{M.value="",O.value="",x.value=q.value},300)};function G(){const t={captchaType:e.value};re(t).then(i=>{i.code==1?(F.value=i.data.originalImageBase64,K.value=i.data.jigsawImageBase64,g.value=i.data.token,u.value=i.data.secretKey):v.value=i.msg})}return{secretKey:u,passFlag:E,backImgBase:F,blockBackImgBase:K,backToken:g,startMoveTime:H,endMoveTime:_,tipsBackColor:$,tipWords:v,text:x,finishText:P,setSize:h,top:ee,left:te,moveBlockLeft:k,leftBarWidth:L,moveBlockBackgroundColor:m,leftBarBorderColor:y,iconColor:p,iconClass:B,status:w,isEnd:f,showRefresh:N,transitionLeft:O,transitionWidth:M,barArea:S,refresh:V,start:ae}}},Se={style:{position:"relative"}},be=["src"],xe=r("i",{class:"iconfont icon-refresh"},null,-1),ke=[xe],Be=["textContent"],ze=["textContent"],Ce=["src"];function We(X,s,n,e,U,Y){return W(),I("div",Se,[n.type==="2"?(W(),I("div",{key:0,class:"verify-img-out",style:c({height:parseInt(e.setSize.imgHeight)+n.vSpace+"px"})},[r("div",{class:"verify-img-panel",style:c({width:e.setSize.imgWidth,height:e.setSize.imgHeight})},[r("img",{src:"data:image/png;base64,"+e.backImgBase,alt:"",style:{width:"100%",height:"100%",display:"block"}},null,8,be),ue(r("div",{class:"verify-refresh",onClick:s[0]||(s[0]=(...d)=>e.refresh&&e.refresh(...d))},ke,512),[[ve,e.showRefresh]]),he(ge,{name:"tips"},{default:fe(()=>[e.tipWords?(W(),I("span",{key:0,class:Z(["verify-tips",e.passFlag?"suc-bg":"err-bg"])},j(e.tipWords),3)):J("",!0)]),_:1})],4)],4)):J("",!0),r("div",{class:"verify-bar-area",style:c({width:e.setSize.imgWidth,height:n.barSize.height,"line-height":n.barSize.height})},[r("span",{class:"verify-msg",textContent:j(e.text)},null,8,Be),r("div",{class:"verify-left-bar",style:c({width:e.leftBarWidth!==void 0?e.leftBarWidth:n.barSize.height,height:n.barSize.height,"border-color":e.leftBarBorderColor,transaction:e.transitionWidth})},[r("span",{class:"verify-msg",textContent:j(e.finishText)},null,8,ze),r("div",{class:"verify-move-block",onTouchstart:s[1]||(s[1]=(...d)=>e.start&&e.start(...d)),onMousedown:s[2]||(s[2]=(...d)=>e.start&&e.start(...d)),style:c({width:n.barSize.height,height:n.barSize.height,"background-color":e.moveBlockBackgroundColor,left:e.moveBlockLeft,transition:e.transitionLeft})},[r("i",{class:Z(["verify-icon iconfont",e.iconClass]),style:c({color:e.iconColor})},null,6),n.type==="2"?(W(),I("div",{key:0,class:"verify-sub-block",style:c({width:Math.floor(parseInt(e.setSize.imgWidth)*47/310)+"px",height:e.setSize.imgHeight,top:"-"+(parseInt(e.setSize.imgHeight)+n.vSpace)+"px","background-size":e.setSize.imgWidth+" "+e.setSize.imgHeight})},[r("img",{src:"data:image/png;base64,"+e.blockBackImgBase,alt:"",style:{width:"100%",height:"100%",display:"block","-webkit-user-drag":"none"}},null,8,Ce)],4)):J("",!0)],36)],4)],4)])}const He=pe(we,[["render",We]]);export{He as default};
