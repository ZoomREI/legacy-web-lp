(()=>{"use strict";var e,r={27:()=>{const e=window.wp.blocks,r=window.React,o=window.wp.i18n,t=window.wp.blockEditor,l=window.wp.components,a=JSON.parse('{"UU":"carrot-blocks/no-inspectors"}');(0,e.registerBlockType)(a.UU,{edit:function({attributes:e,setAttributes:a}){const{selectedMarket:n}=e;return(0,r.createElement)("div",{...(0,t.useBlockProps)()},(0,r.createElement)(t.InspectorControls,null,(0,r.createElement)(l.PanelBody,{title:(0,o.__)("Market Selection","carrot-blocks"),initialOpen:!0},(0,r.createElement)(l.SelectControl,{label:(0,o.__)("Select Market","carrot-blocks"),value:n,options:[{label:"Kansas City",value:"Chris Buys Homes in Kansas City"},{label:"San Francisco",value:"John Buys Bay Area Houses"},{label:"St. Louis",value:"Chris Buys Homes in St. Louis"},{label:"Detroit",value:"Chris Buys Homes in Detroit"},{label:"Cleveland",value:"Chris Buys Homes in Cleveland"},{label:"Indianapolis",value:"Chris Buys Homes in Indianapolis"}],onChange:e=>{a({selectedMarket:e})}}))),(0,r.createElement)("h3",null,(0,o.__)("Carrot No Inspectors","carrot-blocks")))}})}},o={};function t(e){var l=o[e];if(void 0!==l)return l.exports;var a=o[e]={exports:{}};return r[e](a,a.exports,t),a.exports}t.m=r,e=[],t.O=(r,o,l,a)=>{if(!o){var n=1/0;for(u=0;u<e.length;u++){for(var[o,l,a]=e[u],s=!0,i=0;i<o.length;i++)(!1&a||n>=a)&&Object.keys(t.O).every((e=>t.O[e](o[i])))?o.splice(i--,1):(s=!1,a<n&&(n=a));if(s){e.splice(u--,1);var c=l();void 0!==c&&(r=c)}}return r}a=a||0;for(var u=e.length;u>0&&e[u-1][2]>a;u--)e[u]=e[u-1];e[u]=[o,l,a]},t.o=(e,r)=>Object.prototype.hasOwnProperty.call(e,r),(()=>{var e={236:0,1892:0};t.O.j=r=>0===e[r];var r=(r,o)=>{var l,a,[n,s,i]=o,c=0;if(n.some((r=>0!==e[r]))){for(l in s)t.o(s,l)&&(t.m[l]=s[l]);if(i)var u=i(t)}for(r&&r(o);c<n.length;c++)a=n[c],t.o(e,a)&&e[a]&&e[a][0](),e[a]=0;return t.O(u)},o=globalThis.webpackChunkcarrot_blocks=globalThis.webpackChunkcarrot_blocks||[];o.forEach(r.bind(null,0)),o.push=r.bind(null,o.push.bind(o))})();var l=t.O(void 0,[1892],(()=>t(27)));l=t.O(l)})();