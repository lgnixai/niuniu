import{d as k,q as d,h as p,c as b,R as f,a0 as U,u as e,a as s,t as x,e as o,w as m,F as w,T as g,b as S,L as B,K as O,bv as F,M as R,bz as z}from"./index-6405d5ac.js";/* empty css                  *//* empty css                 *//* empty css                        */import"./el-tooltip-4ed993c7.js";/* empty css                  *//* empty css                     */import{_ as E}from"./index.vue_vue_type_style_index_0_lang-ae2c1dd6.js";import{_ as I}from"./index.vue_vue_type_script_setup_true_lang-c21881a6.js";/* empty css                        *//* empty css                  */import M from"./index-4b0a6750.js";import{u as P}from"./diy-d8c11136.js";const D={class:"content-wrap"},$={class:"edit-attr-item-wrap"},j={class:"mb-[10px]"},L={class:"edit-attr-item-wrap"},N={class:"mb-[10px]"},q={class:"style-wrap"},K={class:"edit-attr-item-wrap"},A={class:"mb-[10px]"},G=k({__name:"edit-picture-show",setup(H,{expose:v}){const t=P();return t.editComponent.ignore=[],t.editComponent.verify=V=>{const a={code:!0,message:""};return t.value[V].moduleOne.list.forEach(i=>{if(i.imageUrl==="")return a.code=!1,a.message=d("imageUrlTip"),a}),t.value[V].moduleTwo.list.forEach(i=>{if(i.imageUrl==="")return a.code=!1,a.message=d("imageUrlTip"),a}),a},v({}),(V,a)=>{const i=M,u=B,c=O,r=F,h=I,C=E,_=R,T=z;return p(),b(w,null,[f(s("div",D,[s("div",$,[s("h3",j,x(e(d)("pictureShowBlockOne")),1),o(_,{"label-width":"80px",class:"px-[10px]"},{default:m(()=>[o(u,{label:e(d)("image")},{default:m(()=>[o(i,{modelValue:e(t).editComponent.moduleOne.head.textImg,"onUpdate:modelValue":a[0]||(a[0]=l=>e(t).editComponent.moduleOne.head.textImg=l),limit:1},null,8,["modelValue"])]),_:1},8,["label"]),o(u,{label:e(d)("subTitle")},{default:m(()=>[o(c,{modelValue:e(t).editComponent.moduleOne.head.subText,"onUpdate:modelValue":a[1]||(a[1]=l=>e(t).editComponent.moduleOne.head.subText=l),modelModifiers:{trim:!0},placeholder:e(d)("subTitlePlaceholder"),clearable:"",maxlength:"8","show-word-limit":""},null,8,["modelValue","placeholder"])]),_:1},8,["label"]),o(u,{label:e(d)("subTitleTextColor")},{default:m(()=>[o(r,{modelValue:e(t).editComponent.moduleOne.head.subTextColor,"onUpdate:modelValue":a[2]||(a[2]=l=>e(t).editComponent.moduleOne.head.subTextColor=l),"show-alpha":""},null,8,["modelValue"])]),_:1},8,["label"]),o(u,{label:e(d)("pictureShowBgColor")},{default:m(()=>[o(r,{modelValue:e(t).editComponent.moduleOne.listFrame.startColor,"onUpdate:modelValue":a[3]||(a[3]=l=>e(t).editComponent.moduleOne.listFrame.startColor=l),"show-alpha":""},null,8,["modelValue"]),o(h,{name:"iconfont iconmap-connect",size:"20px",class:"block !text-gray-400 mx-[5px]"}),o(r,{modelValue:e(t).editComponent.moduleOne.listFrame.endColor,"onUpdate:modelValue":a[4]||(a[4]=l=>e(t).editComponent.moduleOne.listFrame.endColor=l),"show-alpha":""},null,8,["modelValue"])]),_:1},8,["label"]),(p(!0),b(w,null,g(e(t).editComponent.moduleOne.list,(l,y)=>(p(),b("div",{key:l.id,class:"item-wrap p-[10px] pb-0 relative border border-dashed border-gray-300 mb-[16px]"},[o(u,{label:e(d)("image")},{default:m(()=>[o(i,{modelValue:l.imageUrl,"onUpdate:modelValue":n=>l.imageUrl=n,limit:1},null,8,["modelValue","onUpdate:modelValue"])]),_:2},1032,["label"]),o(u,{label:e(d)("pictureShowBtnText")},{default:m(()=>[o(c,{modelValue:l.btnTitle.text,"onUpdate:modelValue":n=>l.btnTitle.text=n,modelModifiers:{trim:!0},placeholder:e(d)("activeCubeTitlePlaceholder"),clearable:"",maxlength:"4","show-word-limit":""},null,8,["modelValue","onUpdate:modelValue","placeholder"])]),_:2},1032,["label"]),o(u,{label:e(d)("pictureShowBtnColor")},{default:m(()=>[o(r,{modelValue:l.btnTitle.color,"onUpdate:modelValue":n=>l.btnTitle.color=n,"show-alpha":""},null,8,["modelValue","onUpdate:modelValue"])]),_:2},1032,["label"]),o(u,{label:e(d)("pictureShowBtnBgColor")},{default:m(()=>[o(r,{modelValue:l.btnTitle.startColor,"onUpdate:modelValue":n=>l.btnTitle.startColor=n,"show-alpha":""},null,8,["modelValue","onUpdate:modelValue"]),o(h,{name:"iconfont iconmap-connect",size:"20px",class:"block !text-gray-400 mx-[5px]"}),o(r,{modelValue:l.btnTitle.endColor,"onUpdate:modelValue":n=>l.btnTitle.endColor=n,"show-alpha":""},null,8,["modelValue","onUpdate:modelValue"])]),_:2},1032,["label"]),o(u,{label:e(d)("link")},{default:m(()=>[o(C,{modelValue:l.link,"onUpdate:modelValue":n=>l.link=n},null,8,["modelValue","onUpdate:modelValue"])]),_:2},1032,["label"])]))),128))]),_:1})]),s("div",L,[s("h3",N,x(e(d)("pictureShowBlockTwo")),1),o(_,{"label-width":"90px",class:"px-[10px]"},{default:m(()=>[o(u,{label:e(d)("image")},{default:m(()=>[o(i,{modelValue:e(t).editComponent.moduleTwo.head.textImg,"onUpdate:modelValue":a[5]||(a[5]=l=>e(t).editComponent.moduleTwo.head.textImg=l),limit:1},null,8,["modelValue"])]),_:1},8,["label"]),o(u,{label:e(d)("subTitle")},{default:m(()=>[o(c,{modelValue:e(t).editComponent.moduleTwo.head.subText,"onUpdate:modelValue":a[6]||(a[6]=l=>e(t).editComponent.moduleTwo.head.subText=l),modelModifiers:{trim:!0},placeholder:e(d)("subTitlePlaceholder"),clearable:"",maxlength:"8","show-word-limit":""},null,8,["modelValue","placeholder"])]),_:1},8,["label"]),o(u,{label:e(d)("subTitleTextColor")},{default:m(()=>[o(r,{modelValue:e(t).editComponent.moduleTwo.head.subTextColor,"onUpdate:modelValue":a[7]||(a[7]=l=>e(t).editComponent.moduleTwo.head.subTextColor=l),"show-alpha":""},null,8,["modelValue"])]),_:1},8,["label"]),o(u,{label:e(d)("pictureShowBgColor")},{default:m(()=>[o(r,{modelValue:e(t).editComponent.moduleTwo.listFrame.startColor,"onUpdate:modelValue":a[8]||(a[8]=l=>e(t).editComponent.moduleTwo.listFrame.startColor=l),"show-alpha":""},null,8,["modelValue"]),o(h,{name:"iconfont iconmap-connect",size:"20px",class:"block !text-gray-400 mx-[5px]"}),o(r,{modelValue:e(t).editComponent.moduleTwo.listFrame.endColor,"onUpdate:modelValue":a[9]||(a[9]=l=>e(t).editComponent.moduleTwo.listFrame.endColor=l),"show-alpha":""},null,8,["modelValue"])]),_:1},8,["label"]),(p(!0),b(w,null,g(e(t).editComponent.moduleTwo.list,(l,y)=>(p(),b("div",{key:l.id,class:"item-wrap p-[10px] pb-0 relative border border-dashed border-gray-300 mb-[16px]"},[o(u,{label:e(d)("image")},{default:m(()=>[o(i,{modelValue:l.imageUrl,"onUpdate:modelValue":n=>l.imageUrl=n,limit:1},null,8,["modelValue","onUpdate:modelValue"])]),_:2},1032,["label"]),o(u,{label:e(d)("pictureShowBtnText")},{default:m(()=>[o(c,{modelValue:l.btnTitle.text,"onUpdate:modelValue":n=>l.btnTitle.text=n,modelModifiers:{trim:!0},placeholder:e(d)("activeCubeTitlePlaceholder"),clearable:"",maxlength:"4","show-word-limit":""},null,8,["modelValue","onUpdate:modelValue","placeholder"])]),_:2},1032,["label"]),o(u,{label:e(d)("pictureShowBtnColor")},{default:m(()=>[o(r,{modelValue:l.btnTitle.color,"onUpdate:modelValue":n=>l.btnTitle.color=n,"show-alpha":""},null,8,["modelValue","onUpdate:modelValue"])]),_:2},1032,["label"]),o(u,{label:e(d)("pictureShowBtnBgColor")},{default:m(()=>[o(r,{modelValue:l.btnTitle.startColor,"onUpdate:modelValue":n=>l.btnTitle.startColor=n,"show-alpha":""},null,8,["modelValue","onUpdate:modelValue"]),o(h,{name:"iconfont iconmap-connect",size:"20px",class:"block !text-gray-400 mx-[5px]"}),o(r,{modelValue:l.btnTitle.endColor,"onUpdate:modelValue":n=>l.btnTitle.endColor=n,"show-alpha":""},null,8,["modelValue","onUpdate:modelValue"])]),_:2},1032,["label"]),o(u,{label:e(d)("link")},{default:m(()=>[o(C,{modelValue:l.link,"onUpdate:modelValue":n=>l.link=n},null,8,["modelValue","onUpdate:modelValue"])]),_:2},1032,["label"])]))),128))]),_:1})])],512),[[U,e(t).editTab=="content"]]),f(s("div",q,[s("div",K,[s("h3",A,x(e(d)("pictureShowBlockStyle")),1),o(_,{"label-width":"90px",class:"px-[10px]"},{default:m(()=>[o(u,{label:e(d)("topRounded")},{default:m(()=>[o(T,{modelValue:e(t).editComponent.moduleRounded.topRounded,"onUpdate:modelValue":a[10]||(a[10]=l=>e(t).editComponent.moduleRounded.topRounded=l),"show-input":"",size:"small",class:"ml-[10px] diy-nav-slider",max:100},null,8,["modelValue"])]),_:1},8,["label"]),o(u,{label:e(d)("bottomRounded")},{default:m(()=>[o(T,{modelValue:e(t).editComponent.moduleRounded.bottomRounded,"onUpdate:modelValue":a[11]||(a[11]=l=>e(t).editComponent.moduleRounded.bottomRounded=l),"show-input":"",size:"small",class:"ml-[10px] diy-nav-slider",max:100},null,8,["modelValue"])]),_:1},8,["label"])]),_:1})]),S(V.$slots,"style")],512),[[U,e(t).editTab=="style"]])],64)}}}),me=Object.freeze(Object.defineProperty({__proto__:null,default:G},Symbol.toStringTag,{value:"Module"}));export{me as _};
