import{u as i,o as p,e as b,b as _,h as o,a as e,t as a,m as f,g as n,v as u,C as d,F as h}from"./app.5c792e26.js";import{T as x}from"./TopBanner.6ae00047.js";import"./ResponsiveNavLink.cb3437b6.js";import"./_plugin-vue_export-helper.cdc0426e.js";const y={class:"flex flex-wrap justify-center pt-4 bg-no-repeat bg-cover bg-banner"},g={class:"relative flex items-center justify-center h-0 w-72"},v={class:"text-center m-auto absolute w-full top-[85%]"},w={class:"text-[1.4em] text-[#715192] font-bold"},C=e("br",null,null,-1),q={class:"flex justify-center pt-4 my-10"},I=["onSubmit"],N=e("label",{class:"text-[1.4em] text-[#715192] font-bold mb-20"},"Amount",-1),B=e("br",null,null,-1),S=e("label",{class:"text-[1.4em] text-[#715192] font-bold mb-20"},"Reference",-1),j=e("br",null,null,-1),V=e("label",{class:"text-[1.4em] text-[#715192] font-bold mb-20"},"Card Number",-1),G=e("br",null,null,-1),T=e("input",{type:"text",class:"w-full px-3 py-2 border-none rounded bg-slate-100 bg-formInputGray",placeholder:"Card Number",required:"",name:"cardNumber"},null,-1),U=e("label",{class:"text-[1.4em] text-[#715192] font-bold mb-20"},"Sort Code",-1),k=e("br",null,null,-1),D=e("input",{type:"text",class:"w-full px-3 py-2 border-none rounded bg-slate-100 bg-formInputGray",placeholder:"Card Number",required:"",name:"sortCode"},null,-1),F=e("div",{class:"my-6 md:flex md:items-center"},[e("button",{type:"submit",class:"w-40 h-10 text-center text-white rounded-full cursor-pointer",style:{backgroundColor:"#715191"}}," Create ")],-1),R={__name:"Create",props:{pot:{type:Object,required:!1},base_url:{type:String,required:!1},user:{type:Object,required:!1},method:{type:String,required:!1}},setup(c){const t=c,s=i({amount:"",reference:"",pot:t.pot,method:t.method}),m=()=>{s.post(`/pots/${t.pot.id}/contributions/${t.method}`)};return(O,r)=>(p(),b(h,null,[_(x,{showImages:!1,customImageUrl:o(t).base_url+"/"+o(t).pot.cover_photo_path,borderColour:"#DE85BB"},null,8,["customImageUrl"]),e("div",y,[e("div",g,[e("div",v,[e("h1",w,"Create a "+a(o(t).method)+" transaction for "+a(o(t).pot.name)+" pot",1)])])]),C,e("div",q,[e("form",{onSubmit:f(m,["prevent"]),class:"mx-2"},[N,n(),B,u(e("input",{"onUpdate:modelValue":r[0]||(r[0]=l=>o(s).amount=l),type:"number",step:"0.01",class:"w-full px-3 py-2 border-none rounded bg-slate-100 bg-formInputGray",min:"0",max:"1000000",required:"",placeholder:"Amount",name:"amount"},null,512),[[d,o(s).amount]]),S,n(),j,u(e("input",{"onUpdate:modelValue":r[1]||(r[1]=l=>o(s).reference=l),type:"text",class:"w-full px-3 py-2 border-none rounded bg-slate-100 bg-formInputGray",placeholder:"Optional reference",name:"reference"},null,512),[[d,o(s).reference]]),V,n(),G,T,U,n(),k,D,F],40,I)])],64))}};export{R as default};