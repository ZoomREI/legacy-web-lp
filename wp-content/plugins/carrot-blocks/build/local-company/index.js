(()=>{"use strict";var e,t={492:()=>{const e=window.wp.blocks,t=window.React,l=window.wp.i18n,r=window.wp.blockEditor,o=window.wp.components,a=JSON.parse('{"UU":"carrot-blocks/local-company"}');(0,e.registerBlockType)(a.UU,{edit:function({attributes:e,setAttributes:a}){const{selectedMarket:n}=e;return(0,t.createElement)("div",{...(0,r.useBlockProps)()},(0,t.createElement)(r.InspectorControls,null,(0,t.createElement)(o.PanelBody,{title:(0,l.__)("Market Selection","carrot-blocks"),initialOpen:!0},(0,t.createElement)(o.SelectControl,{label:(0,l.__)("Select Market","carrot-blocks"),value:n,options:[{label:"Kansas City",value:"Kansas City"},{label:"San Francisco",value:"SF Bay Area"},{label:"St. Louis",value:"St. Louis"},{label:"Detroit",value:"Metro Detroit"},{label:"Cleveland",value:"Cleveland"},{label:"Indianapolis",value:"Indianapolis"}],onChange:e=>{a({selectedMarket:e})}}))),(0,t.createElement)("h3",null,(0,l.__)("Carrot Local Company","carrot-blocks")))}})}},l={};function r(e){var o=l[e];if(void 0!==o)return o.exports;var a=l[e]={exports:{}};return t[e](a,a.exports,r),a.exports}r.m=t,e=[],r.O=(t,l,o,a)=>{if(!l){var n=1/0;for(p=0;p<e.length;p++){for(var[l,o,a]=e[p],i=!0,c=0;c<l.length;c++)(!1&a||n>=a)&&Object.keys(r.O).every((e=>r.O[e](l[c])))?l.splice(c--,1):(i=!1,a<n&&(n=a));if(i){e.splice(p--,1);var s=o();void 0!==s&&(t=s)}}return t}a=a||0;for(var p=e.length;p>0&&e[p-1][2]>a;p--)e[p]=e[p-1];e[p]=[l,o,a]},r.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),(()=>{var e={5987:0,987:0};r.O.j=t=>0===e[t];var t=(t,l)=>{var o,a,[n,i,c]=l,s=0;if(n.some((t=>0!==e[t]))){for(o in i)r.o(i,o)&&(r.m[o]=i[o]);if(c)var p=c(r)}for(t&&t(l);s<n.length;s++)a=n[s],r.o(e,a)&&e[a]&&e[a][0](),e[a]=0;return r.O(p)},l=globalThis.webpackChunkcarrot_blocks=globalThis.webpackChunkcarrot_blocks||[];l.forEach(t.bind(null,0)),l.push=t.bind(null,l.push.bind(l))})();var o=r.O(void 0,[987],(()=>r(492)));o=r.O(o)})();