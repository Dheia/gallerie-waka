import{w as l}from"./Form-c12b430f.js";import{_ as t}from"./_plugin-vue_export-helper-c27b6911.js";import{e as s,b as m,w as n,n as c,x as f,o as i}from"./app-079da73b.js";import"./default.css_vue_type_style_index_0_src_true_lang-7f3189f3.js";const u={components:{wakaForm:l},data(){return{config:{form:{url:"/bo/mycontroller{id}",formClass:"flex flex-wrap"},fields:{name:{type:"label",label:"Nom",required:!0,class:"w-full md:w-1/2"},slug:{type:"label",label:"slug",required:!0,class:"w-full md:w-1/2"},text:{type:"richeditor",label:"contenu"},image:{type:"fileuploader",label:"Charger une image"}}},formData:{name:"Hello World",slug:"hello-world",text:"<p>Bonjour à tous</p>"}}},methods:{submitForm(o){}}};function p(o,d,b,w,e,r){const a=f("wakaForm");return i(),s("div",null,[m(a,{class:c(e.config.form.formClass),config:e.config,formData:e.formData,onSubmit:r.submitForm},{"label-name":n(()=>[]),_:1},8,["class","config","formData","onSubmit"])])}const C=t(u,[["render",p]]);export{C as default};
