(()=>{"use strict";var e,o={4692:()=>{const e=window.wp.blocks,o=window.React,t=window.wp.i18n,r=window.wp.blockEditor,l=window.wp.components,n=JSON.parse('{"UU":"chris-buys/ao-cta"}');(0,e.registerBlockType)(n.UU,{edit:function({attributes:e,setAttributes:n}){const{selectedName:s}=e;return(0,o.createElement)("div",{...(0,r.useBlockProps)()},(0,o.createElement)(r.InspectorControls,null,(0,o.createElement)(l.PanelBody,{title:(0,t.__)("Select Name","custom-blocks")},(0,o.createElement)(l.SelectControl,{label:(0,t.__)("Choose a Name","custom-blocks"),value:s,options:[{label:"Chris",value:"Chris"},{label:"John",value:"John"}],onChange:e=>{n({selectedName:e})}}))),(0,o.createElement)("h3",null,(0,t.__)("AO CTA","chris-buys")))}})}},t={};function r(e){var l=t[e];if(void 0!==l)return l.exports;var n=t[e]={exports:{}};return o[e](n,n.exports,r),n.exports}r.m=o,e=[],r.O=(o,t,l,n)=>{if(!t){var s=1/0;for(u=0;u<e.length;u++){for(var[t,l,n]=e[u],a=!0,c=0;c<t.length;c++)(!1&n||s>=n)&&Object.keys(r.O).every((e=>r.O[e](t[c])))?t.splice(c--,1):(a=!1,n<s&&(s=n));if(a){e.splice(u--,1);var i=l();void 0!==i&&(o=i)}}return o}n=n||0;for(var u=e.length;u>0&&e[u-1][2]>n;u--)e[u]=e[u-1];e[u]=[t,l,n]},r.o=(e,o)=>Object.prototype.hasOwnProperty.call(e,o),(()=>{var e={1723:0,435:0};r.O.j=o=>0===e[o];var o=(o,t)=>{var l,n,[s,a,c]=t,i=0;if(s.some((o=>0!==e[o]))){for(l in a)r.o(a,l)&&(r.m[l]=a[l]);if(c)var u=c(r)}for(o&&o(t);i<s.length;i++)n=s[i],r.o(e,n)&&e[n]&&e[n][0](),e[n]=0;return r.O(u)},t=globalThis.webpackChunkchris_buys_blocks=globalThis.webpackChunkchris_buys_blocks||[];t.forEach(o.bind(null,0)),t.push=o.bind(null,t.push.bind(t))})();var l=r.O(void 0,[435],(()=>r(4692)));l=r.O(l)})();