import{d as Se,q as n,n as F,r as v,aK as le,a$ as Ve,a3 as ve,Q as Te,A as te,a2 as oe,h as C,c as g,R as w,a0 as y,u as e,a as r,t as p,e as t,w as i,i as h,s as R,B as M,F as W,T as z,v as Ue,Z as ke,ae as Ie,au as We,av as Be,L as Pe,bv as Ee,M as Re,a1 as ze,K as De,E as Ae,X as He,bz as Ne,aT as Fe,ad as Me,W as $e,bA as je,bB as Le,Y as Oe}from"./index-a7efb343.js";/* empty css                   *//* empty css                         *//* empty css                      *//* empty css               *//* empty css                  *//* empty css                  *//* empty css                     *//* empty css                  *//* empty css                 *//* empty css                        *//* empty css                    *//* empty css                  */import{_ as Ge}from"./index.vue_vue_type_script_setup_true_lang-3b487378.js";/* empty css                  *//* empty css                        */import"./el-tooltip-4ed993c7.js";/* empty css                  *//* empty css                   *//* empty css                  */import{_ as Ke}from"./index.vue_vue_type_style_index_0_lang-6eb49402.js";import qe from"./index-414a5ed7.js";/* empty css                *//* empty css                        */import"./el-form-item-4ed993c7.js";/* empty css                       *//* empty css                 */import{u as Qe}from"./diy-0f67560e.js";import{S as $}from"./sortable.esm-be94e56d.js";import{a as Xe}from"./diy-f8b2d6e1.js";import{r as j}from"./range-4dff7a5c.js";const Ye={class:"content-wrap"},Ze={class:"edit-attr-item-wrap"},Je={class:"mb-[10px]"},el={class:"edit-attr-item-wrap"},ll={class:"mb-[10px]"},tl={class:"text-sm text-gray-400 mb-[10px]"},ol={class:"text-sm text-gray-400 mt-[10px] leading-[1.5]"},al={class:"flex flex-wrap"},nl=["onClick"],il=["src"],dl={class:"dialog-footer"},rl={class:"edit-attr-item-wrap mb-[20px]"},sl={class:"mb-[10px]"},pl={class:"text-sm text-gray-400 mb-[10px]"},ml=["onClick"],ul={class:"edit-attr-item-wrap"},cl={class:"text-sm text-gray-400 mb-[10px]"},hl=["onClick"],fl=["onClick"],bl={class:"mt-[16px] flex justify-end"},Cl={class:"flex items-center justify-end mt-[15px]"},_l={class:"text-sm text-gray-400 mb-[10px]"},gl=["onClick"],xl={class:"style-wrap"},wl={key:0,class:"edit-attr-item-wrap"},yl={class:"mb-[10px]"},Sl={key:1,class:"edit-attr-item-wrap"},Vl={class:"mb-[10px]"},vl={class:"edit-attr-item-wrap"},Tl={class:"mb-[10px]"},Ul={class:"edit-attr-item-wrap"},kl={class:"mb-[10px]"},Il={class:"edit-attr-item-wrap"},Wl={class:"mb-[10px]"},Bl={class:"edit-attr-item-wrap"},Pl={class:"mb-[10px]"},El=Se({__name:"edit-carousel-search",setup(Rl,{expose:ae}){const l=Qe();l.editComponent.ignore=["componentBgColor","componentBgUrl","marginTop","marginBottom","topRounded","bottomRounded","pageBgColor","marginBoth"],l.editComponent.verify=m=>{const o={code:!0,message:""};return l.value[m].search.hotWord.list.forEach(s=>{if(s.text=="")return o.code=!1,o.message=n("carouselSearchHotWordTextPlaceholder"),o}),l.value[m].tab.list.forEach(s=>{if(s.text=="")return o.code=!1,o.message=n("carouselSearchTabCategoryTextPlaceholder"),o}),l.value[m].swiper.control&&l.value[m].swiper.list.forEach(s=>{if(s.imageUrl=="")return o.code=!1,o.message=n("imageUrlTip"),o}),o};const S=F({title:l.editComponent.search.styleName,value:l.editComponent.search.style}),T=v(!1),ne=()=>{T.value=!0,S.title=l.editComponent.search.styleName,S.value=l.editComponent.search.style},ie=m=>{S.title=m.title,S.value=m.value},de=()=>{l.editComponent.search.styleName=S.title,l.editComponent.search.style=S.value,T.value=!1},re=F([{url:"static/resource/images/diy/carousel_search/style_1.png",title:"风格1",value:"style-1"},{url:"static/resource/images/diy/carousel_search/style_2.png",title:"风格2",value:"style-2"}]);l.editComponent.search.hotWord.list.forEach(m=>{m.id||(m.id=l.generateRandom())}),l.editComponent.tab.list.forEach(m=>{m.id||(m.id=l.generateRandom())}),l.editComponent.swiper.list.forEach(m=>{m.id||(m.id=l.generateRandom())});const L=v(["tab","swiper"]),se=m=>{};le(()=>{D()});const pe=()=>{l.editComponent.search.hotWord.list.push({id:l.generateRandom(),text:"关键词"})},me=m=>{l.editComponent.tab.list[m].diy_id=0,l.editComponent.tab.list[m].diy_title=""},ue=()=>{l.editComponent.tab.list.push({id:l.generateRandom(),text:"分类名称",source:"diy_page",diy_id:"",diy_title:""})},O=v(),G=v(),K=v();le(()=>{Ve(()=>{$.create(O.value,{group:"item-wrap",animation:200,onEnd:s=>{const u=l.editComponent.search.hotWord.list[s.oldIndex];l.editComponent.search.hotWord.list.splice(s.oldIndex,1),l.editComponent.search.hotWord.list.splice(s.newIndex,0,u),m.sort(j(l.editComponent.search.hotWord.list.length).map(d=>d.toString()))}});const m=$.create(G.value,{group:"item-wrap",animation:200,onEnd:s=>{const u=l.editComponent.tab.list[s.oldIndex];l.editComponent.tab.list.splice(s.oldIndex,1),l.editComponent.tab.list.splice(s.newIndex,0,u),m.sort(j(l.editComponent.tab.list.length).map(d=>d.toString()))}}),o=$.create(K.value,{group:"item-wrap",animation:200,onEnd:s=>{const u=l.editComponent.swiper.list[s.oldIndex];l.editComponent.swiper.list.splice(s.oldIndex,1),l.editComponent.swiper.list.splice(s.newIndex,0,u),o.sort(j(l.editComponent.swiper.list.length).map(d=>d.toString())),B(!0)}})})});const U=v(!1),f=F({page:1,limit:10,total:0,loading:!0,data:[],searchParam:{}}),q=v(),D=(m=1)=>{f.loading=!0,f.page=m,Xe({page:f.page,limit:f.limit,...f.searchParam}).then(o=>{f.loading=!1;let s=o.data.data,u=[],d=0;if(l.id)for(let c=0;c<s.length;c++)s[c].id==l.id?d++:u.push(s[c]);else u=ve(s);d&&(o.data.total=o.data.total-d),f.data=u,f.total=o.data.total}).catch(()=>{f.loading=!1})};let k={},A=0;const ce=m=>{k=m},he=()=>{l.editComponent.tab.list[A].diy_id=k.id,l.editComponent.tab.list[A].diy_title=k.title,U.value=!1},fe=m=>{U.value=!0,A=m,k&&setTimeout(()=>{q.value.setCurrentRow(k)},200)};Te(()=>l.editComponent.swiper.list,(m,o)=>{B()},{deep:!0});const be=()=>{l.editComponent.swiper.list.push({id:l.generateRandom(),imageUrl:"",imgWidth:0,imgHeight:0,link:{name:""}})},Ce=m=>{B(!0)},_e=m=>{B(!0)},B=(m=!1)=>{l.editComponent.swiper.list.forEach((o,s)=>{const u=new Image;u.src=te(o.imageUrl),u.onload=async()=>{if(o.imgWidth=u.width,o.imgHeight=u.height,m&&s==0){const d=o.imgHeight/o.imgWidth;l.editComponent.swiper.swiperStyle=="style-1"?o.width=375*.92:o.width=355,o.height=o.width*d,l.editComponent.swiper.imageHeight=parseInt(o.height)}}})};return ae({}),(m,o)=>{const s=We,u=Be,d=Pe,c=Ee,_=Re,Q=oe("ArrowRight"),H=ze,I=De,X=qe,Y=Ke,V=Ae,Z=He,P=Ne,E=Ge,J=Fe,ge=oe("Close"),N=Me,xe=$e,ee=je,we=Le,ye=Oe;return C(),g(W,null,[w(r("div",Ye,[r("div",Ze,[r("h3",Je,p(e(n)("carouselSearchShowPosition")),1),t(_,{"label-width":"100px",class:"px-[10px]"},{default:i(()=>[t(d,{label:e(n)("carouselSearchShowWay")},{default:i(()=>[t(u,{modelValue:e(l).editComponent.positionWay,"onUpdate:modelValue":o[0]||(o[0]=a=>e(l).editComponent.positionWay=a)},{default:i(()=>[t(s,{label:"static"},{default:i(()=>[h(p(e(n)("carouselSearchShowWayStatic")),1)]),_:1}),t(s,{label:"fixed"},{default:i(()=>[h(p(e(n)("carouselSearchShowWayFixed")),1)]),_:1})]),_:1},8,["modelValue"])]),_:1},8,["label"]),w(t(d,{label:e(n)("carouselSearchFixedBgColor")},{default:i(()=>[t(c,{modelValue:e(l).editComponent.fixedBgColor,"onUpdate:modelValue":o[1]||(o[1]=a=>e(l).editComponent.fixedBgColor=a),"show-alpha":"",predefine:e(l).predefineColors},null,8,["modelValue","predefine"])]),_:1},8,["label"]),[[y,e(l).editComponent.positionWay=="fixed"]]),t(d,{label:e(n)("carouselSearchBgGradient")},{default:i(()=>[t(u,{modelValue:e(l).editComponent.bgGradient,"onUpdate:modelValue":o[2]||(o[2]=a=>e(l).editComponent.bgGradient=a)},{default:i(()=>[t(s,{label:!0},{default:i(()=>[h(p(e(n)("carouselSearchOpen")),1)]),_:1}),t(s,{label:!1},{default:i(()=>[h(p(e(n)("carouselSearchClose")),1)]),_:1})]),_:1},8,["modelValue"])]),_:1},8,["label"])]),_:1})]),r("div",el,[r("h3",ll,p(e(n)("carouselSearchSet")),1),t(_,{"label-width":"100px",class:"px-[10px]"},{default:i(()=>[t(d,{label:e(n)("selectStyle"),class:"flex"},{default:i(()=>[r("span",{class:"text-primary flex-1 cursor-pointer",onClick:ne},p(e(l).editComponent.search.styleName),1),t(H,null,{default:i(()=>[t(Q)]),_:1})]),_:1},8,["label"]),e(l).editComponent.search.style=="style-2"?(C(),R(d,{key:0,label:e(n)("carouselSearchSubTitle")},{default:i(()=>[t(I,{modelValue:e(l).editComponent.search.subTitle.text,"onUpdate:modelValue":o[3]||(o[3]=a=>e(l).editComponent.search.subTitle.text=a),modelModifiers:{trim:!0},placeholder:e(n)("carouselSearchSubTitlePlaceholder"),clearable:"",maxlength:"10","show-word-limit":""},null,8,["modelValue","placeholder"])]),_:1},8,["label"])):M("",!0),t(d,{label:e(n)("logo")},{default:i(()=>[t(X,{modelValue:e(l).editComponent.search.logo,"onUpdate:modelValue":o[4]||(o[4]=a=>e(l).editComponent.search.logo=a),limit:1},null,8,["modelValue"]),r("div",tl,p(e(n)("carouselSearchLogoTips")),1)]),_:1},8,["label"]),t(d,{label:e(n)("carouselSearchText")},{default:i(()=>[r("div",null,[t(I,{modelValue:e(l).editComponent.search.text,"onUpdate:modelValue":o[5]||(o[5]=a=>e(l).editComponent.search.text=a),modelModifiers:{trim:!0},placeholder:e(n)("carouselSearchPlaceholder"),clearable:"",maxlength:"20","show-word-limit":""},null,8,["modelValue","placeholder"]),r("p",ol,p(e(n)("carouselSearchTextTips")),1)])]),_:1},8,["label"]),t(d,{label:e(n)("link")},{default:i(()=>[t(Y,{modelValue:e(l).editComponent.search.link,"onUpdate:modelValue":o[6]||(o[6]=a=>e(l).editComponent.search.link=a)},null,8,["modelValue"])]),_:1},8,["label"])]),_:1}),t(Z,{modelValue:T.value,"onUpdate:modelValue":o[8]||(o[8]=a=>T.value=a),title:e(n)("selectStyle"),width:"500px"},{footer:i(()=>[r("span",dl,[t(V,{onClick:o[7]||(o[7]=a=>T.value=!1)},{default:i(()=>[h(p(e(n)("cancel")),1)]),_:1}),t(V,{type:"primary",onClick:de},{default:i(()=>[h(p(e(n)("confirm")),1)]),_:1})])]),default:i(()=>[r("div",al,[(C(!0),g(W,null,z(re,(a,x)=>(C(),g("div",{key:x,class:Ue([{"border-primary":S.value==a.value},"flex items-center justify-center overflow-hidden w-[200px] h-[100px] m-[6px] cursor-pointer border bg-[#eee]"]),onClick:b=>ie(a)},[r("img",{src:e(te)(a.url)},null,8,il)],10,nl))),128))])]),_:1},8,["modelValue","title"])]),r("div",rl,[r("h3",sl,p(e(n)("carouselSearchHotWordSet")),1),t(_,{"label-width":"100px",class:"px-[10px]"},{default:i(()=>[t(d,{label:e(n)("carouselSearchHotWordInterval")},{default:i(()=>[t(P,{modelValue:e(l).editComponent.search.hotWord.interval,"onUpdate:modelValue":o[9]||(o[9]=a=>e(l).editComponent.search.hotWord.interval=a),"show-input":"",size:"small",class:"ml-[10px] diy-nav-slider",min:1,max:10},null,8,["modelValue"])]),_:1},8,["label"]),r("p",pl,p(e(n)("dragMouseAdjustOrder")),1),r("div",{ref_key:"searchHotWordTabBoxRef",ref:O},[(C(!0),g(W,null,z(e(l).editComponent.search.hotWord.list,(a,x)=>(C(),g("div",{key:a.id,class:"item-wrap p-[10px] relative border border-dashed border-gray-300 mb-[16px]"},[t(d,{label:e(n)("carouselSearchHotWordText"),class:"!mb-0"},{default:i(()=>[t(I,{modelValue:a.text,"onUpdate:modelValue":b=>a.text=b,modelModifiers:{trim:!0},placeholder:e(n)("carouselSearchHotWordTextPlaceholder"),clearable:"",maxlength:"4","show-word-limit":""},null,8,["modelValue","onUpdate:modelValue","placeholder"])]),_:2},1032,["label"]),r("div",{class:"del absolute cursor-pointer z-[2] top-[-8px] right-[-8px]",onClick:b=>e(l).editComponent.search.hotWord.list.splice(x,1)},[t(E,{name:"element CircleCloseFilled",color:"#bbb",size:"20px"})],8,ml)]))),128)),w(t(V,{class:"w-full",onClick:pe},{default:i(()=>[h(p(e(n)("carouselSearchAddHotWordItem")),1)]),_:1},512),[[y,e(l).editComponent.search.hotWord.list.length<50]])],512)]),_:1})]),t(we,{modelValue:L.value,"onUpdate:modelValue":o[17]||(o[17]=a=>L.value=a),onChange:se,class:"collapse-wrap"},{default:i(()=>[t(ee,{title:e(n)("carouselSearchTabSet"),name:"tab"},{default:i(()=>[r("div",ul,[t(_,{"label-width":"100px",class:"px-[10px]"},{default:i(()=>[t(d,{label:e(n)("carouselSearchTabControl")},{default:i(()=>[t(J,{modelValue:e(l).editComponent.tab.control,"onUpdate:modelValue":o[10]||(o[10]=a=>e(l).editComponent.tab.control=a)},null,8,["modelValue"])]),_:1},8,["label"]),r("p",cl,p(e(n)("dragMouseAdjustOrder")),1),r("div",{ref_key:"tabBoxRef",ref:G},[(C(!0),g(W,null,z(e(l).editComponent.tab.list,(a,x)=>(C(),g("div",{key:a.id,class:"item-wrap p-[10px] pb-0 relative border border-dashed border-gray-300 mb-[16px]"},[t(d,{label:e(n)("carouselSearchTabCategoryText")},{default:i(()=>[t(I,{modelValue:a.text,"onUpdate:modelValue":b=>a.text=b,modelModifiers:{trim:!0},placeholder:e(n)("carouselSearchTabCategoryTextPlaceholder"),clearable:"",maxlength:"4","show-word-limit":""},null,8,["modelValue","onUpdate:modelValue","placeholder"])]),_:2},1032,["label"]),t(d,{label:e(n)("dataSources")},{default:i(()=>[t(I,{modelValue:a.diy_title,"onUpdate:modelValue":b=>a.diy_title=b,modelModifiers:{trim:!0},placeholder:e(n)("selectDiyPagePlaceholder"),readonly:"",class:"select-diy-page-input",onClick:b=>fe(x)},{suffix:i(()=>[r("div",{onClick:ke(b=>me(x),["stop"])},[a.diy_title?(C(),R(H,{key:0},{default:i(()=>[t(ge)]),_:1})):(C(),R(H,{key:1},{default:i(()=>[t(Q)]),_:1}))],8,hl)]),_:2},1032,["modelValue","onUpdate:modelValue","placeholder","onClick"])]),_:2},1032,["label"]),w(r("div",{class:"del absolute cursor-pointer z-[2] top-[-8px] right-[-8px]",onClick:b=>e(l).editComponent.tab.list.splice(x,1)},[t(E,{name:"element CircleCloseFilled",color:"#bbb",size:"20px"})],8,fl),[[y,e(l).editComponent.tab.list.length>1]])]))),128)),w(t(V,{class:"w-full",onClick:ue},{default:i(()=>[h(p(e(n)("carouselSearchAddTabItem")),1)]),_:1},512),[[y,e(l).editComponent.tab.list.length<50]])],512),t(Z,{modelValue:U.value,"onUpdate:modelValue":o[14]||(o[14]=a=>U.value=a),title:e(n)("selectSourcesDiyPage"),width:"1000px","close-on-press-escape":!1,"destroy-on-close":!0,"close-on-click-modal":!1},{default:i(()=>[w((C(),R(e(Ie),{data:f.data,ref_key:"diyPageTableRef",ref:q,size:"large",height:"490px",onCurrentChange:ce,"row-key":"id","highlight-current-row":""},{empty:i(()=>[r("span",null,p(f.loading?"":e(n)("emptyData")),1)]),default:i(()=>[t(N,{prop:"page_title",label:e(n)("diyPageTitle"),"min-width":"120"},null,8,["label"]),t(N,{prop:"addon_name",label:e(n)("diyPageTypeName"),"min-width":"80"},null,8,["label"]),t(N,{prop:"type_name",label:e(n)("diyPageForAddon"),"min-width":"80"},null,8,["label"])]),_:1},8,["data"])),[[ye,f.loading]]),r("div",bl,[t(xe,{"current-page":f.page,"onUpdate:current-page":o[11]||(o[11]=a=>f.page=a),"page-size":f.limit,"onUpdate:page-size":o[12]||(o[12]=a=>f.limit=a),layout:"total, sizes, prev, pager, next, jumper",total:f.total,onSizeChange:D,onCurrentChange:D},null,8,["current-page","page-size","total"])]),r("div",Cl,[t(V,{type:"primary",onClick:he},{default:i(()=>[h(p(e(n)("confirm")),1)]),_:1}),t(V,{onClick:o[13]||(o[13]=a=>U.value=!1)},{default:i(()=>[h(p(e(n)("cancel")),1)]),_:1})])]),_:1},8,["modelValue","title"])]),_:1})])]),_:1},8,["title"]),t(ee,{title:e(n)("carouselSearchSwiperSet"),name:"swiper"},{default:i(()=>[t(_,{"label-width":"100px",class:"px-[10px]"},{default:i(()=>[t(d,{label:e(n)("carouselSearchSwiperControl")},{default:i(()=>[t(J,{modelValue:e(l).editComponent.swiper.control,"onUpdate:modelValue":o[15]||(o[15]=a=>e(l).editComponent.swiper.control=a)},null,8,["modelValue"])]),_:1},8,["label"]),t(d,{label:e(n)("carouselSearchSwiperInterval")},{default:i(()=>[t(P,{modelValue:e(l).editComponent.swiper.interval,"onUpdate:modelValue":o[16]||(o[16]=a=>e(l).editComponent.swiper.interval=a),"show-input":"",size:"small",class:"ml-[10px] diy-nav-slider",min:1,max:10},null,8,["modelValue"])]),_:1},8,["label"]),r("div",_l,p(e(n)("carouselSearchSwiperTips")),1),r("div",{ref_key:"imageBoxRef",ref:K},[(C(!0),g(W,null,z(e(l).editComponent.swiper.list,(a,x)=>(C(),g("div",{key:a.id,class:"item-wrap p-[10px] pb-0 relative border border-dashed border-gray-300 mb-[16px]"},[t(d,{label:e(n)("image")},{default:i(()=>[t(X,{modelValue:a.imageUrl,"onUpdate:modelValue":b=>a.imageUrl=b,limit:1,onChange:Ce},null,8,["modelValue","onUpdate:modelValue"])]),_:2},1032,["label"]),w(r("div",{class:"del absolute cursor-pointer z-[2] top-[-8px] right-[-8px]",onClick:b=>e(l).editComponent.swiper.list.splice(x,1)},[t(E,{name:"element CircleCloseFilled",color:"#bbb",size:"20px"})],8,gl),[[y,e(l).editComponent.swiper.list.length>1]]),t(d,{label:e(n)("link")},{default:i(()=>[t(Y,{modelValue:a.link,"onUpdate:modelValue":b=>a.link=b},null,8,["modelValue","onUpdate:modelValue"])]),_:2},1032,["label"])]))),128))],512),w(t(V,{class:"w-full",onClick:be},{default:i(()=>[h(p(e(n)("addImageAd")),1)]),_:1},512),[[y,e(l).editComponent.swiper.list.length<10]])]),_:1})]),_:1},8,["title"])]),_:1},8,["modelValue"])],512),[[y,e(l).editTab=="content"]]),w(r("div",xl,[e(l).editComponent.search.style=="style-2"?(C(),g("div",wl,[r("h3",yl,p(e(n)("carouselSearchPositionStyle")),1),t(_,{"label-width":"100px",class:"px-[10px]"},{default:i(()=>[t(d,{label:e(n)("carouselSearchTextColor")},{default:i(()=>[t(c,{modelValue:e(l).editComponent.search.positionColor,"onUpdate:modelValue":o[18]||(o[18]=a=>e(l).editComponent.search.positionColor=a),"show-alpha":"",predefine:e(l).predefineColors},null,8,["modelValue","predefine"])]),_:1},8,["label"])]),_:1})])):M("",!0),e(l).editComponent.search.style=="style-2"?(C(),g("div",Sl,[r("h3",Vl,p(e(n)("carouselSearchSubTitleStyle")),1),t(_,{"label-width":"100px",class:"px-[10px]"},{default:i(()=>[t(d,{label:e(n)("carouselSearchTextColor")},{default:i(()=>[t(c,{modelValue:e(l).editComponent.search.subTitle.textColor,"onUpdate:modelValue":o[19]||(o[19]=a=>e(l).editComponent.search.subTitle.textColor=a),"show-alpha":"",predefine:e(l).predefineColors},null,8,["modelValue","predefine"])]),_:1},8,["label"]),t(d,{label:e(n)("carouselSearchBgColor")},{default:i(()=>[t(c,{modelValue:e(l).editComponent.search.subTitle.startColor,"onUpdate:modelValue":o[20]||(o[20]=a=>e(l).editComponent.search.subTitle.startColor=a),predefine:e(l).predefineColors,"show-alpha":""},null,8,["modelValue","predefine"]),t(E,{name:"iconfont iconmap-connect",size:"20px",class:"block !text-gray-400 mx-[5px]"}),t(c,{modelValue:e(l).editComponent.search.subTitle.endColor,"onUpdate:modelValue":o[21]||(o[21]=a=>e(l).editComponent.search.subTitle.endColor=a),predefine:e(l).predefineColors,"show-alpha":""},null,8,["modelValue","predefine"])]),_:1},8,["label"])]),_:1})])):M("",!0),r("div",vl,[r("h3",Tl,p(e(n)("carouselSearchStyle")),1),t(_,{"label-width":"100px",class:"px-[10px]"},{default:i(()=>[t(d,{label:e(n)("carouselSearchTextColor")},{default:i(()=>[t(c,{modelValue:e(l).editComponent.search.color,"onUpdate:modelValue":o[22]||(o[22]=a=>e(l).editComponent.search.color=a),"show-alpha":"",predefine:e(l).predefineColors},null,8,["modelValue","predefine"])]),_:1},8,["label"]),t(d,{label:e(n)("carouselSearchBgColor")},{default:i(()=>[t(c,{modelValue:e(l).editComponent.search.bgColor,"onUpdate:modelValue":o[23]||(o[23]=a=>e(l).editComponent.search.bgColor=a),"show-alpha":"",predefine:e(l).predefineColors},null,8,["modelValue","predefine"])]),_:1},8,["label"]),t(d,{label:e(n)("carouselSearchBtnColor")},{default:i(()=>[t(c,{modelValue:e(l).editComponent.search.btnColor,"onUpdate:modelValue":o[24]||(o[24]=a=>e(l).editComponent.search.btnColor=a),"show-alpha":"",predefine:e(l).predefineColors},null,8,["modelValue","predefine"])]),_:1},8,["label"]),t(d,{label:e(n)("carouselSearchBtnBgColor")},{default:i(()=>[t(c,{modelValue:e(l).editComponent.search.btnBgColor,"onUpdate:modelValue":o[25]||(o[25]=a=>e(l).editComponent.search.btnBgColor=a),"show-alpha":"",predefine:e(l).predefineColors},null,8,["modelValue","predefine"])]),_:1},8,["label"])]),_:1})]),r("div",Ul,[r("h3",kl,p(e(n)("carouselSearchTabStyle")),1),t(_,{"label-width":"100px",class:"px-[10px]"},{default:i(()=>[t(d,{label:e(n)("noColor")},{default:i(()=>[t(c,{modelValue:e(l).editComponent.tab.noColor,"onUpdate:modelValue":o[26]||(o[26]=a=>e(l).editComponent.tab.noColor=a),"show-alpha":"",predefine:e(l).predefineColors},null,8,["modelValue","predefine"])]),_:1},8,["label"]),t(d,{label:e(n)("selectColor")},{default:i(()=>[t(c,{modelValue:e(l).editComponent.tab.selectColor,"onUpdate:modelValue":o[27]||(o[27]=a=>e(l).editComponent.tab.selectColor=a),"show-alpha":"",predefine:e(l).predefineColors},null,8,["modelValue","predefine"])]),_:1},8,["label"]),t(d,{label:e(n)("fixedNoColor")},{default:i(()=>[t(c,{modelValue:e(l).editComponent.tab.fixedNoColor,"onUpdate:modelValue":o[28]||(o[28]=a=>e(l).editComponent.tab.fixedNoColor=a),"show-alpha":"",predefine:e(l).predefineColors},null,8,["modelValue","predefine"])]),_:1},8,["label"]),t(d,{label:e(n)("fixedSelectColor")},{default:i(()=>[t(c,{modelValue:e(l).editComponent.tab.fixedSelectColor,"onUpdate:modelValue":o[29]||(o[29]=a=>e(l).editComponent.tab.fixedSelectColor=a),"show-alpha":"",predefine:e(l).predefineColors},null,8,["modelValue","predefine"])]),_:1},8,["label"])]),_:1})]),r("div",Il,[r("h3",Wl,p(e(n)("carouselSearchSwiperSet")),1),t(_,{"label-width":"100px",class:"px-[10px]"},{default:i(()=>[t(d,{label:e(n)("carouselSearchSwiperStyle"),onChange:_e},{default:i(()=>[t(u,{modelValue:e(l).editComponent.swiper.swiperStyle,"onUpdate:modelValue":o[30]||(o[30]=a=>e(l).editComponent.swiper.swiperStyle=a)},{default:i(()=>[t(s,{label:"style-1"},{default:i(()=>[h(p(e(n)("carouselSearchSwiperIndicatorStyle1")),1)]),_:1}),t(s,{label:"style-2"},{default:i(()=>[h(p(e(n)("carouselSearchSwiperIndicatorStyle2")),1)]),_:1}),t(s,{label:"style-3"},{default:i(()=>[h(p(e(n)("carouselSearchSwiperIndicatorStyle3")),1)]),_:1})]),_:1},8,["modelValue"])]),_:1},8,["label"]),t(d,{label:e(n)("topRounded")},{default:i(()=>[t(P,{modelValue:e(l).editComponent.swiper.topRounded,"onUpdate:modelValue":o[31]||(o[31]=a=>e(l).editComponent.swiper.topRounded=a),"show-input":"",size:"small",class:"ml-[10px] diy-nav-slider",max:50},null,8,["modelValue"])]),_:1},8,["label"]),t(d,{label:e(n)("bottomRounded")},{default:i(()=>[t(P,{modelValue:e(l).editComponent.swiper.bottomRounded,"onUpdate:modelValue":o[32]||(o[32]=a=>e(l).editComponent.swiper.bottomRounded=a),"show-input":"",size:"small",class:"ml-[10px] diy-nav-slider",max:50},null,8,["modelValue"])]),_:1},8,["label"])]),_:1})]),r("div",Bl,[r("h3",Pl,p(e(n)("carouselSearchSwiperIndicatorSet")),1),t(_,{"label-width":"100px",class:"px-[10px]"},{default:i(()=>[t(d,{label:e(n)("carouselSearchSwiperIndicatorStyle")},{default:i(()=>[t(u,{modelValue:e(l).editComponent.swiper.indicatorStyle,"onUpdate:modelValue":o[33]||(o[33]=a=>e(l).editComponent.swiper.indicatorStyle=a)},{default:i(()=>[t(s,{label:"style-1"},{default:i(()=>[h(p(e(n)("carouselSearchSwiperIndicatorStyle1")),1)]),_:1}),t(s,{label:"style-2"},{default:i(()=>[h(p(e(n)("carouselSearchSwiperIndicatorStyle2")),1)]),_:1}),t(s,{label:"style-3"},{default:i(()=>[h(p(e(n)("carouselSearchSwiperIndicatorStyle3")),1)]),_:1})]),_:1},8,["modelValue"])]),_:1},8,["label"]),t(d,{label:e(n)("carouselSearchSwiperIndicatorAlign")},{default:i(()=>[t(u,{modelValue:e(l).editComponent.swiper.indicatorAlign,"onUpdate:modelValue":o[34]||(o[34]=a=>e(l).editComponent.swiper.indicatorAlign=a)},{default:i(()=>[t(s,{label:"left"},{default:i(()=>[h(p(e(n)("alignLeft")),1)]),_:1}),t(s,{label:"center"},{default:i(()=>[h(p(e(n)("alignCenter")),1)]),_:1}),t(s,{label:"right"},{default:i(()=>[h(p(e(n)("alignRight")),1)]),_:1})]),_:1},8,["modelValue"])]),_:1},8,["label"]),t(d,{label:e(n)("noColor")},{default:i(()=>[t(c,{modelValue:e(l).editComponent.swiper.indicatorColor,"onUpdate:modelValue":o[35]||(o[35]=a=>e(l).editComponent.swiper.indicatorColor=a),"show-alpha":"",predefine:e(l).predefineColors},null,8,["modelValue","predefine"])]),_:1},8,["label"]),t(d,{label:e(n)("selectColor")},{default:i(()=>[t(c,{modelValue:e(l).editComponent.swiper.indicatorActiveColor,"onUpdate:modelValue":o[36]||(o[36]=a=>e(l).editComponent.swiper.indicatorActiveColor=a),"show-alpha":"",predefine:e(l).predefineColors},null,8,["modelValue","predefine"])]),_:1},8,["label"])]),_:1})])],512),[[y,e(l).editTab=="style"]])],64)}}});const ut=Object.freeze(Object.defineProperty({__proto__:null,default:El},Symbol.toStringTag,{value:"Module"}));export{ut as _};
