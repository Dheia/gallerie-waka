import{s as c,c as p,w as d,x as s,o as _,a as t,b as r,g as h,t as m,f as k}from"./app-6dd79a14.js";import{_ as C}from"./AppLayout-56a3e38f.js";import I from"./EditCreate-da4d99ac.js";import{_ as E,P as D,T,a as N,B}from"./WkNotification-54011fd0.js";import{d as O}from"./vuedraggable.umd-be941b8f.js";import{_ as P}from"./_plugin-vue_export-helper-c27b6911.js";import"./Form-29228b3f.js";import"./default.css_vue_type_style_index_0_src_true_lang-07719871.js";import"./SvgLoading-57eb599c.js";import"./vue.runtime.esm-bundler-5c94f924.js";const W={props:["tableauTags"],components:{AppLayout:C,EditCreate:I,WkNotification:E,PlusIcon:D,TrashIcon:T,PencilIcon:N,Bars2Icon:B,draggable:O},data(){return{isFormOpen:!1,isFormEdit:!1,formData:{},isWorking:!1,drag:!1,modalTitle:"Modification tag"}},methods:{closeForm(){this.isFormOpen=!1,this.isFormEdit=!1},async editForm(e){this.isFormOpen=!1,this.isFormEdit=!1,this.formData={};let o=await c.get("/bo/tableautags/"+e);this.formData=o.data,this.isFormOpen=!0,this.isFormEdit=!0},async createForm(){this.isFormOpen=!1,this.isFormEdit=!1,this.formData={};let e=await c.get("/bo/tableauxtags/create");console.log(e.data),this.formData=e.data,this.isFormOpen=!0},deleteItem(e){window.confirm("are you sure?")&&this.$inertia.delete(`/bo/tableautags/${e.id}`,{preserveScroll:!0})},onEndReorder(e){let o={order:this.tableauTags.data.map(({id:n})=>n)};c.post("/bo/tableautags/neworder",o,{preserveScroll:!0})}}},L={class:"flex items-center justify-between"},V=t("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"},"Les Tags de tableaux",-1),j=t("span",null,"Nouveau Tag de tableau",-1),A={class:"p-4"},S={class:"mx-auto sm:px-6"},$={class:"pt-2 lg:pt-12 flex flex-wrap"},R={class:"w-full lg:w-1/3 max-h-[200px] lg:max-h-[600px] overflow-y-auto"},M={class:"border border-gray-400 flex w-full items-center text-gray-500 bg-white text-sm hover:bg-gray-100 focus-within:bg-gray-100"},q={class:"py-3 px-6 flex-1 whitespace-nowrap"},z=t("br",null,null,-1),G={class:"text-xs"},H={class:"py-3 px-6 w-32 flex justify-end"},J={class:"bg-green-500 w-6 h-6 text-xs mx-2 rounded-full flex items-center"},K={class:"w-full text-center text-white"},Q={class:"w-full lg:w-2/3 px-2 py-6 lg:py-0"};function U(e,o,n,X,l,i){const u=s("PlusIcon"),f=s("WkNotification"),g=s("Bars2Icon"),x=s("PencilIcon"),b=s("TrashIcon"),w=s("draggable"),y=s("EditCreate"),F=s("AppLayout");return _(),p(F,{title:"Dashboard"},{header:d(()=>[t("div",L,[V,t("div",null,[t("button",{class:"btn btn-primary btn-inline",onClick:o[0]||(o[0]=a=>i.createForm())},[j,r(u,{class:"ml-2 -mr-1 h-8 w-8"})])])])]),default:d(()=>[t("div",A,[r(f,{message:e.$page.props.flash.message},null,8,["message"]),t("div",S,[t("div",$,[t("div",R,[r(w,{list:n.tableauTags.data,"item-key":"order_column",handle:".handle",onChange:i.onEndReorder},{item:d(({element:a})=>[t("ul",M,[r(g,{class:"w-6 h-6 handle cursor-pointer"}),t("li",q,[h(" Nom : "+m(a.name),1),z,h("slug: "),t("i",G,m(a.slug),1)]),t("li",H,[r(x,{class:"w-6 h-6 cursor-pointer hover:stroke-black",onClick:v=>i.editForm(a.id)},null,8,["onClick"]),t("div",J,[t("div",K,m(a.count),1)]),r(b,{class:"w-6 h-6 cursor-pointer hover:stroke-red-600",onClick:v=>i.deleteItem(a)},null,8,["onClick"])])])]),_:1},8,["list","onChange"])]),t("div",Q,[l.isFormOpen?(_(),p(y,{key:0,class:"bg-white rounded shadow-sm p-2",isEdit:l.isFormEdit,formData:l.formData,onWakaFormClose:i.closeForm},null,8,["isEdit","formData","onWakaFormClose"])):k("",!0)])])])])]),_:1})}const lt=P(W,[["render",U]]);export{lt as default};