import{d as l,o as a,c as s,a as u,t as h,n as k}from"./index.1221ef5d.js";const p={class:"labInput"},_=["checked"],r={key:0,class:"text"},x=l({__name:"el-checkBox",props:{checked:{type:Boolean,default:!1},text:{default:""}},emits:["change","update:checked"],setup(t,{emit:n}){const o=c=>{const e=c.target;n("update:checked",e.checked)};return(c,e)=>(a(),s("label",p,[u("input",{class:"input",type:"checkbox",checked:t.checked,onChange:e[0]||(e[0]=d=>o(d))},null,40,_),t.text?(a(),s("span",r,h(t.text),1)):k("",!0)]))}});export{x as _};
