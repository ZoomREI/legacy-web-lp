(()=>{"use strict";var e,t={84:()=>{const e=window.wp.blocks,t=window.React,o=window.wp.i18n,r=window.wp.blockEditor,a=window.wp.components,l=JSON.parse('{"UU":"carrot-blocks/new-and-easy"}');(0,e.registerBlockType)(l.UU,{edit:function({attributes:e,setAttributes:l}){const{selectedMarket:n,content:c}=e;return(0,t.createElement)("div",{...(0,r.useBlockProps)()},(0,t.createElement)(r.InspectorControls,null,(0,t.createElement)(a.PanelBody,{title:(0,o.__)("Market Selection","carrot-blocks"),initialOpen:!0},(0,t.createElement)(a.SelectControl,{label:(0,o.__)("Select Market","carrot-blocks"),value:n,options:[{label:"Kansas City",value:"Kansas City"},{label:"San Francisco",value:"San Francisco Bay Area"},{label:"St. Louis",value:"St. Louis"},{label:"Detroit",value:"Metro Detroit"},{label:"Cleveland",value:"Cleveland"},{label:"Indianapolis",value:"Indianapolis"}],onChange:e=>{l({selectedMarket:e})}})),(0,t.createElement)(a.PanelBody,{title:(0,o.__)("Section Content","carrot-blocks"),initialOpen:!0},(0,t.createElement)(a.TextareaControl,{label:(0,o.__)("Content","carrot-blocks"),value:c,onChange:e=>{l({content:e})},placeholder:(0,o.__)("Enter the content for this section...")}))),(0,t.createElement)("h3",null,(0,o.__)("Carrot New And Easy","carrot-blocks")))}})}},o={};function r(e){var a=o[e];if(void 0!==a)return a.exports;var l=o[e]={exports:{}};return t[e](l,l.exports,r),l.exports}r.m=t,e=[],r.O=(t,o,a,l)=>{if(!o){var n=1/0;for(b=0;b<e.length;b++){for(var[o,a,l]=e[b],c=!0,i=0;i<o.length;i++)(!1&l||n>=l)&&Object.keys(r.O).every((e=>r.O[e](o[i])))?o.splice(i--,1):(c=!1,l<n&&(n=l));if(c){e.splice(b--,1);var s=a();void 0!==s&&(t=s)}}return t}l=l||0;for(var b=e.length;b>0&&e[b-1][2]>l;b--)e[b]=e[b-1];e[b]=[o,a,l]},r.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),(()=>{var e={4731:0,3587:0};r.O.j=t=>0===e[t];var t=(t,o)=>{var a,l,[n,c,i]=o,s=0;if(n.some((t=>0!==e[t]))){for(a in c)r.o(c,a)&&(r.m[a]=c[a]);if(i)var b=i(r)}for(t&&t(o);s<n.length;s++)l=n[s],r.o(e,l)&&e[l]&&e[l][0](),e[l]=0;return r.O(b)},o=globalThis.webpackChunkcarrot_blocks=globalThis.webpackChunkcarrot_blocks||[];o.forEach(t.bind(null,0)),o.push=t.bind(null,o.push.bind(o))})();var a=r.O(void 0,[3587],(()=>r(84)));a=r.O(a)})();