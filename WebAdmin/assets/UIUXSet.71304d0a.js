import{d as g,r as i,l as B,o as a,c as u,F as v,i as U,w as m,v as w,u as h,a as s,m as k,t as b,n as y,q as f,j as V,h as C}from"./index.6613c40e.js";const $=["value"],E=s("div",{class:"dot circle"},null,-1),L={class:"text"},S=["value"],I=s("div",{class:"dot"},null,-1),N={class:"text"},A={key:2,class:"switchInput",title:""},D=s("div",{class:"dot"},null,-1),F=s("span",{class:"text"},null,-1),M=g({__name:"el-check",props:{type:null,list:null,modelValue:null},emits:["update:modelValue"],setup(x,{emit:r}){const n=x,d=i(n.type),c=i(n.list),t=B({get(){return n.modelValue},set(p){r("update:modelValue",p)}});return(p,e)=>(a(),u(v,null,[d.value=="radio"?(a(!0),u(v,{key:0},U(c.value,(l,o)=>(a(),u("label",{class:"checkBox radio",key:"radio_"+o},[m(s("input",{type:"radio",class:"input hide",value:l.value,"onUpdate:modelValue":e[0]||(e[0]=_=>k(t)?t.value=_:null)},null,8,$),[[w,h(t)]]),E,s("span",L,b(l.text),1)]))),128)):y("",!0),d.value=="check"?(a(!0),u(v,{key:1},U(c.value,(l,o)=>(a(),u("label",{class:"checkBox",key:"check_"+o},[m(s("input",{type:"checkbox",class:"input hide",value:l.value,"onUpdate:modelValue":e[1]||(e[1]=_=>k(t)?t.value=_:null)},null,8,S),[[f,h(t)]]),I,s("span",N,b(l.text),1)]))),128)):y("",!0),d.value=="switch"?(a(),u("label",A,[m(s("input",{type:"checkbox",class:"input hide","onUpdate:modelValue":e[2]||(e[2]=l=>k(t)?t.value=l:null)},null,512),[[f,h(t)]]),D,F])):y("",!0)],64))}});const R={class:"uisBlock"},X={class:"bar"},j={class:"bar"},z=g({__name:"UIUXSet",setup(x){const r=C(),n=i(""),d=i([]),c=i(!1),t=[{text:"\u5404\u7A2E\u6587\u5B57\u6E2C\u8A66",value:"1"},{text:"Obgpiz013259",value:"2"},{text:'!@#$%^&*?><+*/([".{|}])`',value:"3"}];return r.commit("route/endLoading"),(p,e)=>{const l=M;return a(),u("div",R,[s("div",X,[V(l,{type:"radio",list:t,modelValue:n.value,"onUpdate:modelValue":e[0]||(e[0]=o=>n.value=o)},null,8,["modelValue"])]),s("div",j,[V(l,{type:"check",list:t,modelValue:d.value,"onUpdate:modelValue":e[1]||(e[1]=o=>d.value=o)},null,8,["modelValue"])]),V(l,{type:"switch",modelValue:c.value,"onUpdate:modelValue":e[2]||(e[2]=o=>c.value=o)},null,8,["modelValue"])])}}});export{z as default};
