(()=>{"use strict";var e,o={6782:()=>{const e=window.wp.blocks,o=window.React,t=window.wp.i18n,s=window.wp.blockEditor,r=window.wp.components,a="/wp-content/plugins/chris-buys-blocks/src/cw-footer-v2/assets/",l=JSON.parse('{"UU":"chris-buys/footer-v2"}');(0,e.registerBlockType)(l.UU,{edit:function({attributes:e,setAttributes:l}){const{selectedMarket:n}=e,i={"Kansas City":`${a}kc-footer-logo.svg`,"San Francisco Bay Area":`${a}sf-footer-logo.svg`,"St. Louis":`${a}stl-footer-logo.svg`,"Metro Detroit":`${a}det-footer-logo.svg`,Cleveland:`${a}cle-footer-logo.svg`,Indianapolis:`${a}ind-footer-logo.svg`}[n]||`${a}stl-logo.svg`,c="San Francisco Bay Area"===n?"John Buys Bay Area Houses":"Chris Buys Homes";return(0,o.createElement)("div",{...(0,s.useBlockProps)()},(0,o.createElement)(s.InspectorControls,null,(0,o.createElement)(r.PanelBody,{title:(0,t.__)("Footer Settings","chris-buys-blocks"),initialOpen:!0},(0,o.createElement)("div",{className:"footer-block-settings"},(0,o.createElement)(r.SelectControl,{label:(0,t.__)("Choose a Market","chris-buys-blocks"),value:n,options:[{label:"Kansas City",value:"Kansas City"},{label:"San Francisco",value:"San Francisco Bay Area"},{label:"St. Louis",value:"St. Louis"},{label:"Detroit",value:"Metro Detroit"},{label:"Cleveland",value:"Cleveland"},{label:"Indianapolis",value:"Indianapolis"}],onChange:e=>{l({selectedMarket:e})}})))),(0,o.createElement)("div",{className:"cw-footer-v2"},(0,o.createElement)("div",{className:"cw-footer-v2__logo"},(0,o.createElement)("img",{src:i,alt:(0,t.__)("Logo","chris-buys-blocks")})),(0,o.createElement)("div",{className:"cw-footer-v2__brand-name"},(0,o.createElement)("h3",null,c," Footer"))))}})}},t={};function s(e){var r=t[e];if(void 0!==r)return r.exports;var a=t[e]={exports:{}};return o[e](a,a.exports,s),a.exports}s.m=o,e=[],s.O=(o,t,r,a)=>{if(!t){var l=1/0;for(v=0;v<e.length;v++){for(var[t,r,a]=e[v],n=!0,i=0;i<t.length;i++)(!1&a||l>=a)&&Object.keys(s.O).every((e=>s.O[e](t[i])))?t.splice(i--,1):(n=!1,a<l&&(l=a));if(n){e.splice(v--,1);var c=r();void 0!==c&&(o=c)}}return o}a=a||0;for(var v=e.length;v>0&&e[v-1][2]>a;v--)e[v]=e[v-1];e[v]=[t,r,a]},s.o=(e,o)=>Object.prototype.hasOwnProperty.call(e,o),(()=>{var e={9917:0,1489:0};s.O.j=o=>0===e[o];var o=(o,t)=>{var r,a,[l,n,i]=t,c=0;if(l.some((o=>0!==e[o]))){for(r in n)s.o(n,r)&&(s.m[r]=n[r]);if(i)var v=i(s)}for(o&&o(t);c<l.length;c++)a=l[c],s.o(e,a)&&e[a]&&e[a][0](),e[a]=0;return s.O(v)},t=globalThis.webpackChunkchris_buys_blocks=globalThis.webpackChunkchris_buys_blocks||[];t.forEach(o.bind(null,0)),t.push=o.bind(null,t.push.bind(t))})();var r=s.O(void 0,[1489],(()=>s(6782)));r=s.O(r)})();