import{_ as F}from"./AppLayout-f047be12.js";import{F as v,_ as w,r as y,a as $,b as j}from"./OutlineBtnDanger-ebe0112d.js";import C from"./Form-9dd830c3.js";import{_ as f}from"./_plugin-vue_export-helper-c27b6911.js";import{o as n,e as c,a as t,t as h,r as W,P as l,c as I,w as d,N as o,b as a,h as B,F as N}from"./app-c8adfab2.js";import{_ as P,a as S}from"./OutlineBtn-a00a548b.js";import{r as L,d as M}from"./vuedraggable.umd-fca62302.js";import"./createPopper-9bf0707f.js";import"./TextInput-116a31b4.js";import"./InputLabel-5206ffca.js";import"./SvgLoading-aea3ca2c.js";import"./WinputFile-016a6ba5.js";import"./default.css_vue_type_style_index_0_src_true_lang-d7fdadac.js";import"./vue.runtime.esm-bundler-5f44da9d.js";const T={props:{isOpen:Boolean,contentTitle:String,panelClass:{type:String,default:"max-w-2xl"}},components:{}},E={key:0,class:"w-full bg-white"},A={class:"text-xl font-bold p-2"},D={key:1,class:"w-full flex items-center min-h-[150px]"},V=t("div",{class:"text-xl font-bold p-2 w-full text-center"},"Choisissez une page à éditer",-1),z=[V];function q(s,p,i,g,e,r){return i.isOpen?(n(),c("div",E,[t("div",A,h(i.contentTitle),1),W(s.$slots,"default")])):(n(),c("div",D,z))}const G=f(T,[["render",q]]),_=l({name:"",slug:"",title:"",contenu:"",image:null}),H=l({redirect:"",image:!1,contentMode:""}),J={props:["pages"],components:{AppLayout:F,Table:v,WkNotification:P,OutlineBtn:S,OutlineBtnDanger:w,PlusIcon:y,TrashIcon:$,PencilIcon:j,Bars2Icon:L,draggable:M,Content:G,Form:C},data(){return{isFormOpen:!1,isFormEdit:!1,formObject:_,isWorking:!1,staticOptions:{}}},methods:{saveItem(s){this.isWorking=!0,console.log(this.formObject);let p={onSuccess:()=>{this.formObject.reset("name","slug","title","content","image"),this.closeModal(),this.isWorking=!1},onError:()=>{this.isWorking=!1}};s.id&&(console.log(this.formObject),console.log(s.id),this.formObject.put(`pages/${s.id}`,p))},closeModal(){this.isFormOpen=!1,this.isFormEdit=!1},openForm(s){this.isFormOpen=!0,this.formObject=s?l(s):_,this.staticOptions=s?l(s.staticOptions):H,console.log(this.formObject.slug)}}},K=t("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Les Pages ",-1),Q={class:"py-12"},R={class:"p-1 max-w-7xl mx-auto"},U={class:"pt-12 grid grid-cols-4 gap-x-2"},X={class:"col-span-1 p-2"},Y={class:"border border-gray-400 inline-flex w-full items-center text-gray-500 bg-white whitespace-nowrap text-sm hover:bg-gray-100 focus-within:bg-gray-100"},Z={class:"py-3 px-6 w-3/6"},ss={class:"py-3 px-6 w-2/6 flex justify-end"},ts={class:"col-span-3 w-full p-1"},es={class:"border border-dashed"};function os(s,p,i,g,e,r){const u=o("WkNotification"),x=o("PencilIcon"),O=o("Form"),b=o("Content"),k=o("AppLayout");return n(),I(k,{title:"Dashboard"},{header:d(()=>[K]),default:d(()=>[t("div",Q,[a(u,{message:s.$page.props.flash.message},null,8,["message"]),t("div",R,[t("div",U,[t("div",X,[(n(!0),c(N,null,B(i.pages,m=>(n(),c("div",{key:m.id},[t("ul",Y,[t("li",Z,h(m.name),1),t("li",ss,[a(x,{class:"w-6 h-6 cursor-pointer hover:stroke-black",onClick:ns=>r.openForm(m)},null,8,["onClick"])])])]))),128))]),t("div",ts,[t("div",es,[a(b,{isOpen:e.isFormOpen,contentTitle:"Modifier la page",panelClass:"max-w-4xl"},{default:d(()=>[a(O,{form:e.formObject,staticOptions:e.staticOptions,isWorking:e.isWorking,onFormsave:r.saveItem,onFormclose:r.closeModal},null,8,["form","staticOptions","isWorking","onFormsave","onFormclose"])]),_:1},8,["isOpen"])])])])])])]),_:1})}const Os=f(J,[["render",os]]);export{Os as default};