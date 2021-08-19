/*! For license information please see main.9db827f7.chunk.js.LICENSE.txt */
(this["webpackJsonplevelup-budgeting"]=this["webpackJsonplevelup-budgeting"]||[]).push([[0],{55:function(e,a,t){},56:function(e,a,t){},57:function(e,a,t){"use strict";t.r(a);var n=t(1),c=t.n(n),s=t(23),l=t.n(s),r=t(5),o=t(2),i=t(4),u=t.n(i),d=t(8),b=t(3),j=t(0),m=function(e){var a=Object(n.useState)(!0),t=Object(b.a)(a,2),c=t[0],s=t[1];return Object(j.jsx)("nav",{className:"navbar navbar-expand-sm navbar-light bg-light",children:Object(j.jsxs)("div",{className:"container-fluid",children:[Object(j.jsx)(r.a,{to:"/",className:"navbar-brand",children:"Budgeting"}),Object(j.jsx)("button",{className:"navbar-toggler",onClick:function(){return s(!c)},children:Object(j.jsx)("span",{className:"navbar-toggler-icon"})}),Object(j.jsxs)("div",{className:"navbar-collapse justify-content-between "+(c?"collapse":"collapsed"),children:[Object(j.jsx)("ul",{className:"navbar-nav",children:Object(j.jsx)("li",{className:"nav-item",children:Object(j.jsx)(r.a,{to:"/",className:"nav-link active",children:"Home"})})}),Object(j.jsx)("ul",{className:"navbar-nav",children:Object(j.jsx)("li",{className:"nav-item",children:Object(j.jsx)(r.a,{to:"/",className:"nav-link",children:"Logout"})})})]})]})})},h=t(10),p=t.n(h),O=function(e){return Object(j.jsx)("footer",{className:"footer",children:Object(j.jsx)("div",{className:"container-fluid",children:Object(j.jsx)(r.a,{to:"/",className:"navbar-brand",children:"Budgeting"})})})},v=function(e){var a=e.props,t=e.showPercent,n=a.percentage?a.percentage:"";return Object(j.jsxs)("div",{className:"circle-graph",children:[Object(j.jsxs)("div",{className:"circle "+function(){if(a.goal){if(n>=100)return"c100";if(n>=80)return"c80";if(n>=60)return"c60";if(n>=40)return"c40";if(n>=20)return"c20";if(n>=0)return"c0"}}(),style:function(){if(a.goal)return{backgroundImage:"conic-gradient(#eae9e9 ".concat(n=100-n,"%, transparent 0)")}}(),children:[Object(j.jsx)("div",{className:"mobile-line",style:{width:n+"%"}}),a.goal?Object(j.jsxs)("div",{className:"amount",children:[Object(j.jsxs)("h3",{children:["$",a.total]}),Object(j.jsxs)("small",{children:["of ",Object(j.jsxs)("b",{children:["$",a.goal]})," reached"]})]}):Object(j.jsxs)("h3",{className:"amount",children:["$",a.total]})]}),t&&a.percentage>0&&Object(j.jsx)("div",{className:"text-center mt-3",children:Object(j.jsxs)("h4",{children:[Math.round(a.percentage),"% complete"]})})]})},f=t(7),g=function(e){var a=e.text,t=e.className,n=e.action,c=e.children,s=Object(f.a)(e,["text","className","action","children"]);return Object(j.jsxs)("button",Object(o.a)(Object(o.a)({},s),{},{className:"btn "+(t||t),onClick:function(e){return function(e){e.preventDefault(),n(e)}(e)},children:[a,c]}))},x=function(e){var a=e.props,t=e.tagClick;return Object(j.jsxs)("div",{className:"card",children:[Object(j.jsx)(g,{className:"tag",action:function(){return t(a.tag.name)},children:Object(j.jsx)("span",{className:"badge bg-"+a.tag.color,children:a.tag.name})}),Object(j.jsx)(v,{props:a.values}),Object(j.jsxs)("div",{className:"card-body",children:[Object(j.jsx)("h5",{className:"card-title",children:a.name}),Object(j.jsx)("p",{className:"card-text",children:a.desc}),Object(j.jsx)(r.a,{to:"/envelope/"+a.id,className:"btn btn-light float-end",children:"Manage"})]})]})},N=t(9),w=t.n(N);w.a.defaults.baseURL=Object({NODE_ENV:"production",PUBLIC_URL:"",WDS_SOCKET_HOST:void 0,WDS_SOCKET_PATH:void 0,WDS_SOCKET_PORT:void 0,FAST_REFRESH:!0}).REACT_APP_API,w.a.interceptors.response.use(null,(function(e){if(e.response&&e.response.status>=400&&e.response.status<500){if(401===e.response.status&&console.log(e.response.data),e.response.data){var a=e.response.data.error;console.error(a.message)}console.error(e.response.message)}return Promise.reject(e)}));var C={get:w.a.get,post:w.a.post,put:w.a.put,delete:w.a.delete,setJwt:function(e){w.a.defaults.headers.common["X-Auth-Token"]=e}};function y(){return k.apply(this,arguments)}function k(){return(k=Object(d.a)(u.a.mark((function e(){var a,t,n=arguments;return u.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return n.length>0&&void 0!==n[0]?n[0]:null,e.prev=1,e.next=4,C.get("auth/index.php",{request:"token"});case 4:a=e.sent,t=a.data,console.log(t),e.next=12;break;case 9:e.prev=9,e.t0=e.catch(1),console.log(e.t0);case 12:case"end":return e.stop()}}),e,null,[[1,9]])})))).apply(this,arguments)}var S=function(){var e=Object(d.a)(u.a.mark((function e(a,t){return u.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(e.prev=0,!t){e.next=5;break}return e.abrupt("return",y().then((function(){return C.get("get/".concat(a,".php"),{params:t})})).catch((function(e){if("Token is not valid!"!==e.response.data.error.message)return console.log(e.response),{data:{error:e}};y(!0),window.location.reload()})));case 5:return e.abrupt("return",y().then((function(){return C.get("get/".concat(a,".php"))})).catch((function(e){if("Token is not valid!"!==e.response.data.error.message)return console.log(e.response),{data:{error:e}};y(!0),window.location.reload()})));case 6:e.next=12;break;case 8:return e.prev=8,e.t0=e.catch(0),console.log(e.t0),e.abrupt("return",{});case 12:case"end":return e.stop()}}),e,null,[[0,8]])})));return function(a,t){return e.apply(this,arguments)}}(),E=function(){var e=Object(d.a)(u.a.mark((function e(a){var t;return u.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,S("get/index.php",{request:"all",owner:"tw-854334"});case 3:return(t=e.sent)&&!t.success&&!t.error&&console.log(t),e.abrupt("return",t);case 8:return e.prev=8,e.t0=e.catch(0),console.log(e.t0),e.abrupt("return",{});case 12:case"end":return e.stop()}}),e,null,[[0,8]])})));return function(a){return e.apply(this,arguments)}}(),F=function(e){var a=Object(n.useState)([{id:1,name:"Emergency Savings",account:"HY Savings",desc:"Buffer fund",tag:{name:"Savings",color:"warning"},values:{goal:12687,total:10724.73,percentage:85}},{id:2,name:"Dining Out",account:"General Spending",desc:"Money for eating out",tag:{name:"Food",color:"success"},values:{goal:null,total:120}},{id:3,name:"Groceries",account:"General Spending",desc:"Money for grocery spending",tag:{name:"Food",color:"success"},values:{goal:null,total:280.19}},{id:4,name:"Kids",account:"General Spending",desc:"Kid related purchases",tag:{name:"Kids",color:"info"},values:{goal:null,total:30}}]),t=Object(b.a)(a,2),c=t[0],s=(t[1],Object(n.useState)(null)),l=Object(b.a)(s,2),i=(l[0],l[1],Object(n.useState)(null)),h=Object(b.a)(i,2),v=h[0],f=h[1],N=Object(n.useState)(null),w=Object(b.a)(N,2),C=w[0],y=w[1],k=Object(n.useCallback)(function(){var e=Object(d.a)(u.a.mark((function e(a){return u.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.t0=console,e.next=3,E();case 3:e.t1=e.sent,e.t0.log.call(e.t0,e.t1),F(a);case 6:case"end":return e.stop()}}),e)})));return function(a){return e.apply(this,arguments)}}(),[]);Object(n.useEffect)((function(){k(c)}),[c,k]);var S=function(e){var a={};Object.values(e).forEach((function(e){a.tag=e.tag,a.total=a.total?a.total+e.values.total:e.values.total})),y(Object(o.a)({},a))},F=function(e){f(Object.values(e).map((function(e){return Object(j.jsx)(x,{props:e,tagClick:function(e){return function(e){var a=Object.values(c).filter((function(a){return a.tag.name===e}));k(a),S(a)}(e)}},e.id)})))};return Object(j.jsxs)(j.Fragment,{children:[Object(j.jsx)(m,{}),Object(j.jsx)("section",{children:Object(j.jsxs)("div",{className:"container",children:[Object(j.jsxs)("div",{className:"flex-wrapper",children:[Object(j.jsx)("h1",{children:"Envelopes"}),Object(j.jsx)(r.a,{className:"btn btn-light btn-add",title:"Add envelope",to:"/envelope/new/",children:"+"})]}),Object(j.jsx)("hr",{}),C&&Object(j.jsxs)("div",{className:"flex-wrapper m-space mb-3",children:[Object(j.jsx)("div",{className:"info-tag badge bg-"+C.tag.color,children:C.tag.name}),Object(j.jsxs)("div",{className:"info-tag badge total",children:["Total $",C.total]}),Object(j.jsx)(g,{className:"btn-close info-tag badge",action:function(){return k(c),void y(null)}})]}),Object(j.jsx)("div",{className:"flex-wrapper",children:!p.a.isEmpty(v)&&v})]})}),Object(j.jsx)(O,{})]})},T=function(e){return Object(j.jsx)(j.Fragment,{children:Object(j.jsx)("section",{children:Object(j.jsx)("h1",{children:"Login page"})})})},D=function(e,a){if(!isNaN(e%1))return e=e.length>a.length?e.length<2?parseFloat(e/100).toFixed(2):(10*Number(e)).toFixed(2):(Number(e)/10).toFixed(2)},B={sourceDefault:"credit",sources:[{name:"Credit",value:"credit"},{name:"Bank",value:"bank"},{name:"Cash",value:"cash"}],tagOptions:[{name:"blue",value:"primary"},{name:"grey",value:"secondary"},{name:"green",value:"success"},{name:"red",value:"danger"},{name:"yellow",value:"warning"},{name:"teal",value:"info"},{name:"black",value:"dark"}],newEnvelope:{id:null,name:"",account:"",desc:"",tag:{name:"",color:"primary"},defaultSource:"",values:{goal:"",total:"",percentage:""}}},H=function(e){var a=e.name,t=e.type,n=void 0===t?"text":t,c=e.label,s=e.help,l=e.value,r=e.placeholder,i=e.disabled,u=void 0!==i&&i,d=e.className,b=e.onChange,m=e.required,h=e.error,p=Object(f.a)(e,["name","type","label","help","value","placeholder","disabled","className","onChange","required","error"]);return Object(j.jsxs)("div",{className:"mb-3",children:[Object(j.jsx)("label",{forhtml:a,className:"form-label "+(m?"required":""),children:c}),h&&Object(j.jsx)("span",{className:"error",children:"Required"}),Object(j.jsx)("input",Object(o.a)({type:n,name:a,id:a,value:u?"":l&&l,placeholder:r&&r,className:"form-control "+(d||d),"aria-describedby":a+"HelpBlock",onChange:function(e){return b(e.target)},disabled:u},p)),s&&Object(j.jsx)("div",{id:a+"HelpBlock",className:"form-text",children:s})]})},A=function(e){var a=e.name,t=e.label,n=e.help,c=(e.type,e.value),s=e.placeholder,l=e.adjustableClick,r=e.disabled,i=void 0!==r&&r,u=e.onChange,d=e.className,b=Object(f.a)(e,["name","label","help","type","value","placeholder","adjustableClick","disabled","onChange","className"]);return Object(j.jsxs)("div",{className:"mb-3",children:[Object(j.jsx)("label",{forhtml:a,className:"form-label",children:t}),Object(j.jsxs)("div",{className:"flex-wrapper m-space",children:[Object(j.jsx)("input",Object(o.a)({type:"text",name:a,id:a,value:i?"":c&&c,placeholder:s&&s,className:"form-control "+(d||d),"aria-describedby":a+"HelpBlock",onChange:function(e){return u(e.target)},disabled:i},b)),Object(j.jsx)(g,{text:"+",className:"btn btn-primary fg-1",action:function(){return l(!0)}}),Object(j.jsx)(g,{text:"\u2212",className:"btn btn-warning fg-1",action:function(){return l(!1)}})]}),n&&Object(j.jsx)("div",{id:a+"HelpBlock",className:"form-text",children:n})]})},P=function(e){var a=e.name,t=e.label,n=e.help,c=(e.type,e.value),s=e.placeholder,l=e.onChange,r=e.disabled,i=void 0!==r&&r,u=Object(f.a)(e,["name","label","help","type","value","placeholder","onChange","disabled"]);return Object(j.jsxs)("div",{className:"text-edit-wrapper",children:[t&&Object(j.jsx)("label",{forhtml:a,className:"form-label",children:t}),Object(j.jsx)("textarea",Object(o.a)({name:a,id:a,value:i?"":c&&c,placeholder:s&&s,className:"form-control","aria-describedby":a+"HelpBlock",onChange:function(e){return l(e.target)},disabled:i},u)),n&&Object(j.jsx)("div",{id:a+"HelpBlock",className:"form-text",children:n})]})},G=function(e){var a=e.name,t=e.type,n=void 0===t?"text":t,c=e.label,s=e.help,l=e.options,r=e.placeholder,i=e.disabled,u=void 0!==i&&i,d=e.className,b=e.onChange,m=e.defaultValue,h=Object(f.a)(e,["name","type","label","help","options","placeholder","disabled","className","onChange","defaultValue"]),p=function(e){b(e)};return Object(j.jsxs)("div",{className:"mb-3",children:[Object(j.jsx)("label",{forhtml:a,className:"form-label",children:c}),Object(j.jsx)("select",Object(o.a)(Object(o.a)({type:n,name:a,id:a,placeholder:r&&r,className:"form-select "+(d||d),"aria-describedby":a+"HelpBlock",onChange:function(e){return p(e.target)},defaultValue:m,disabled:u},h),{},{children:l&&Object.values(l).map((function(e){return e.override?e.value:Object(j.jsx)("option",{value:e.value,children:e.name},e.value)}))})),s&&Object(j.jsx)("div",{id:a+"HelpBlock",className:"form-text",children:s})]})},V=function(e){var a=e.name,t=e.type,c=void 0===t?"text":t,s=e.label,l=e.help,r=e.options,i=e.placeholder,u=e.disabled,d=void 0!==u&&u,m=e.className,h=e.onChange,p=e.defaultValue,O=Object(f.a)(e,["name","type","label","help","options","placeholder","disabled","className","onChange","defaultValue"]),v=Object(n.useState)(p),g=Object(b.a)(v,2),x=g[0],N=g[1],w=function(e){N(e.value),h(e)};return Object(j.jsxs)("div",{className:"mb-3",children:[Object(j.jsx)("label",{forhtml:a,className:"form-label",children:s}),Object(j.jsx)("select",Object(o.a)(Object(o.a)({type:c,name:a,id:a,placeholder:i&&i,className:"form-select color-select "+(x?"bg-"+x:"")+" "+(m||m),"aria-describedby":a+"HelpBlock",onChange:function(e){return w(e.target)},defaultValue:p,disabled:d},O),{},{children:r&&Object.values(r).map((function(e){return Object(j.jsx)("option",{value:e.value,children:e.name},e.value)}))})),l&&Object(j.jsx)("div",{id:a+"HelpBlock",className:"form-text",children:l})]})},_=function(e){var a=e.props;return Object(j.jsxs)("table",{className:"table table-striped table-hover",children:[Object(j.jsx)("thead",{children:Object(j.jsxs)("tr",{children:[Object(j.jsx)("th",{scope:"col",children:"Date"}),Object(j.jsx)("th",{scope:"col",children:"Amount"}),Object(j.jsx)("th",{scope:"col",children:"Source"})]})}),Object(j.jsx)("tbody",{children:a&&function(e){return Object.values(e).map((function(e,a){return Object(j.jsxs)("tr",{className:Number(e.amount)>=0?"table-success":"table-light",children:[Object(j.jsx)("td",{children:e.date}),Object(j.jsxs)("td",{children:["$",e.amount]}),Object(j.jsx)("td",{children:e.source})]},a)}))}(a)})]})},M=function(e){var a=e.id,t=Object(n.useRef)(null),c=Object(n.useState)({}),s=Object(b.a)(c,2),l=s[0],r=s[1],i=Object(n.useState)({}),h=Object(b.a)(i,2),f=h[0],x=h[1],N=Object(n.useState)([{id:1,name:"Emergency Savings",account:"HY Savings",desc:"Buffer fund",tag:{name:"Savings",color:"warning"},values:{goal:12687,total:10724.73,percentage:85}},{id:2,name:"Dining Out",account:"General Spending",desc:"Money for eating out",tag:{name:"Food",color:"success"},values:{goal:null,total:120},history:[{date:"08/16/2021",total:"-20.25",source:"Credit"},{date:"08/14/2021",total:"-10.65",source:"Bank"},{date:"08/11/2021",total:"30.50",source:"Credit"}]},{id:3,name:"Groceries",account:"General Spending",desc:"Money for grocery spending",tag:{name:"Food",color:"success"},values:{goal:null,total:280.19}},{id:4,name:"Kids",account:"General Spending",desc:"Kid related purchases",tag:{name:"Kids",color:"info"},values:{goal:null,total:30}}]),w=Object(b.a)(N,2),C=w[0],y=(w[1],Object(n.useState)(B.tagOptions)),k=Object(b.a)(y,2),S=k[0],E=(k[1],Object(n.useState)(!0)),F=Object(b.a)(E,2),T=F[0],M=F[1],K=Object(n.useState)(!1),$=Object(b.a)(K,2),R=$[0],q=$[1],L=Object(n.useState)(!1),I=Object(b.a)(L,2),J=I[0],U=I[1],W=Object(n.useState)(""),Y=Object(b.a)(W,2),X=Y[0],z=Y[1],Q=Object(n.useState)(""),Z=Object(b.a)(Q,2),ee=Z[0],ae=Z[1],te=Object(n.useState)("Credit"),ne=Object(b.a)(te,2),ce=ne[0];ne[1];Object(n.useEffect)((function(){a&&r(C.find((function(e){return e.id===Number(a)})))}),[a,C]);var se=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;q(!1),U(!1),z(""),ae(""),null!==e&&(e?q(!0):U(!0),setTimeout((function(){return re()}),100))},le=function(e,a){"+"===a&&(e=D(e,X))&&z(e),"-"===a&&(e=D(e,ee))&&ae(e)},re=function(){window.scrollTo({top:t.current.offsetTop,behavior:"smooth"})},oe=function(e){var a=l;switch(e.name){case"desc":a.desc=e.value;break;case"source":a.defaultSource=e.value;break;case"goal":a.values.goal=e.value;break;case"total":a.values.total=e.value;break;case"tag":a.tag.name=e.value;break;case"tag-color":a.tag.color=e.value;break;default:return}r(Object(o.a)(Object(o.a)({},l),a))},ie=function(e,a){var t=new Date;t=t.getMonth()+1+"/"+t.getDate()+"/"+t.getFullYear(),e.history.unshift({date:t,total:a,source:ce}),console.log(e),r(Object(o.a)(Object(o.a)({},l),e))},ue=function(){var e=Object(d.a)(u.a.mark((function e(){return u.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:M(!T);case 1:case"end":return e.stop()}}),e)})));return function(){return e.apply(this,arguments)}}();return Object(j.jsxs)(j.Fragment,{children:[Object(j.jsx)(m,{}),Object(j.jsx)("section",{children:!p.a.isEmpty(l)&&Object(j.jsxs)("div",{className:"container envelope",children:[Object(j.jsx)("h1",{children:l.name}),Object(j.jsx)("hr",{}),Object(j.jsxs)("div",{className:"flex-wrapper start mt-5",children:[Object(j.jsx)("div",{className:"mr-auto fg-1",children:Object(j.jsx)(v,{props:l.values,showPercent:!0})}),Object(j.jsxs)("form",{className:"fg-3 mb-5",children:[Object(j.jsxs)("div",{className:"flex-wrapper",children:[T?Object(j.jsx)("h4",{className:"tag mb-4",children:Object(j.jsx)("span",{className:"badge bg-"+l.tag.color,children:l.tag.name})}):Object(j.jsxs)("div",{className:"flex m-space",children:[Object(j.jsx)(H,{value:l.tag.name,onChange:function(e){return oe(e)},className:"mw-150",label:"Tag name",name:"tag"}),Object(j.jsx)(V,{defaultValue:l.tag.color,options:S,onChange:function(e){return oe(e)},className:"mw-150 mt-2",name:"tag-color"})]}),T?Object(j.jsxs)(g,{className:"btn-edit btn-light",action:function(){return M(!T),void x(p.a.cloneDeep(l))},children:["Edit envelope ",Object(j.jsx)("span",{className:"edit"})]}):Object(j.jsxs)("div",{className:"flex m-space edit-mobile-wrapper",children:[Object(j.jsx)(g,{className:"btn-edit btn-success",action:function(){return ue()},children:"Save envelope"}),Object(j.jsx)(g,{className:"btn-close mt-2",title:"Cancel",action:function(){return r(Object(o.a)({},f)),void M(!T)}})]})]}),Object(j.jsx)("h5",{children:"Description"}),Object(j.jsx)(P,{disabled:T,value:l.desc&&l.desc,placeholder:l.desc&&l.desc,name:"desc",onChange:function(e){return oe(e)}}),Object(j.jsx)("h5",{children:"Amounts"}),Object(j.jsxs)("div",{className:"flex-wrapper m-space",children:[Object(j.jsx)(H,{disabled:T,value:l.values.goal&&l.values.goal,placeholder:l.values.goal&&"$"+l.values.goal,onChange:function(e){return oe(e)},className:"mw-150",label:"Goal",name:"goal",help:"Desired goal to reach."}),Object(j.jsxs)("div",{className:"flex column",children:[Object(j.jsx)(A,{disabled:T,value:l.values&&l.values.total,placeholder:l.values&&"$"+l.values.total,adjustableClick:function(e){return se(e)},onChange:function(e){return oe(e)},className:"mw-150",label:"Total",name:"total",help:"Current amount in envelope."}),Object(j.jsxs)("div",{ref:t,className:"input-button-wrapper",children:[R&&Object(j.jsxs)(j.Fragment,{children:[Object(j.jsx)(H,{help:"Enter amount to add.",className:"mw-150",name:"add-total",value:X,onChange:function(e){return le(e.value,"+")}}),Object(j.jsx)(g,{text:"Add",className:"btn-success",action:function(){return function(){var e=l;e.values.total=(Number(e.values.total)+Number(X)).toFixed(2),e.values.goal&&(e.values.percentage=Math.round(e.values.total/e.values.goal*100)),ie(e,X)}()}}),Object(j.jsx)(g,{className:"btn-close",action:function(){return se()}})]}),J&&Object(j.jsxs)(j.Fragment,{children:[Object(j.jsx)(H,{type:"number",help:"Enter amount to subtract.",className:"mw-150",name:"sub-total",value:ee,onChange:function(e){return le(e.value,"-")}}),Object(j.jsx)(g,{text:"Subtract",className:"btn-warning",action:function(){return function(){var e=l;e.values.total=(Number(e.values.total)-Number(ee)).toFixed(2),e.values.goal&&(e.values.percentage=Math.round(e.values.total/e.values.goal*100)),ie(e,"-"+ee)}()}}),Object(j.jsx)(g,{className:"btn-close",action:function(){return se()}})]})]})]}),Object(j.jsx)("div",{children:Object(j.jsx)(G,{label:"Source",defaultValue:B.sourceDefault,onChange:function(e){return oe(e)},className:"mw-150",name:"source",options:B.sources})})]})]})]}),l.history&&Object(j.jsxs)("div",{children:[Object(j.jsx)("h5",{children:"Transactions"}),Object(j.jsx)(_,{props:l.history})]})]})}),Object(j.jsx)(O,{})]})},K=function(){var e=Object(n.useState)(B.newEnvelope),a=Object(b.a)(e,2),t=a[0],c=a[1],s=Object(n.useState)(B.tagOptions),l=Object(b.a)(s,2),i=l[0],h=(l[1],Object(n.useState)({})),f=Object(b.a)(h,2),x=f[0],N=f[1],w=Object(n.useState)(""),C=Object(b.a)(w,2),y=C[0],k=C[1],S=Object(n.useState)(""),E=Object(b.a)(S,2),F=E[0],T=E[1],A=Object(n.useState)(0),_=Object(b.a)(A,2),M=_[0],K=_[1],$=function(e,a){"total"===a&&((e=D(e,y))&&k(e),F>0&&K(e/F*100)),"goal"===a&&((e=D(e,F))&&T(e),e>0&&K(y/e*100))},R=function(e){var a=t;switch(e.name){case"name":a.name=e.value;break;case"account":a.account=e.value;break;case"desc":a.desc=e.value;break;case"source":a.defaultSource=e.value;break;case"tag":a.tag.name=e.value;break;case"tag-color":a.tag.color=e.value;break;default:return}c(Object(o.a)(Object(o.a)({},t),a))},q=function(){var e=Object(d.a)(u.a.mark((function e(){var a;return u.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(N({}),(a=t).values.goal=F,a.values.total=y,a.values.percentage=M,""!==a.name){e.next=8;break}return N(Object(o.a)(Object(o.a)({},x),{},{name:!0})),e.abrupt("return");case 8:console.log(a);case 9:case"end":return e.stop()}}),e)})));return function(){return e.apply(this,arguments)}}();return Object(j.jsxs)(j.Fragment,{children:[Object(j.jsx)(m,{}),Object(j.jsx)("section",{children:!p.a.isEmpty(t)&&Object(j.jsxs)("div",{className:"container envelope",children:[Object(j.jsxs)("div",{className:"flex-wrapper",children:[Object(j.jsx)(H,{required:!0,error:x.name,value:t.name,placeholder:"Groceries",onChange:function(e){return R(e)},className:"mw-150",label:"Envelope name",name:"name"}),Object(j.jsxs)("div",{className:"flex m-space edit-mobile-wrapper mt-4",children:[Object(j.jsx)(g,{className:"btn-edit btn-success",action:function(){return q()},children:"Add new envelope"}),Object(j.jsx)(r.a,{className:"btn btn-close mt-2",title:"Cancel",to:"/"})]})]}),Object(j.jsx)("hr",{}),Object(j.jsxs)("div",{className:"flex-wrapper start no-wrap mt-5",children:[Object(j.jsx)("div",{className:"mr-auto fg-1",children:Object(j.jsx)(v,{props:{goal:F,amount:y,percentage:M},showPercent:!0})}),Object(j.jsxs)("form",{className:"fg-3 mb-5",children:[Object(j.jsxs)("div",{className:"flex m-space",children:[Object(j.jsx)(H,{value:t.tag.name,placeholder:"Food",onChange:function(e){return R(e)},className:"mw-150",label:"Tag name",name:"tag"}),Object(j.jsx)(V,{defaultValue:t.tag.color,options:i,onChange:function(e){return R(e)},className:"mw-150 mt-2",name:"tag-color"})]}),Object(j.jsx)("h5",{children:"Description"}),Object(j.jsx)(P,{value:t.desc&&t.desc,placeholder:"Add a description of this envelope",name:"desc",onChange:function(e){return R(e)}}),Object(j.jsx)("h5",{children:"Amounts"}),Object(j.jsxs)("div",{className:"flex-wrapper",children:[Object(j.jsx)(H,{value:F,placeholder:"$100.00",onChange:function(e){return $(e.value,"goal")},label:"Goal",name:"goal",help:"Desired goal to reach."}),Object(j.jsx)(H,{value:y,placeholder:"$20.00",onChange:function(e){return $(e.value,"total")},label:"Total",name:"total",help:"Current amount in envelope."}),Object(j.jsx)(G,{label:"Default source",defaultValue:B.sourceDefault,onChange:function(e){return R(e)},name:"source",options:B.sources,help:"Set default source for withdrawals."}),Object(j.jsx)(H,{value:B.account,placeholder:"Savings / Cash",onChange:function(e){return R(e)},label:"Account name",name:"account",help:"Primary location of funds."})]})]})]})]})}),Object(j.jsx)(O,{})]})},$=function(){return Object(j.jsxs)(r.b,{children:[Object(j.jsx)(F,{path:"/"}),Object(j.jsx)(M,{path:"/envelope/:id"}),Object(j.jsx)(K,{path:"/envelope/new/"}),Object(j.jsx)(T,{path:"/login"})]})},R=(t(55),t(56),function(e){e&&e instanceof Function&&t.e(3).then(t.bind(null,58)).then((function(a){var t=a.getCLS,n=a.getFID,c=a.getFCP,s=a.getLCP,l=a.getTTFB;t(e),n(e),c(e),s(e),l(e)}))});l.a.render(Object(j.jsx)(c.a.StrictMode,{children:Object(j.jsx)($,{})}),document.getElementById("root")),R()}},[[57,1,2]]]);
//# sourceMappingURL=main.9db827f7.chunk.js.map