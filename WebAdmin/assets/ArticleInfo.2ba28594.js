import{_ as u,o as s,c as t,a as i,F as r,i as o,t as l,H as g,s as $,E as v}from"./index.6613c40e.js";const w={name:"elGridTable",props:{value:{}},data:function(){return{header:[],list:{}}},mounted(){this.list=JSON.parse(JSON.stringify(this.value));for(const e in this.list)this.header.push(e)},watch:{value:{handler:function(e){this.list=JSON.parse(JSON.stringify(e))},deep:!0}}};const y={class:"gridList",role:"table"},k={class:"gridBlock"},B={class:"value"};function I(e,_,p,h,f,d){return s(),t("section",y,[i("header",k,[(s(!0),t(r,null,o(e.header,(a,n)=>(s(),t("div",{class:"gridBox",key:a+"_"+n},l(a),1))),128))]),(s(!0),t(r,null,o(e.list,(a,n)=>(s(),t("div",{class:"gridBlock",key:"item_"+n},[(s(!0),t(r,null,o(a,(c,m)=>(s(),t("div",{class:g(["gridBox",m]),key:c},[i("span",B,l(c),1)],2))),128))]))),128))])}const N=u(w,[["render",I],["__scopeId","data-v-6dfdf805"]]),S={data(){return{list:{},number:[1,2,3]}},components:{elTable:N},mounted(){$("/api/news/list").then(e=>{console.log(e)})},methods:{},computed:{...v(["userData","pageData"]),newsId(){return this.$route.params.newsId}}},b={class:"NewsInfo"};function x(e,_,p,h,f,d){return s(),t("div",b,[i("h1",null,"Here show the news"+l(d.newsId)+"'s information .",1)])}const J=u(S,[["render",x]]);export{J as default};
