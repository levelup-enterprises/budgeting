(this["webpackJsonplevelup-budgeting"]=this["webpackJsonplevelup-budgeting"]||[]).push([[0],{22:function(e,n,c){},23:function(e,n,c){},24:function(e,n,c){"use strict";c.r(n);var a=c(1),t=c.n(a),s=c(9),r=c.n(s),l=c(2),i=c(4),o=c(0),d=function(e){return Object(o.jsx)("nav",{className:"navbar navbar-expand-lg navbar-light bg-light",children:Object(o.jsxs)("div",{className:"container-fluid",children:[Object(o.jsx)(l.a,{to:"/",className:"navbar-brand",children:"Budgeting"}),Object(o.jsx)("button",{className:"navbar-toggler",children:Object(o.jsx)("span",{className:"navbar-toggler-icon"})}),Object(o.jsxs)("div",{className:"collapse navbar-collapse justify-content-between",children:[Object(o.jsx)("ul",{className:"navbar-nav",children:Object(o.jsx)("li",{className:"nav-item",children:Object(o.jsx)(l.a,{to:"/",className:"nav-link active",children:"Home"})})}),Object(o.jsx)("ul",{className:"navbar-nav",children:Object(o.jsx)("li",{className:"nav-item",children:Object(o.jsx)(l.a,{to:"/",className:"nav-link",children:"Logout"})})})]})]})})},j=function(e){return Object(o.jsx)("footer",{className:"footer",children:Object(o.jsx)("div",{className:"container-fluid",children:Object(o.jsx)(l.a,{to:"/",className:"navbar-brand",children:"Budgeting"})})})},u=function(e){var n=e.props,c=e.showPercent;return Object(o.jsxs)("div",{className:"circle-graph",children:[Object(o.jsx)("div",{className:"circle "+function(){if(n.goal){var e=n.amount/n.goal*100;if(100===e)return"c100";if(e>=80)return"c80";if(e>=60)return"c60";if(e>=40)return"c40";if(e>=20)return"c20";if(e>=0)return"c0"}}(),style:function(){if(n.goal){var e=n.amount/n.goal*100;return{backgroundImage:"conic-gradient(#eae9e9 ".concat(e=100-e,"%, transparent 0)")}}}(),children:n.goal?Object(o.jsxs)("div",{className:"amount",children:[Object(o.jsxs)("h3",{children:["$",n.amount]}),Object(o.jsxs)("small",{children:["of ",Object(o.jsxs)("b",{children:["$",n.goal]})," reached"]})]}):Object(o.jsxs)("h3",{className:"amount",children:["$",n.amount]})}),c&&n.goal&&Object(o.jsx)("div",{className:"text-center mt-3",children:Object(o.jsxs)("h4",{children:[Math.round(n.amount/n.goal*100),"% complete"]})})]})},b=function(e){var n=e.props;return Object(o.jsxs)("div",{className:"card",children:[Object(o.jsx)("div",{className:"tag",children:Object(o.jsx)("span",{className:"badge bg-"+n.tag.color,children:n.tag.name})}),Object(o.jsx)(u,{props:n.values}),Object(o.jsxs)("div",{className:"card-body",children:[Object(o.jsx)("h5",{className:"card-title",children:n.name}),Object(o.jsx)("p",{className:"card-text",children:n.desc}),Object(o.jsx)(l.a,{to:"/envelope/"+n.id,className:"btn btn-light float-end",children:"Manage"})]})]},n.id)},g=c(5),m=c.n(g),h=function(e){var n=Object(a.useState)([{id:1,name:"Emergency Savings",account:"HY Savings",desc:"Buffer fund",tag:{name:"Savings",color:"warning"},values:{goal:12687,amount:10724.73}},{id:2,name:"Dining Out",account:"General Spending",desc:"Money for eating out",tag:{name:"Food",color:"success"},values:{goal:null,amount:120}},{id:3,name:"Groceries",account:"General Spending",desc:"Money for grocery spending",tag:{name:"Food",color:"success"},values:{goal:null,amount:280.19}},{id:4,name:"Kids",account:"General Spending",desc:"Kid related purchases",tag:{name:"Kids",color:"info"},values:{goal:null,amount:30}}]),c=Object(i.a)(n,2),t=c[0];c[1];return Object(o.jsxs)(o.Fragment,{children:[Object(o.jsx)(d,{}),Object(o.jsx)("section",{children:Object(o.jsxs)("div",{className:"container",children:[Object(o.jsx)("h1",{children:"Envelopes"}),Object(o.jsx)("hr",{}),Object(o.jsx)("div",{className:"flex-wrapper",children:!m.a.isEmpty(t)&&Object.values(t).map((function(e){return Object(o.jsx)(b,{props:e})}))})]})}),Object(o.jsx)(j,{})]})},O=function(e){return Object(o.jsx)(o.Fragment,{children:Object(o.jsx)("section",{children:Object(o.jsx)("h1",{children:"Login page"})})})},x=function(e){var n=e.id,c=Object(a.useState)({}),t=Object(i.a)(c,2),s=t[0],r=t[1],l=Object(a.useState)([{id:1,name:"Emergency Savings",account:"HY Savings",desc:"Buffer fund",tag:{name:"Savings",color:"warning"},values:{goal:12687,amount:10724.73}},{id:2,name:"Dining Out",account:"General Spending",desc:"Money for eating out",tag:{name:"Food",color:"success"},values:{goal:null,amount:120}},{id:3,name:"Groceries",account:"General Spending",desc:"Money for grocery spending",tag:{name:"Food",color:"success"},values:{goal:null,amount:280.19}},{id:4,name:"Kids",account:"General Spending",desc:"Kid related purchases",tag:{name:"Kids",color:"info"},values:{goal:null,amount:30}}]),b=Object(i.a)(l,2),g=b[0];b[1];return Object(a.useEffect)((function(){n&&(console.log(typeof n),r(g.find((function(e){return e.id===Number(n)}))))}),[n,g]),Object(o.jsxs)(o.Fragment,{children:[Object(o.jsx)(d,{}),Object(o.jsx)("section",{children:!m.a.isEmpty(s)&&Object(o.jsxs)("div",{className:"container",children:[Object(o.jsx)("h1",{children:s.name}),Object(o.jsx)("hr",{}),Object(o.jsxs)("div",{className:"flex-wrapper start mt-5",children:[Object(o.jsx)("div",{className:"me-5",children:Object(o.jsx)(u,{props:s.values,showPercent:!0})}),Object(o.jsxs)("div",{children:[Object(o.jsx)("h4",{className:"tag",children:Object(o.jsx)("span",{className:"badge bg-"+s.tag.color,children:s.tag.name})}),Object(o.jsx)("h5",{children:"Description"}),Object(o.jsx)("p",{children:s.desc})]})]})]})}),Object(o.jsx)(j,{})]})},v=function(){return Object(o.jsxs)(l.b,{children:[Object(o.jsx)(h,{path:"/"}),Object(o.jsx)(x,{path:"/envelope/:id"}),Object(o.jsx)(O,{path:"/login"})]})},p=(c(22),c(23),function(e){e&&e instanceof Function&&c.e(3).then(c.bind(null,25)).then((function(n){var c=n.getCLS,a=n.getFID,t=n.getFCP,s=n.getLCP,r=n.getTTFB;c(e),a(e),t(e),s(e),r(e)}))});r.a.render(Object(o.jsx)(t.a.StrictMode,{children:Object(o.jsx)(v,{})}),document.getElementById("root")),p()}},[[24,1,2]]]);
//# sourceMappingURL=main.7e798e38.chunk.js.map