import{d as e,O as t,r as a,p as r,a_ as l,a$ as s,b0 as c,l as n,j as u,o as x,c as o,w as p,X as i,b as f,y as d,f as g,n as m,u as h,z as b,V as _,ai as v,W as y,b1 as w,D as k,i as M,B as D,C,g as j,h as F,ah as Y,E as $,b2 as z,b3 as I,G as L,b4 as O,aG as V,_ as S}from"./index-06110d51.js";import{_ as W}from"./loading-page.vue_vue_type_script_setup_true_lang.29ba0e53.js";import{t as N}from"./topTabbar.88fd7aa2.js";const E=S(e({__name:"sign_in",setup(e){const S=t({dataCount:[],weekCount:[],curYear:0,curMonth:0,curDate:0,curWeek:0,signInList:[],packList:[]}),E=t({weekDay:0,week:0}),T=a(!1),A=a(!1),B=a({}),q=a(!1),R=a({}),G=a(!1),P=a(!1),J=a({}),X=a(!1);let H=null,K=null;r((()=>{let e=new Date;S.curYear=e.getFullYear(),S.curMonth=e.getMonth(),S.curDate=e.getDate(),S.curWeek=e.getDay(),0==S.curWeek&&(S.curWeek=7),H=l(S.curYear),K=l(S.curMonth),Z(),ee(),U({year:S.curYear,month:S.curMonth+1}),Q()}));const Q=()=>{T.value=!0,s().then((e=>{B.value=e.data,B.value.is_use||(fe=ie.setTopTabbarParam({title:"我的签到",topStatusBar:{textColor:"#303133",bgColor:"#fff"}})),T.value=!1}))},U=e=>{c(e).then((e=>{S.signInList=[],S.packList=[],S.packList=e.data.period,e.data.length&&(S.signInList=e.data.days.map((e=>Number(e)))),X.value=!0}))},Z=()=>{let e=new Date(S.curYear,S.curMonth+1,0).getDate(),t=new Date(S.curYear,S.curMonth,1).getDay();S.dataCount=[];for(let a=1;a<e+t;a++){let e=a-t+1;S.dataCount.push(e)}},ee=()=>{let e=`${S.curYear}-${S.curMonth+1>9?S.curMonth+1:"0"+(S.curMonth+1)}-${S.curDate>9?S.curDate:"0"+S.curDate}`;for(let t=S.curWeek-1;t>=0;t--){const a=new Date(e).getDate()-t;S.weekCount.push(a)}for(let t=1;t<=7-S.curWeek;t++){const a=new Date(e).getDate()+t;S.weekCount.push(a)}},te=()=>{let e=(new Date).getMonth();S.curMonth==e||(S.curMonth=(new Date).getMonth(),S.curYear=(new Date).getFullYear(),U({year:S.curYear,month:S.curMonth+1})),A.value=!A.value},ae=e=>{S.dataCount=[],"prev"==e?(S.curMonth--,S.curMonth<0&&(S.curMonth=11,S.curYear--),E.weekDay=1,X.value=!1):(S.curMonth++,S.curMonth>11&&(S.curMonth=0,S.curYear++),E.weekDay=1,X.value=!1);let t={year:S.curYear,month:S.curMonth+1};U(t),Z()},re=n(),le=()=>{w().then((e=>{if(Object.values(e.data).length){R.value=e.data;let t=0;Object.values(R.value.awards).forEach(((e,a)=>{e.content||t++})),t==Object.values(R.value.awards).length&&(R.value.info=""),U({year:S.curYear,month:S.curMonth+1}),Q(),re.getMemberInfo(),G.value=!0}}))},se=a(null),ce=e=>{let{curYear:t,curMonth:a}=z(S),r=`${t.value}-${a.value+1<10?"0"+(a.value+1):a.value+1}-${e<10?"0"+e:e}`;if(!S.packList.some((e=>e.day==r)))return;se.value=e;let l={year:S.curYear,month:S.curMonth+1,day:e};I(l).then((e=>{"[]"!=JSON.stringify(e.data)&&(J.value=e.data,P.value=!0)}))},ne=e=>S.signInList.includes(e),ue=e=>e>0&&e<=S.dataCount.length&&(e==S.curDate&&H==S.curYear&&K==S.curMonth||void 0),xe=e=>{let{curYear:t,curMonth:a}=z(S),r=`${t.value}-${a.value+1<10?"0"+(a.value+1):a.value+1}-${e<10?"0"+e:e}`;return S.packList.some((e=>e.day==r&&e.award))},oe=e=>e>0?e:"";let pe={};const ie=N();let fe=ie.setTopTabbarParam({title:"我的签到"});return u((()=>L(Number(pe.height)+pe.top+8)+382+"rpx;")),u((()=>L(Number(pe.height)+pe.top+8)+50+"rpx;")),(e,t)=>{const a=k,r=M,l=D,s=C,c=j(F("u-empty"),O),n=Y,u=j(F("u-popup"),V),w=j(F("loading-page"),W);return x(),o(r,{style:m(e.themeColor())},{default:p((()=>[Object.values(B.value).length?(x(),o(r,{key:0,class:i(["min-h-screen overflow-hidden",{"bg-[#F6F6F6]":B.value&&B.value.is_use}])},{default:p((()=>[B.value.is_use?(x(),o(r,{key:0},{default:p((()=>[f(r,{class:"sigin-header"},{default:p((()=>[B.value.rule_explain?(x(),o(r,{key:0,class:"side-tab",onClick:t[0]||(t[0]=e=>q.value=!0)},{default:p((()=>[f(a,{class:"nc-iconfont nc-icon-a-meiriqiandaoV6xx-36 icon"}),f(a,{class:"desc"},{default:p((()=>[d("签到规则")])),_:1})])),_:1})):g("v-if",!0),f(r,{class:"h-[382rpx]",style:m({backgroundImage:"url("+h($)("static/resource/images/app/sigin_h5.png")+")",backgroundSize:"100%",backgroundRepeat:"no-repeat"})},null,8,["style"])])),_:1}),f(r,null,{default:p((()=>[f(r,{class:"sidebar-margin bg-[#fff] rounded-[16rpx] -mt-[85rpx]"},{default:p((()=>[f(r,{class:"card-template"},{default:p((()=>[A.value?(x(),o(r,{key:0,class:"mb-[30rpx] flex justify-between items-center"},{default:p((()=>[f(r,{class:"flex items-center"},{default:p((()=>[f(a,{class:"iconfont iconshangyibu text-[#303133] text-[20rpx]",onClick:t[1]||(t[1]=e=>ae("prev"))}),f(r,{class:"mx-[24rpx] text-[30rpx] font-500 text-[#303133] leading-[45rpx]"},{default:p((()=>[d(b(S.curYear)+"年"+b(S.curMonth+1)+"月",1)])),_:1}),f(a,{class:"iconfont iconxiayibu1 text-[#303133] text-[20rpx]",onClick:t[2]||(t[2]=e=>ae("next"))})])),_:1}),f(r,{class:"flex items-center"},{default:p((()=>[f(a,{class:"nc-iconfont nc-icon-shangV6xx-1 text-[var(--text-color-light9)] pt-[4rpx] px-[6rpx] text-[24rpx]",onClick:te})])),_:1})])),_:1})):(x(),o(r,{key:1,class:"mb-[30rpx] flex justify-between items-center"},{default:p((()=>[f(r,{class:"font-500 text-[30rpx]"},{default:p((()=>[d("已连续签到"),f(a,{class:"text-[#EF000C] mx-[4rpx]"},{default:p((()=>[d(b(B.value.days),1)])),_:1}),d("天")])),_:1}),A.value?g("v-if",!0):(x(),o(a,{key:0,class:"nc-iconfont nc-icon-xiaV6xx pt-[4rpx] px-[6rpx] text-[var(--text-color-light9)] text-[24rpx]",onClick:t[3]||(t[3]=e=>A.value=!A.value)}))])),_:1})),f(r,{class:"relative z-9 bg-[#fff] rounded-[18rpx]"},{default:p((()=>[f(r,null,{default:p((()=>[f(r,{class:"flex items-center justify-between text-[var(--text-color-light9)] text-[24rpx] mb-[16rpx]"},{default:p((()=>[f(a,{class:"w-[14.28%] leading-[36rpx] text-center"},{default:p((()=>[d("周一")])),_:1}),f(a,{class:"w-[14.28%] leading-[36rpx] text-center"},{default:p((()=>[d("周二")])),_:1}),f(a,{class:"w-[14.28%] leading-[36rpx] text-center"},{default:p((()=>[d("周三")])),_:1}),f(a,{class:"w-[14.28%] leading-[36rpx] text-center"},{default:p((()=>[d("周四")])),_:1}),f(a,{class:"w-[14.28%] leading-[36rpx] text-center"},{default:p((()=>[d("周五")])),_:1}),f(a,{class:"w-[14.28%] leading-[36rpx] text-center"},{default:p((()=>[d("周六")])),_:1}),f(a,{class:"w-[14.28%] leading-[36rpx] text-center"},{default:p((()=>[d("周日")])),_:1})])),_:1}),A.value?(x(),o(r,{key:1,class:"flex flex-wrap items-center justify-start"},{default:p((()=>[(x(!0),_(y,null,v(S.dataCount,((e,t)=>(x(),o(r,{class:"w-[14.28%] flex flex-col justify-center items-center mb-[30rpx]"},{default:p((()=>[oe(e)?(x(),o(r,{key:0,class:i(["w-[74rpx] h-[92rpx] bg-[#F6FAFF] text-[var(--text-color-light6)] box-border py-[10rpx] rounded-[8rpx] flex flex-col items-center",{"sigin-bg !text-[#fff]":ne(e)&&X.value,"!bg-[#FDFDFD] border-[1rpx] border-[#F0F4FA] border-solid":!ne(e)&&e<S.curDate&&S.curMonth+1==(new Date).getMonth()+1&&S.curYear==(new Date).getFullYear(),"mb-[20rpx]":ue(e),"mb-[30rpx]":!ue(e)}]),onClick:t=>ce(e)},{default:p((()=>[f(a,{class:"text-[24rpx] leading-[28rpx] mb-[6rpx]"},{default:p((()=>[d(b(oe(e)),1)])),_:2},1024),oe(e)?(x(),o(r,{key:0,class:"flex items-center justufy-center"},{default:p((()=>[xe(e)?(x(),o(l,{key:0,src:h($)("static/resource/images/app/package.png"),class:"w-[40rpx] h-[40rpx]"},null,8,["src"])):ne(e)&&X.value?(x(),o(l,{key:1,src:h($)("static/resource/images/app/hassigin.png"),class:"w-[34rpx] h-[34rpx]"},null,8,["src"])):(x(),_(y,{key:2},[!ne(e)&&e<S.curDate&&S.curMonth+1==(new Date).getMonth()+1?(x(),o(l,{key:0,src:h($)("static/resource/images/app/nosigin.png"),class:"w-[34rpx] h-[34rpx]"},null,8,["src"])):(x(),o(l,{key:1,src:h($)("static/resource/images/app/nosigin1.png"),class:"w-[34rpx] h-[34rpx]"},null,8,["src"]))],64))])),_:2},1024)):g("v-if",!0)])),_:2},1032,["class","onClick"])):g("v-if",!0),ue(e)?(x(),o(r,{key:1,class:"w-[10rpx] h-[10rpx] rounded-[50%] bg-[#FF5527]"})):g("v-if",!0)])),_:2},1024)))),256))])),_:1})):(x(),o(r,{key:0,class:"flex flex-wrap items-center justify-start"},{default:p((()=>[(x(!0),_(y,null,v(S.weekCount,((e,t)=>(x(),o(r,{key:t,class:"w-[14.28%] flex flex-col justify-center items-center"},{default:p((()=>[oe(e)?(x(),o(r,{key:0,class:i(["w-[74rpx] h-[92rpx] bg-[#f4f4f4] text-[var(--text-color-light6)] box-border py-[10rpx] rounded-[8rpx] flex flex-col items-center",{"sigin-bg !text-[#fff]":ne(e),"!bg-[#f9f9f9] border-[1rpx] !text-[var(--text-color-light9)] border-[#f5f5f5] border-solid":!ne(e)&&e<S.curDate&&S.curMonth+1==(new Date).getMonth()+1,"mb-[20rpx]":ue(e),"mb-[30rpx]":!ue(e)}]),onClick:t=>ce(e)},{default:p((()=>[f(a,{class:"text-[24rpx] leading-[28rpx] mb-[6rpx]"},{default:p((()=>[d(b(oe(e)),1)])),_:2},1024),oe(e)?(x(),o(r,{key:0,class:"flex items-center justufy-center"},{default:p((()=>[xe(e)?(x(),o(l,{key:0,src:h($)("static/resource/images/app/package.png"),class:"w-[40rpx] h-[40rpx]"},null,8,["src"])):ne(e)?(x(),o(l,{key:1,src:h($)("static/resource/images/app/hassigin.png"),class:"w-[34rpx] h-[34rpx]"},null,8,["src"])):(x(),_(y,{key:2},[!ne(e)&&e<S.curDate&&S.curMonth+1==(new Date).getMonth()+1?(x(),o(l,{key:0,src:h($)("static/resource/images/app/nosigin.png"),class:"w-[34rpx] h-[34rpx]"},null,8,["src"])):(x(),o(l,{key:1,src:h($)("static/resource/images/app/nosigin1.png"),class:"w-[34rpx] h-[34rpx]"},null,8,["src"]))],64))])),_:2},1024)):g("v-if",!0)])),_:2},1032,["class","onClick"])):g("v-if",!0),ue(e)?(x(),o(r,{key:1,class:"w-[10rpx] h-[10rpx] rounded-[50%] bg-[#FF5527]"})):g("v-if",!0)])),_:2},1024)))),128))])),_:1})),S.curMonth+1==(new Date).getMonth()+1&&S.curYear==(new Date).getFullYear()?(x(),o(r,{key:2,class:"mt-[40rpx] flex justify-center"},{default:p((()=>[B.value.is_sign?(x(),o(s,{key:1,class:"rounded-[40rpx] flex-center !bg-transparent text-[26rpx] font-500",style:m({width:"490rpx",height:"80rpx",border:"none",color:"#fff",backgroundImage:`url(${h($)("static/resource/images/app/button_bg1.png")})`,backgroundSize:"100%",backgroundRepeat:"no-repeat"}),shape:"circle"},{default:p((()=>[f(a,{class:"nc-iconfont nc-icon-a-meiriqiandaoV6xx-36 text-[26rpx] text-[#fff] mr-[8rpx]"}),f(a,null,{default:p((()=>[d("已签到")])),_:1})])),_:1},8,["style"])):(x(),o(s,{key:0,class:"rounded-[40rpx] flex-center !bg-transparent text-[26rpx] font-500",style:m({width:"490rpx",height:"80rpx",border:"none",color:"#fff",backgroundImage:`url(${h($)("static/resource/images/app/button_bg2.png")})`,backgroundSize:"100%",backgroundRepeat:"no-repeat"}),shape:"circle",onClick:le},{default:p((()=>[f(a,{class:"nc-iconfont nc-icon-a-meiriqiandaoV6xx-36 text-[26rpx] text-[#fff] mr-[8rpx]"}),f(a,null,{default:p((()=>[d("立即签到")])),_:1})])),_:1},8,["style"]))])),_:1})):g("v-if",!0)])),_:1})])),_:1})])),_:1})])),_:1}),B.value&&B.value.continue_award&&Object.keys(B.value.continue_award).length?(x(),o(r,{key:0,class:"mt-[20rpx] mb-[30rpx] sidebar-margin card-template"},{default:p((()=>[f(r,{class:"mb-[30rpx] flex items-center"},{default:p((()=>[f(r,{class:"font-500 text-[30rpx] text-[#303133]"},{default:p((()=>[d("签到奖励")])),_:1}),g(' <view class="text-[var(--text-color-light6)] text-[26rpx] leading-[30rpx]">\r\n                                <text>签到记录</text>\r\n                                <image :src="img(\'static/resource/images/app/more.png\')" class="w-[12rpx] h-[18rpx] ml-[8rpx]"></image>\r\n                            </view> ')])),_:1}),f(r,null,{default:p((()=>[(x(!0),_(y,null,v(B.value.continue_award,((e,t)=>(x(),o(r,{key:t,class:i(["flex items-center border-box",{"mt-[40rpx]":t}])},{default:p((()=>[(t+1)%4==1?(x(),o(r,{key:0,class:"w-[90rpx] h-[90rpx] rounded-[50%] bg-[#E7F6FF] flex items-center justify-center flex-shrink-0"},{default:p((()=>[f(l,{src:h($)("static/resource/images/app/icon_02.png"),class:"w-[40rpx] h-[40rpx]"},null,8,["src"])])),_:1})):(t+1)%4==2?(x(),o(r,{key:1,class:"w-[90rpx] h-[90rpx] rounded-[50%] bg-[#ffefef] flex items-center justify-center flex-shrink-0"},{default:p((()=>[f(l,{src:h($)("static/resource/images/app/icon_03.png"),class:"w-[40rpx] h-[40rpx]"},null,8,["src"])])),_:1})):(t+1)%4==3?(x(),o(r,{key:2,class:"w-[90rpx] h-[90rpx] rounded-[50%] bg-[#d3feeb] flex items-center justify-center flex-shrink-0"},{default:p((()=>[f(l,{src:h($)("static/resource/images/app/icon_04.png"),class:"w-[40rpx] h-[40rpx]"},null,8,["src"])])),_:1})):(t+1)%4==0?(x(),o(r,{key:3,class:"w-[90rpx] h-[90rpx] rounded-[50%] bg-[#ffeddd] flex items-center justify-center flex-shrink-0"},{default:p((()=>[f(l,{src:h($)("static/resource/images/app/icon_05.png"),class:"w-[40rpx] h-[40rpx]"},null,8,["src"])])),_:1})):g("v-if",!0),f(r,{class:"flex-1 mx-[20rpx]"},{default:p((()=>[f(r,{class:"font-400 text-[28rpx] text-[#303133] leading-[38rpx] mb-[10rpx]"},{default:p((()=>[d("连续签到"+b(e.continue_sign)+"天",1)])),_:2},1024),e.gift?(x(),o(r,{key:0,class:"flex flex-wrap"},{default:p((()=>[f(r,{class:"flex"},{default:p((()=>[f(l,{src:h($)(e.gift.total.icon),class:"w-[30rpx] h-[30rpx] flex-shrink-0"},null,8,["src"]),f(r,{class:"text-[24rpx] ml-[8rpx] text-[#FF9000] leading-[34rpx] max-w-[330rpx]"},{default:p((()=>[d(b(e.gift.total.text),1)])),_:2},1024)])),_:2},1024)])),_:2},1024)):g("v-if",!0)])),_:2},1024),f(r,{class:"flex-shrink-0"},{default:p((()=>[Number(B.value.days)<Number(e.continue_sign)?(x(),o(r,{key:0,class:"w-[130rpx] h-[54rpx] text-center bg-primary-light rounded-[28rpx] text-[22rpx] text-[var(--primary-color)] flex-center font-500"},{default:p((()=>[d("待完成")])),_:1})):(x(),o(r,{key:1,class:"primary-btn-bg w-[130rpx] h-[54rpx] text-center rounded-[27rpx] text-[22rpx] text-[#fff] flex-center font-500"},{default:p((()=>[d("已完成")])),_:1}))])),_:2},1024)])),_:2},1032,["class"])))),128))])),_:1})])),_:1})):g("v-if",!0)])),_:1})])),_:1})):(x(),o(r,{key:1,class:"h-[100vh] w-[100vw] flex justify-center items-center"},{default:p((()=>[f(c,{text:"签到未开启",width:"347rpx",height:"265rpx",icon:h($)("static/resource/images/system/empty.png")},null,8,["icon"])])),_:1})),g(" 签到规则"),f(u,{show:q.value,round:16,mode:"bottom",onClose:t[5]||(t[5]=e=>q.value=!1)},{default:p((()=>[f(r,{class:"popup-common"},{default:p((()=>[f(r,{class:"title"},{default:p((()=>[d("签到规则")])),_:1}),f(n,{"scroll-y":!0,class:"px-[30rpx] box-border h-[360rpx] overflow-auto"},{default:p((()=>[(x(!0),_(y,null,v(B.value.rule_explain.split("\n"),(e=>(x(),o(r,{class:"text-[28rpx] leading-[40rpx] mb-[20rpx]"},{default:p((()=>[d(b(e),1)])),_:2},1024)))),256))])),_:1}),f(r,{class:"btn-wrap"},{default:p((()=>[f(s,{class:"primary-btn-bg btn",onClick:t[4]||(t[4]=e=>q.value=!1)},{default:p((()=>[d("知道了")])),_:1})])),_:1})])),_:1})])),_:1},8,["show"]),g(" 签到奖励 "),f(u,{show:G.value,class:"award-popup overflow-hidden",customStyle:{backgroundColor:"transparent"},onClose:t[8]||(t[8]=e=>G.value=!1),mode:"center",round:"var(--rounded-big)",safeAreaInsetBottom:!1},{default:p((()=>[Object.values(R.value).length?(x(),o(r,{key:0,class:"w-[550rpx] -mt-[124rpx]"},{default:p((()=>[f(r,{class:"flex justify-center"},{default:p((()=>[f(l,{src:h($)("static/resource/images/app/award.png"),class:"w-[484rpx] h-[480rpx] z-10",mode:"aspectFill"},null,8,["src"])])),_:1}),f(r,{class:"-mt-[265rpx] bg-award rounded-[40rpx] pt-[100rpx] pb-[50rpx] mb-[50rpx] relative"},{default:p((()=>[f(r,{class:"px-[32rpx]"},{default:p((()=>[f(r,{class:"text-[36rpx] text-[#EF000C] font-500 mb-[10rpx] text-center"},{default:p((()=>[d(b(R.value.title),1)])),_:1}),R.value.info?(x(),o(r,{key:0,class:"text-[24rpx] text-[#333] leading-[34rpx] text-center mb-[60rpx]"},{default:p((()=>[d(b(R.value.info),1)])),_:1})):g("v-if",!0),f(r,{class:"px-[68rpx] mb-[100rpx]"},{default:p((()=>[(x(!0),_(y,null,v(R.value.awards,((e,t)=>(x(),_(y,null,[e.content?(x(!0),_(y,{key:0},v(e.content,((e,t)=>(x(),o(r,{class:"flex items-center mb-[30rpx]"},{default:p((()=>[f(l,{src:h($)(e.icon),class:"w-[42rpx] h-[42rpx]"},null,8,["src"]),f(r,{class:"ml-[20rpx] text-[28rpx] text-[#303133] leading-[38rpx]"},{default:p((()=>[d(b(e.text),1)])),_:2},1024)])),_:2},1024)))),256)):g("v-if",!0)],64)))),256))])),_:1}),f(r,{class:"flex justify-center relative z-30"},{default:p((()=>[f(r,{class:"w-[370rpx] h-[80rpx] primary-btn-bg font-500 rounded-[100rpx] text-[#ffffff] text-center leading-[80rpx] text-[26rpx]",onClick:t[6]||(t[6]=e=>G.value=!1)},{default:p((()=>[d("我知道了")])),_:1})])),_:1})])),_:1})])),_:1}),f(r,{class:"flex justify-center"},{default:p((()=>[f(a,{class:"nc-iconfont nc-icon-cuohaoV6xx1 text-[#fff] text-[50rpx]",onClick:t[7]||(t[7]=e=>G.value=!1)})])),_:1})])),_:1})):g("v-if",!0)])),_:1},8,["show"]),g(" 查看当日或连续签到奖励 "),f(u,{show:P.value,class:"award-popup overflow-hidden",customStyle:{backgroundColor:"transparent"},onClose:t[11]||(t[11]=e=>P.value=!1),mode:"center",round:"var(--rounded-big)",safeAreaInsetBottom:!1},{default:p((()=>[Object.values(J.value).length?(x(),o(r,{key:0,class:"w-[550rpx] -mt-[124rpx]"},{default:p((()=>[f(r,{class:"flex justify-center"},{default:p((()=>[f(l,{src:h($)("static/resource/images/app/award.png"),class:"w-[484rpx] h-[480rpx] z-10",mode:"aspectFill"},null,8,["src"])])),_:1}),f(r,{class:"-mt-[265rpx] bg-award rounded-[40rpx] pt-[100rpx] pb-[50rpx] mb-[50rpx] relative"},{default:p((()=>[f(r,{class:"px-[32rpx]"},{default:p((()=>[f(r,{class:"text-[36rpx] text-[#303133] font-500 mb-[10rpx] text-center relative z-20"},{default:p((()=>[d(b(J.value.title),1)])),_:1}),f(r,{class:"text-[24rpx] text-[#333] leading-[34rpx] text-center mb-[60rpx]"},{default:p((()=>[d(b(J.value.info),1)])),_:1}),f(r,{class:"px-[68rpx] mb-[100rpx]"},{default:p((()=>[(x(!0),_(y,null,v(J.value.awards,((e,t)=>(x(),_(y,null,[e.content?(x(!0),_(y,{key:0},v(e.content,((e,t)=>(x(),o(r,{class:"flex items-center mb-[32rpx]",key:t},{default:p((()=>[f(l,{src:h($)(e.icon),class:"w-[42rpx] h-[42rpx]"},null,8,["src"]),f(r,{class:"ml-[20rpx] text-[28rpx] text-[#303133] leading-[38rpx]"},{default:p((()=>[d(b(e.text),1)])),_:2},1024)])),_:2},1024)))),128)):g("v-if",!0)],64)))),256))])),_:1}),f(r,{class:"flex justify-center relative z-30"},{default:p((()=>[f(r,{class:"w-[370rpx] h-[80rpx] border-[2rpx] text-[var(--primary-color)] border-solid rounded-[40rpx] border-[var(--primary-color)] text-center flex-center text-[26rpx] box-border",onClick:t[9]||(t[9]=e=>P.value=!1)},{default:p((()=>[d("我知道了")])),_:1})])),_:1})])),_:1})])),_:1}),f(r,{class:"flex justify-center"},{default:p((()=>[f(a,{class:"nc-iconfont nc-icon-cuohaoV6xx1 text-[#fff] text-[50rpx]",onClick:t[10]||(t[10]=e=>P.value=!1)})])),_:1})])),_:1})):g("v-if",!0)])),_:1},8,["show"])])),_:1},8,["class"])):g("v-if",!0),f(w,{loading:T.value},null,8,["loading"])])),_:1},8,["style"])}}}),[["__scopeId","data-v-e1772e54"]]);export{E as default};