import{d as i,l as d,a2 as v,h as l,c as a,e as f,w as k,a as h,u as y,F as m,T as B,s as b,B as u,ac as C}from"./index-6405d5ac.js";/* empty css                  */const L=["innerHTML"],T=i({__name:"select-menu-item",props:{menu:Object,level:{type:Number,default:0}},setup(o){const e=o,r=d(()=>{let t="";for(let n=0;n<e.level;n++)t+=n==0?"&emsp;|--":"--";return t});return(t,n)=>{const s=C,c=v("select-menu-item",!0);return e.menu.menu_type!=2?(l(),a(m,{key:0},[f(s,{label:`${e.menu.menu_name}`,value:e.menu.menu_key},{default:k(()=>[h("span",{innerHTML:`${y(r)}${e.menu.menu_name}`},null,8,L)]),_:1},8,["label","value"]),e.menu.children?(l(!0),a(m,{key:0},B(e.menu.children,(p,_)=>(l(),b(c,{menu:p,level:e.level+1,key:_},null,8,["menu","level"]))),128)):u("",!0)],64)):u("",!0)}}});export{T as default};
