import{d as s,B as l,o as n,e as c}from"./app-079da73b.js";const d=["value","rows"],f={__name:"TextArea",props:{modelValue:String,rows:{type:Number,default:5}},emits:["update:modelValue"],setup(o,{expose:u}){const e=s(null);return l(()=>{e.value.hasAttribute("autofocus")&&e.value.focus()}),u({focus:()=>e.value.focus()}),(a,t)=>(n(),c("textarea",{ref_key:"input",ref:e,class:"border-gray-300 focus:border-indigo-300 focus:ring focus:ring-accent-light focus:ring-opacity-50 rounded-md shadow-sm",value:o.modelValue,rows:o.rows,onInput:t[0]||(t[0]=r=>a.$emit("update:modelValue",r.target.value))},null,40,d))}};export{f as _};