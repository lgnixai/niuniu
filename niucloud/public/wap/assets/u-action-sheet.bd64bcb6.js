import{_ as e}from"./u-icon.fc0f1d34.js";import{Y as t,Z as l,_ as a,a1 as s,a2 as i,g as o,h as c,o as n,c as r,w as u,b as d,R as p,a4 as _,f as y,n as m,y as h,z as g,i as f,D as S,$ as b,a0 as k,A as v,P as $,Q as C,ai as w}from"./index-6e20b00f.js";import{_ as B}from"./u-line.150c1c8f.js";import{_ as T}from"./_plugin-vue_export-helper.1b428a4d.js";import{_ as x}from"./u-loading-icon.da7b74f9.js";import{_ as z}from"./u-popup.fa75a127.js";const I={props:{lang:String,sessionFrom:String,sendMessageTitle:String,sendMessagePath:String,sendMessageImg:String,showMessageCard:Boolean,appParameter:String,formType:String,openType:String}},O={props:{openType:String},methods:{onGetUserInfo(e){this.$emit("getuserinfo",e.detail)},onContact(e){this.$emit("contact",e.detail)},onGetPhoneNumber(e){this.$emit("getphonenumber",e.detail)},onError(e){this.$emit("error",e.detail)},onLaunchApp(e){this.$emit("launchapp",e.detail)},onOpenSetting(e){this.$emit("opensetting",e.detail)}}};const A=T({name:"u-cell",data:()=>({}),mixins:[l,a,{props:{title:{type:[String,Number],default:()=>t.cell.title},label:{type:[String,Number],default:()=>t.cell.label},value:{type:[String,Number],default:()=>t.cell.value},icon:{type:String,default:()=>t.cell.icon},disabled:{type:Boolean,default:()=>t.cell.disabled},border:{type:Boolean,default:()=>t.cell.border},center:{type:Boolean,default:()=>t.cell.center},url:{type:String,default:()=>t.cell.url},linkType:{type:String,default:()=>t.cell.linkType},clickable:{type:Boolean,default:()=>t.cell.clickable},isLink:{type:Boolean,default:()=>t.cell.isLink},required:{type:Boolean,default:()=>t.cell.required},rightIcon:{type:String,default:()=>t.cell.rightIcon},arrowDirection:{type:String,default:()=>t.cell.arrowDirection},iconStyle:{type:[Object,String],default:()=>t.cell.iconStyle},rightIconStyle:{type:[Object,String],default:()=>t.cell.rightIconStyle},titleStyle:{type:[Object,String],default:()=>t.cell.titleStyle},size:{type:String,default:()=>t.cell.size},stop:{type:Boolean,default:()=>t.cell.stop},name:{type:[Number,String],default:()=>t.cell.name}}}],computed:{titleTextStyle(){return s(this.titleStyle)}},emits:["click"],methods:{addStyle:s,testEmpty:i.empty,clickHandler(e){this.disabled||(this.$emit("click",{name:this.name}),this.openPage(),this.stop&&this.preventEvent(e))}}},[["render",function(t,l,a,s,i,b){const k=o(c("u-icon"),e),v=f,$=S,C=o(c("u-line"),B);return n(),r(v,{class:p(["u-cell",[t.customClass]]),style:m([b.addStyle(t.customStyle)]),"hover-class":t.disabled||!t.clickable&&!t.isLink?"":"u-cell--clickable","hover-stay-time":250,onClick:b.clickHandler},{default:u((()=>[d(v,{class:p(["u-cell__body",[t.center&&"u-cell--center","large"===t.size&&"u-cell__body--large"]])},{default:u((()=>[d(v,{class:"u-cell__body__content"},{default:u((()=>[t.$slots.icon||t.icon?(n(),r(v,{key:0,class:"u-cell__left-icon-wrap"},{default:u((()=>[t.$slots.icon?_(t.$slots,"icon",{key:0},void 0,!0):(n(),r(k,{key:1,name:t.icon,"custom-style":t.iconStyle,size:"large"===t.size?22:18},null,8,["name","custom-style","size"]))])),_:3})):y("v-if",!0),d(v,{class:"u-cell__title"},{default:u((()=>[y(" 将slot与默认内容用if/else分开主要是因为微信小程序不支持slot嵌套传递，这样才能解决collapse组件的slot不失效问题，label暂时未用到。 "),t.$slots.title||!t.title?_(t.$slots,"title",{key:0},void 0,!0):(n(),r($,{key:1,class:p(["u-cell__title-text",[t.disabled&&"u-cell--disabled","large"===t.size&&"u-cell__title-text--large"]]),style:m([b.titleTextStyle])},{default:u((()=>[h(g(t.title),1)])),_:1},8,["style","class"])),_(t.$slots,"label",{},(()=>[t.label?(n(),r($,{key:0,class:p(["u-cell__label",[t.disabled&&"u-cell--disabled","large"===t.size&&"u-cell__label--large"]])},{default:u((()=>[h(g(t.label),1)])),_:1},8,["class"])):y("v-if",!0)]),!0)])),_:3})])),_:3}),_(t.$slots,"value",{},(()=>[b.testEmpty(t.value)?y("v-if",!0):(n(),r($,{key:0,class:p(["u-cell__value",[t.disabled&&"u-cell--disabled","large"===t.size&&"u-cell__value--large"]])},{default:u((()=>[h(g(t.value),1)])),_:1},8,["class"]))]),!0),t.$slots["right-icon"]||t.isLink?(n(),r(v,{key:0,class:p(["u-cell__right-icon-wrap",[`u-cell__right-icon-wrap--${t.arrowDirection}`]])},{default:u((()=>[t.rightIcon&&!t.$slots["right-icon"]?(n(),r(k,{key:0,name:t.rightIcon,"custom-style":t.rightIconStyle,color:t.disabled?"#c8c9cc":"info",size:"large"===t.size?18:16},null,8,["name","custom-style","color","size"])):_(t.$slots,"right-icon",{key:1},void 0,!0)])),_:3},8,["class"])):y("v-if",!0),t.$slots.righticon?(n(),r(v,{key:1,class:p(["u-cell__right-icon-wrap",[`u-cell__right-icon-wrap--${t.arrowDirection}`]])},{default:u((()=>[_(t.$slots,"righticon",{},void 0,!0)])),_:3},8,["class"])):y("v-if",!0)])),_:3},8,["class"]),t.border?(n(),r(C,{key:0})):y("v-if",!0)])),_:3},8,["class","style","hover-class","onClick"])}],["__scopeId","data-v-24694e79"]]);const j=T({name:"u-cell-group",mixins:[l,a,{props:{title:{type:String,default:()=>t.cellGroup.title},border:{type:Boolean,default:()=>t.cellGroup.border}}}],methods:{addStyle:s}},[["render",function(e,t,l,a,s,i){const b=S,k=f,v=o(c("u-line"),B);return n(),r(k,{style:m([i.addStyle(e.customStyle)]),class:p([[e.customClass],"u-cell-group"])},{default:u((()=>[e.title?(n(),r(k,{key:0,class:"u-cell-group__title"},{default:u((()=>[_(e.$slots,"title",{},(()=>[d(b,{class:"u-cell-group__title__text"},{default:u((()=>[h(g(e.title),1)])),_:1})]),!0)])),_:3})):y("v-if",!0),d(k,{class:"u-cell-group__wrapper"},{default:u((()=>[e.border?(n(),r(v,{key:0})):y("v-if",!0),_(e.$slots,"default",{},void 0,!0)])),_:3})])),_:3},8,["style","class"])}],["__scopeId","data-v-c8de4fdc"]]);const N=T({name:"u-gap",mixins:[l,a,{props:{bgColor:{type:String,default:()=>t.gap.bgColor},height:{type:[String,Number],default:()=>t.gap.height},marginTop:{type:[String,Number],default:()=>t.gap.marginTop},marginBottom:{type:[String,Number],default:()=>t.gap.marginBottom}}}],computed:{gapStyle(){const e={backgroundColor:this.bgColor,height:b(this.height),marginTop:b(this.marginTop),marginBottom:b(this.marginBottom)};return k(e,s(this.customStyle))}}},[["render",function(e,t,l,a,s,i){const o=f;return n(),r(o,{class:"u-gap",style:m([i.gapStyle])},null,8,["style"])}],["__scopeId","data-v-72d2fb6e"]]);const H=T({name:"u-action-sheet",mixins:[O,I,a,{props:{show:{type:Boolean,default:()=>t.actionSheet.show},title:{type:String,default:()=>t.actionSheet.title},description:{type:String,default:()=>t.actionSheet.description},actions:{type:Array,default:()=>t.actionSheet.actions},cancelText:{type:String,default:()=>t.actionSheet.cancelText},closeOnClickAction:{type:Boolean,default:()=>t.actionSheet.closeOnClickAction},safeAreaInsetBottom:{type:Boolean,default:()=>t.actionSheet.safeAreaInsetBottom},openType:{type:String,default:()=>t.actionSheet.openType},closeOnClickOverlay:{type:Boolean,default:()=>t.actionSheet.closeOnClickOverlay},round:{type:[Boolean,String,Number],default:()=>t.actionSheet.round}}}],data:()=>({}),computed:{itemStyle(){return e=>{let t={};return this.actions[e].color&&(t.color=this.actions[e].color),this.actions[e].fontSize&&(t.fontSize=b(this.actions[e].fontSize)),this.actions[e].disabled&&(t.color="#c0c4cc"),t}}},emits:["close","select"],methods:{closeHandler(){this.closeOnClickOverlay&&this.$emit("close")},cancel(){this.$emit("close")},selectHandler(e){const t=this.actions[e];!t||t.disabled||t.loading||(this.$emit("select",t),this.closeOnClickAction&&this.$emit("close"))}}},[["render",function(t,l,a,s,i,p){const b=S,k=o(c("u-icon"),e),T=f,I=o(c("u-line"),B),O=o(c("u-loading-icon"),x),A=o(c("u-gap"),N),j=o(c("u-popup"),z);return n(),r(j,{show:t.show,mode:"bottom",onClose:p.closeHandler,safeAreaInsetBottom:t.safeAreaInsetBottom,round:t.round},{default:u((()=>[d(T,{class:"u-action-sheet"},{default:u((()=>[t.title?(n(),r(T,{key:0,class:"u-action-sheet__header"},{default:u((()=>[d(b,{class:"u-action-sheet__header__title u-line-1"},{default:u((()=>[h(g(t.title),1)])),_:1}),d(T,{class:"u-action-sheet__header__icon-wrap",onClick:v(p.cancel,["stop"])},{default:u((()=>[d(k,{name:"close",size:"17",color:"#c8c9cc",bold:""})])),_:1},8,["onClick"])])),_:1})):y("v-if",!0),t.description?(n(),r(b,{key:1,class:"u-action-sheet__description",style:m([{marginTop:`${t.title&&t.description?0:"18px"}`}])},{default:u((()=>[h(g(t.description),1)])),_:1},8,["style"])):y("v-if",!0),_(t.$slots,"default",{},(()=>[t.description?(n(),r(I,{key:0})):y("v-if",!0),d(T,{class:"u-action-sheet__item-wrap"},{default:u((()=>[(n(!0),$(C,null,w(t.actions,((e,l)=>(n(),r(T,{key:l},{default:u((()=>[d(T,{class:"u-action-sheet__item-wrap__item",onClick:v((e=>p.selectHandler(l)),["stop"]),"hover-class":e.disabled||e.loading?"":"u-action-sheet--hover","hover-stay-time":150},{default:u((()=>[e.loading?(n(),r(O,{key:1,"custom-class":"van-action-sheet__loading",size:"18",mode:"circle"})):(n(),$(C,{key:0},[d(b,{class:"u-action-sheet__item-wrap__item__name",style:m([p.itemStyle(l)])},{default:u((()=>[h(g(e.name),1)])),_:2},1032,["style"]),e.subname?(n(),r(b,{key:0,class:"u-action-sheet__item-wrap__item__subname"},{default:u((()=>[h(g(e.subname),1)])),_:2},1024)):y("v-if",!0)],64))])),_:2},1032,["onClick","hover-class"]),l!==t.actions.length-1?(n(),r(I,{key:0})):y("v-if",!0)])),_:2},1024)))),128))])),_:1})]),!0),t.cancelText?(n(),r(A,{key:2,bgColor:"#eaeaec",height:"6"})):y("v-if",!0),d(T,{class:"u-action-sheet__item-wrap__item u-action-sheet__cancel","hover-class":"u-action-sheet--hover"},{default:u((()=>[t.cancelText?(n(),r(b,{key:0,onTouchmove:l[0]||(l[0]=v((()=>{}),["stop","prevent"])),"hover-stay-time":150,class:"u-action-sheet__cancel-text",onClick:p.cancel},{default:u((()=>[h(g(t.cancelText),1)])),_:1},8,["onClick"])):y("v-if",!0)])),_:1})])),_:3})])),_:3},8,["show","onClose","safeAreaInsetBottom","round"])}],["__scopeId","data-v-ad7e8d01"]]);export{A as _,j as a,H as b};
