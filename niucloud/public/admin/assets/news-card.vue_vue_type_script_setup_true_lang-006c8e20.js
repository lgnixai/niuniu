import{_ as g}from"./index.vue_vue_type_script_setup_true_lang-3b487378.js";import{d as b,r as y,l as k,u as t,h as l,c as s,a as n,e as i,t as c,B as m,F as f,T as V,v as B,R as C,a0 as E,J as N}from"./index-a7efb343.js";/* empty css                 *//* empty css                        */const $={key:0,class:"attachment-item text-sm mr-[10px] mb-[10px] w-[280px] rounded-lg overflow-hidden border border-color"},z={class:"w-full h-[130px] relative"},D={key:0,class:"absolute left-0 bottom-0 p-[10px] w-full truncate text-white leading-none"},S={key:0},j={class:"flex-1 w-0 truncate"},F={class:"w-[50px] h-[50px] ml-[10px]"},M={key:1,class:"px-[15px] py-[10px]"},R=b({__name:"news-card",props:{modelValue:{type:Object,default:()=>({})},mode:{type:String,default:"select"}},emits:["update:modelValue"],setup(h,{emit:x}){const d=h,r=y(!1),e=k({get(){return d.modelValue},set(p){x("update:modelValue",p)}}),u=document.createElement("meta");return u.content="same-origin",u.name="referrer",document.getElementsByTagName("head")[0].appendChild(u),(p,o)=>{const v=N,w=g;return t(e)?(l(),s("div",$,[n("div",{class:"relative",onMouseover:o[1]||(o[1]=a=>r.value=!0),onMouseout:o[2]||(o[2]=a=>r.value=!1)},[n("div",z,[i(v,{src:t(e).value.news_item[0].thumb_url,class:"w-full h-full"},null,8,["src"]),t(e).value.news_item.length>1?(l(),s("div",D,c(t(e).value.news_item[0].title),1)):m("",!0)]),t(e).value.news_item.length>1?(l(),s("div",S,[(l(!0),s(f,null,V(t(e).value.news_item,(a,_)=>(l(),s(f,null,[_>0?(l(),s("div",{key:0,class:B(["px-[15px] py-[10px] flex",{"border-b border-color":_<t(e).value.news_item.length-1}])},[n("div",j,c(a.title),1),n("div",F,[i(v,{src:a.thumb_url,class:"w-full h-full"},null,8,["src"])])],2)):m("",!0)],64))),256))])):(l(),s("div",M,c(t(e).value.news_item[0].title),1)),C(n("div",{class:"absolute z-[1] flex items-center justify-center w-full h-full inset-0 bg-black bg-opacity-60 cursor-pointer",onClick:o[0]||(o[0]=a=>e.value=null)},[i(w,{name:"element Delete",color:"#fff",size:"40px"})],512),[[E,r.value&&d.mode=="select"]])],32)])):m("",!0)}}});export{R as _};
