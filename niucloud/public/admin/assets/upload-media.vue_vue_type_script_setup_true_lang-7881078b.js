import{d as m,r as u,l as d,b9 as i,G as f,U as g,h as _,s as h,w as y,b,ba as k,u as v,bj as R}from"./index-6405d5ac.js";/* empty css                    */const $=m({__name:"upload-media",props:{type:{type:String,default:"image"}},emits:["success"],setup(r,{emit:c}){const o=r,s=u(null),l=d(()=>{const e={};return e.token=i(),e["site-id"]=f.get("siteId")||0,{action:`/adminapi//wechat/media/${o.type}`,multiple:!0,headers:e,accept:o.type=="image"?".bmp,.png,.jpeg,.jpg,.gif":".mp4",onSuccess:(t,a,j)=>{var p,n;t.code>=1?(c("success",t.data),(p=s.value)==null||p.handleRemove(a)):(a.status="fail",(n=s.value)==null||n.handleRemove(a),g({message:t.msg,type:"error"}))}}});return(e,t)=>{const a=R;return _(),h(a,k(v(l),{ref_key:"uploadRef",ref:s}),{default:y(()=>[b(e.$slots,"default")]),_:3},16)}}});export{$ as _};
