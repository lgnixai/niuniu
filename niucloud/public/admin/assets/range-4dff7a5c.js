import{bx as l,by as u}from"./index-a7efb343.js";var c=Math.ceil,g=Math.max;function v(a,i,n,e){for(var o=-1,r=g(c((i-a)/(n||1)),0),f=Array(r);r--;)f[e?r:++o]=a,a+=n;return f}function x(a){return function(i,n,e){return e&&typeof e!="number"&&l(i,n,e)&&(n=e=void 0),i=u(i),n===void 0?(n=i,i=0):n=u(n),e=e===void 0?i<n?1:-1:u(e),v(i,n,e,a)}}var b=x();const m=b;export{m as r};