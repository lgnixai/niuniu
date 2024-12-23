import{m as t,p as e,q as l,bG as a,aX as o,d as s,bs as n,bk as i,j as r,r as c,$ as d,U as u,u as p,o as y,c as f,w as m,b as g,n as x,X as _,f as v,y as k,z as h,A as S,a as b,a0 as C,at as w,bq as B,i as I,B as A,D as T,E as V,br as z,_ as q}from"./index-06110d51.js";import{m as j}from"./manifest.c5d7e573.js";function F(s){const n=t();let i=s;1!=n.mapConfig.is_open&&(i=!1);const r=()=>{if(!i)return!1;uni.getStorageSync("manually_select_location_from_map")||l()&&n.mapConfig.is_open&&!uni.getStorageSync("location_address")&&a.init((()=>{a.getLocation((t=>{let e=t.latitude+","+t.longitude;c(e)}))}))},c=(t="")=>{if(!i)return!1;let e={latlng:""};e.latlng=t||n.diyAddressInfo.latitude+","+n.diyAddressInfo.longitude,o(e).then((t=>{if(t.data&&Object.keys(t.data).length){let l={},a=e.latlng.split(",");l.latitude=a[0],l.longitude=a[1],l.full_address=null!=t.data.province?t.data.province:"",l.full_address+=null!=t.data.city?t.data.city:"",l.full_address+=null!=t.data.district?t.data.district:"",l.full_address+=null!=t.data.community?t.data.community:"",l.province_id=t.data.province_id,l.province=t.data.province,l.city_id=t.data.city_id,l.city=t.data.city,l.district_id=t.data.district_id,l.district=t.data.district,l.community=t.data.community,l.formatted_addresses=t.data.formatted_addresses,n.setAddressInfo(l)}else n.setAddressInfo();setTimeout((()=>{uni.removeStorageSync("manually_select_location_from_map")}),500)}))},d=()=>{let t=uni.getStorageSync("location_address");if(t){var e=new Date;n.mapConfig.valid_time>0?t.is_expired=e.getTime()/1e3>t.valid_time:t.is_expired=!1}else t={is_expired:!1};return t};return{init:r,onLoad:(t="")=>{e((e=>{e&&e.latng&&c(e.latng),uni.removeStorageSync("manually_select_location_from_map"),"function"==typeof t&&t(e)}))},refresh:()=>{if(!i)return!1;!uni.getStorageSync("manually_select_location_from_map")&&uni.getStorageSync("location_address")&&(d()&&!d().is_expired?n.setAddressInfo(uni.getStorageSync("location_address")):uni.removeStorageSync("location_address")),!uni.getStorageSync("manually_select_location_from_map")&&d()&&d().is_expired&&r()},reposition:()=>{if(!i)return!1;n.diyAddressInfo&&n.diyAddressInfo.latitude,n.diyAddressInfo&&n.diyAddressInfo.longitude,uni.setStorageSync("manually_select_location_from_map",!0);let t=location.origin+location.pathname;window.location.href="https://apis.map.qq.com/tools/locpicker?search=1&type=0&backurl="+encodeURIComponent(t)+"&key="+j.h5.sdkConfigs.maps.qqmap.key+"&referer=myapp"}}}const R=q(s({__name:"top-tabbar",props:{data:{type:Object,default:{}},titleColor:{type:String,default:"#606266"},customBack:{type:Function,default:null},scrollBool:{type:[String,Number],default:-1},isBack:{type:Boolean,default:!0},isFill:{type:Boolean,default:!0}},setup(e,{expose:l}){const a=e;n().platform;const o=t(),s=i(),q=r((()=>a.data)),j=r((()=>{if(a.data&&a.data.topStatusBar)return a.data.topStatusBar})),R=r((()=>{let t="";return a.isBack&&D.value?(t+="padding-left: 30rpx;","style-1"==j.value.style&&(t+="padding-right:80rpx;")):("style-1"==j.value.style&&(t+="padding-right: 30rpx;"),t+="padding-left: 30rpx;"),t})),$=r((()=>{let t="";return t+="font-size: 28rpx;",t+=`color: ${G.value};`,"style-1"==j.value.style&&(t+=`text-align: ${j.value.textAlign};`),t})),G=r((()=>{let t="";return t=1==a.scrollBool?j.value.rollTextColor:j.value.textColor,t})),U=r((()=>{let t="";return t=1==a.scrollBool?j.value.rollBgColor:j.value.bgColor,t}));let L=uni.getStorageSync("componentsScrollValGroup");if(L)L.TopTabbar=0,uni.setStorageSync("componentsScrollValGroup",L);else{let t={TopTabbar:0};uni.setStorageSync("componentsScrollValGroup",t)}const D=c(!1);let H=d();const O=()=>{1==H.length&&"app/pages/auth/index"==H[0].route?uni.getStorage({key:"loginBack",success:t=>{b(t?{...t.data,mode:"redirectTo"}:{url:"/app/pages/index/index",mode:"switchTab"})},fail:t=>{b({url:"/app/pages/index/index",mode:"switchTab"})}}):"function"==typeof a.customBack?a.customBack():C()},P=r((()=>`calc(100vw - ${o.menuButtonInfo.right}px + ${o.menuButtonInfo.width}px + 10px)`)),X=c(0),E=z();let N=!1;j.value&&"style-4"==j.value.style&&(N=!0);const J=F(N);J.onLoad(),J.init(),u((()=>{w((()=>{B().in(E).select(".ns-navbar-wrap .u-navbar .content-wrap").boundingClientRect((t=>{X.value=t?t.height:0,s.topTabarHeight=X.value})).exec()})),(H.length>1||1==H.length&&"app/pages/auth/index"==H[0].route)&&(D.value=!0),J.refresh()}));return l({refresh:()=>{J.refresh()}}),(t,l)=>{const n=I,i=A,r=T;return"decorate"!=p(s).mode&&p(j)?(y(),f(n,{key:0,class:_(["ns-navbar-wrap",p(j).style])},{default:m((()=>[g(n,{class:_(["u-navbar",{fixed:-1!=a.scrollBool,absolute:-1==a.scrollBool}]),style:x({backgroundColor:p(U)})},{default:m((()=>[g(n,{class:"navbar-inner",style:x({width:"100%",height:X.value+"px"})},{default:m((()=>["style-1"==p(j).style?(y(),f(n,{key:0,class:_(["content-wrap",[p(j).textAlign]]),style:x(p(R))},{default:m((()=>[e.isBack&&D.value?(y(),f(n,{key:0,class:"back-wrap -ml-[16rpx] text-[27px] nc-iconfont nc-icon-zuoV6xx",style:x({color:p(G)}),onClick:O},null,8,["style"])):v("v-if",!0),g(n,{class:"title-wrap",style:x(p($))},{default:m((()=>[k(h(p(q).title),1)])),_:1},8,["style"])])),_:1},8,["class","style"])):v("v-if",!0),"style-2"==p(j).style?(y(),f(n,{key:1,class:"content-wrap",style:x(p(R)),onClick:l[0]||(l[0]=t=>p(s).toRedirect(p(j).link))},{default:m((()=>[e.isBack&&D.value?(y(),f(n,{key:0,class:"back-wrap -ml-[16rpx] text-[27px] nc-iconfont nc-icon-zuoV6xx",style:x({color:p(G)}),onClick:O},null,8,["style"])):v("v-if",!0),g(n,{class:"title-wrap",style:x({color:p(j).textColor})},{default:m((()=>[g(n,null,{default:m((()=>[g(i,{src:p(V)(p(j).imgUrl),mode:"heightFix"},null,8,["src"])])),_:1}),g(n,{style:x({color:p(j).textColor})},{default:m((()=>[k(h(p(q).title),1)])),_:1},8,["style"])])),_:1},8,["style"])])),_:1},8,["style"])):v("v-if",!0),"style-3"==p(j).style?(y(),f(n,{key:2,style:x(p(R)),class:"content-wrap"},{default:m((()=>[e.isBack&&D.value?(y(),f(n,{key:0,class:"back-wrap -ml-[16rpx] text-[27px] nc-iconfont nc-icon-zuoV6xx",style:x({color:p(G)}),onClick:O},null,8,["style"])):v("v-if",!0),g(n,{class:"title-wrap",onClick:l[1]||(l[1]=t=>p(s).toRedirect(p(j).link))},{default:m((()=>[g(i,{src:p(V)(p(j).imgUrl),mode:"heightFix"},null,8,["src"])])),_:1}),g(n,{class:"search",onClick:l[2]||(l[2]=t=>p(s).toRedirect(p(j).link)),style:x({height:p(o).menuButtonInfo.height-2+"px",lineHeight:p(o).menuButtonInfo.height-2+"px"})},{default:m((()=>[g(r,{class:"nc-iconfont nc-icon-sousuo-duanV6xx1 text-[24rpx] absolute left-[20rpx]"}),g(r,{class:"text-[24rpx]"},{default:m((()=>[k(h(p(j).inputPlaceholder),1)])),_:1})])),_:1},8,["style"]),g(n,{style:x({width:p(P)})},null,8,["style"])])),_:1},8,["style"])):v("v-if",!0),"style-4"==p(j).style?(y(),f(n,{key:3,style:x(p(R)),class:"content-wrap"},{default:m((()=>[e.isBack&&D.value?(y(),f(n,{key:0,class:"back-wrap -ml-[16rpx] text-[27px] nc-iconfont nc-icon-zuoV6xx",style:x({color:p(G)}),onClick:O},null,8,["style"])):v("v-if",!0),g(r,{class:"nc-iconfont nc-icon-dizhiguanliV6xx text-[28rpx]",style:x({color:p(j).textColor})},null,8,["style"]),p(o).diyAddressInfo?(y(),f(n,{key:1,class:"title-wrap",onClick:l[3]||(l[3]=S((t=>p(J).reposition()),["stop"])),style:x({color:p(j).textColor})},{default:m((()=>[k(h(p(o).diyAddressInfo.community),1)])),_:1},8,["style"])):(y(),f(n,{key:2,class:"title-wrap",onClick:l[4]||(l[4]=S((t=>p(J).reposition()),["stop"])),style:x({color:p(j).textColor})},{default:m((()=>[k(h(p(o).defaultPositionAddress),1)])),_:1},8,["style"])),g(r,{class:"nc-iconfont nc-icon-youV6xx text-[26rpx]",onClick:l[5]||(l[5]=S((t=>p(J).reposition()),["stop"])),style:x({color:p(j).textColor})},null,8,["style"])])),_:1},8,["style"])):v("v-if",!0)])),_:1},8,["style"])])),_:1},8,["class","style"]),v(" 解决fixed定位后导航栏塌陷的问题 "),a.isFill?(y(),f(n,{key:0,class:"u-navbar-placeholder",style:x({width:"100%",paddingTop:X.value+"px"})},null,8,["style"])):v("v-if",!0)])),_:1},8,["class"])):v("v-if",!0)}}}),[["__scopeId","data-v-e69ef88a"]]);export{R as _,F as u};
