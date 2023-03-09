import{a4 as I,U as D,F as H,Y as M,V as C,q as U,S as E,d as N,k as R,R as _}from"./app-711370a3.js";function O(e,t,...n){if(e in t){let o=t[e];return typeof o=="function"?o(...n):o}let r=new Error(`Tried to handle "${e}" but there is no handler defined. Only defined handlers are: ${Object.keys(t).map(o=>`"${o}"`).join(", ")}.`);throw Error.captureStackTrace&&Error.captureStackTrace(r,O),r}var W=(e=>(e[e.None=0]="None",e[e.RenderStrategy=1]="RenderStrategy",e[e.Static=2]="Static",e))(W||{}),B=(e=>(e[e.Unmount=0]="Unmount",e[e.Hidden=1]="Hidden",e))(B||{});function G({visible:e=!0,features:t=0,ourProps:n,theirProps:r,...o}){var i;let a=j(r,n),l=Object.assign(o,{props:a});if(e||t&2&&a.static)return b(l);if(t&1){let v=(i=a.unmount)==null||i?0:1;return O(v,{[0](){return null},[1](){return b({...o,props:{...a,hidden:!0,style:{display:"none"}}})}})}return b(l)}function b({props:e,attrs:t,slots:n,slot:r,name:o}){var i,a;let{as:l,...v}=q(e,["unmount","static"]),u=(i=n.default)==null?void 0:i.call(n,r),s={};if(r){let p=!1,m=[];for(let[d,c]of Object.entries(r))typeof c=="boolean"&&(p=!0),c===!0&&m.push(d);p&&(s["data-headlessui-state"]=m.join(" "))}if(l==="template"){if(u=A(u??[]),Object.keys(v).length>0||Object.keys(t).length>0){let[p,...m]=u??[];if(!V(p)||m.length>0)throw new Error(['Passing props on "template"!',"",`The current component <${o} /> is rendering a "template".`,"However we need to passthrough the following props:",Object.keys(v).concat(Object.keys(t)).map(f=>f.trim()).filter((f,w,L)=>L.indexOf(f)===w).sort((f,w)=>f.localeCompare(w)).map(f=>`  - ${f}`).join(`
`),"","You can apply a few solutions:",['Add an `as="..."` prop, to ensure that we render an actual element instead of a "template".',"Render a single element as the child so that we can forward the props onto that element."].map(f=>`  - ${f}`).join(`
`)].join(`
`));let d=j((a=p.props)!=null?a:{},v),c=I(p,d);for(let f in d)f.startsWith("on")&&(c.props||(c.props={}),c.props[f]=d[f]);return c}return Array.isArray(u)&&u.length===1?u[0]:u}return D(l,Object.assign({},v,s),{default:()=>u})}function A(e){return e.flatMap(t=>t.type===H?A(t.children):[t])}function j(...e){if(e.length===0)return{};if(e.length===1)return e[0];let t={},n={};for(let r of e)for(let o in r)o.startsWith("on")&&typeof r[o]=="function"?(n[o]!=null||(n[o]=[]),n[o].push(r[o])):t[o]=r[o];if(t.disabled||t["aria-disabled"])return Object.assign(t,Object.fromEntries(Object.keys(n).map(r=>[r,void 0])));for(let r in n)Object.assign(t,{[r](o,...i){let a=n[r];for(let l of a){if(o instanceof Event&&o.defaultPrevented)return;l(o,...i)}}});return t}function q(e,t=[]){let n=Object.assign({},e);for(let r of t)r in n&&delete n[r];return n}function V(e){return e==null?!1:typeof e.type=="string"||typeof e.type=="object"||typeof e.type=="function"}let X=0;function Y(){return++X}function pe(){return Y()}var K=(e=>(e.Space=" ",e.Enter="Enter",e.Escape="Escape",e.Backspace="Backspace",e.Delete="Delete",e.ArrowLeft="ArrowLeft",e.ArrowUp="ArrowUp",e.ArrowRight="ArrowRight",e.ArrowDown="ArrowDown",e.Home="Home",e.End="End",e.PageUp="PageUp",e.PageDown="PageDown",e.Tab="Tab",e))(K||{});function x(e){var t;return e==null||e.value==null?null:(t=e.value.$el)!=null?t:e.value}let $=Symbol("Context");var z=(e=>(e[e.Open=1]="Open",e[e.Closed=2]="Closed",e[e.Closing=4]="Closing",e[e.Opening=8]="Opening",e))(z||{});function ve(){return J()!==null}function J(){return M($,null)}function me(e){C($,e)}var Q=Object.defineProperty,Z=(e,t,n)=>t in e?Q(e,t,{enumerable:!0,configurable:!0,writable:!0,value:n}):e[t]=n,S=(e,t,n)=>(Z(e,typeof t!="symbol"?t+"":t,n),n);class ee{constructor(){S(this,"current",this.detect()),S(this,"currentId",0)}set(t){this.current!==t&&(this.currentId=0,this.current=t)}reset(){this.set(this.detect())}nextId(){return++this.currentId}get isServer(){return this.current==="server"}get isClient(){return this.current==="client"}detect(){return typeof window>"u"||typeof document>"u"?"server":"client"}}let h=new ee;function P(e){if(h.isServer)return null;if(e instanceof Node)return e.ownerDocument;if(e!=null&&e.hasOwnProperty("value")){let t=x(e);if(t)return t.ownerDocument}return document}let g=["[contentEditable=true]","[tabindex]","a[href]","area[href]","button:not([disabled])","iframe","input:not([disabled])","select:not([disabled])","textarea:not([disabled])"].map(e=>`${e}:not([tabindex='-1'])`).join(",");var te=(e=>(e[e.First=1]="First",e[e.Previous=2]="Previous",e[e.Next=4]="Next",e[e.Last=8]="Last",e[e.WrapAround=16]="WrapAround",e[e.NoScroll=32]="NoScroll",e))(te||{}),ne=(e=>(e[e.Error=0]="Error",e[e.Overflow=1]="Overflow",e[e.Success=2]="Success",e[e.Underflow=3]="Underflow",e))(ne||{}),re=(e=>(e[e.Previous=-1]="Previous",e[e.Next=1]="Next",e))(re||{});function F(e=document.body){return e==null?[]:Array.from(e.querySelectorAll(g)).sort((t,n)=>Math.sign((t.tabIndex||Number.MAX_SAFE_INTEGER)-(n.tabIndex||Number.MAX_SAFE_INTEGER)))}var T=(e=>(e[e.Strict=0]="Strict",e[e.Loose=1]="Loose",e))(T||{});function k(e,t=0){var n;return e===((n=P(e))==null?void 0:n.body)?!1:O(t,{[0](){return e.matches(g)},[1](){let r=e;for(;r!==null;){if(r.matches(g))return!0;r=r.parentElement}return!1}})}function he(e){let t=P(e);U(()=>{t&&!k(t.activeElement,0)&&oe(e)})}function oe(e){e==null||e.focus({preventScroll:!0})}let ie=["textarea","input"].join(",");function le(e){var t,n;return(n=(t=e==null?void 0:e.matches)==null?void 0:t.call(e,ie))!=null?n:!1}function ae(e,t=n=>n){return e.slice().sort((n,r)=>{let o=t(n),i=t(r);if(o===null||i===null)return 0;let a=o.compareDocumentPosition(i);return a&Node.DOCUMENT_POSITION_FOLLOWING?-1:a&Node.DOCUMENT_POSITION_PRECEDING?1:0})}function we(e,t){return ue(F(),t,{relativeTo:e})}function ue(e,t,{sorted:n=!0,relativeTo:r=null,skipElements:o=[]}={}){var i;let a=(i=Array.isArray(e)?e.length>0?e[0].ownerDocument:document:e==null?void 0:e.ownerDocument)!=null?i:document,l=Array.isArray(e)?n?ae(e):e:F(e);o.length>0&&l.length>1&&(l=l.filter(c=>!o.includes(c))),r=r??a.activeElement;let v=(()=>{if(t&5)return 1;if(t&10)return-1;throw new Error("Missing Focus.First, Focus.Previous, Focus.Next or Focus.Last")})(),u=(()=>{if(t&1)return 0;if(t&2)return Math.max(0,l.indexOf(r))-1;if(t&4)return Math.max(0,l.indexOf(r))+1;if(t&8)return l.length-1;throw new Error("Missing Focus.First, Focus.Previous, Focus.Next or Focus.Last")})(),s=t&32?{preventScroll:!0}:{},p=0,m=l.length,d;do{if(p>=m||p+m<=0)return 0;let c=u+p;if(t&16)c=(c+m)%m;else{if(c<0)return 3;if(c>=m)return 1}d=l[c],d==null||d.focus(s),p+=v}while(d!==a.activeElement);return t&6&&le(d)&&d.select(),d.hasAttribute("tabindex")||d.setAttribute("tabindex","0"),2}function y(e,t,n){h.isServer||E(r=>{document.addEventListener(e,t,n),r(()=>document.removeEventListener(e,t,n))})}function be(e,t,n=R(()=>!0)){function r(i,a){if(!n.value||i.defaultPrevented)return;let l=a(i);if(l===null||!l.getRootNode().contains(l))return;let v=function u(s){return typeof s=="function"?u(s()):Array.isArray(s)||s instanceof Set?s:[s]}(e);for(let u of v){if(u===null)continue;let s=u instanceof HTMLElement?u:x(u);if(s!=null&&s.contains(l)||i.composed&&i.composedPath().includes(s))return}return!k(l,T.Loose)&&l.tabIndex!==-1&&i.preventDefault(),t(i,l)}let o=N(null);y("mousedown",i=>{var a,l;n.value&&(o.value=((l=(a=i.composedPath)==null?void 0:a.call(i))==null?void 0:l[0])||i.target)},!0),y("click",i=>{o.value&&(r(i,()=>o.value),o.value=null)},!0),y("blur",i=>r(i,()=>window.document.activeElement instanceof HTMLIFrameElement?window.document.activeElement:null),!0)}var se=(e=>(e[e.None=1]="None",e[e.Focusable=2]="Focusable",e[e.Hidden=4]="Hidden",e))(se||{});let ye=_({name:"Hidden",props:{as:{type:[Object,String],default:"div"},features:{type:Number,default:1}},setup(e,{slots:t,attrs:n}){return()=>{let{features:r,...o}=e,i={"aria-hidden":(r&2)===2?!0:void 0,style:{position:"fixed",top:1,left:1,width:1,height:0,padding:0,margin:-1,overflow:"hidden",clip:"rect(0, 0, 0, 0)",whiteSpace:"nowrap",borderWidth:"0",...(r&4)===4&&(r&2)!==2&&{display:"none"}}};return G({ourProps:i,theirProps:o,slot:{},attrs:n,slots:t,name:"Hidden"})}}});function ce(e,t,n){h.isServer||E(r=>{window.addEventListener(e,t,n),r(()=>window.removeEventListener(e,t,n))})}var de=(e=>(e[e.Forwards=0]="Forwards",e[e.Backwards=1]="Backwards",e))(de||{});function ge(){let e=N(0);return ce("keydown",t=>{t.key==="Tab"&&(e.value=t.shiftKey?1:0)}),e}function Ee(e,t,n,r){h.isServer||E(o=>{e=e??window,e.addEventListener(t,n,r),o(()=>e.removeEventListener(t,n,r))})}export{ve as C,we as D,Ee as E,T as F,G as H,ae as I,W as N,ue as O,k as S,ne as T,se as a,K as b,me as c,F as d,te as e,ye as f,de as g,oe as h,B as i,h as j,q as k,z as l,P as m,ge as n,x as o,J as p,pe as t,O as u,he as v,be as y};