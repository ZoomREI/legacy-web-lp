/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/lead-form/edit.js":
/*!*******************************!*\
  !*** ./src/lead-form/edit.js ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Edit)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_4__);





function Edit({
  attributes,
  setAttributes
}) {
  const {
    redirectUrl,
    webhooks,
    redirectQuery,
    btnText
  } = attributes;
  const onChangeBtnText = value => {
    setAttributes({
      btnText: value
    });
  };

  // Update Redirect URL
  const onChangeRedirectUrl = value => {
    setAttributes({
      redirectUrl: value
    });
  };

  // Manage Webhooks
  const updateWebhook = (index, key, value) => {
    const updatedWebhooks = [...webhooks];
    updatedWebhooks[index] = {
      ...updatedWebhooks[index],
      [key]: value
    };
    setAttributes({
      webhooks: updatedWebhooks
    });
  };
  const addWebhook = () => {
    setAttributes({
      webhooks: [...webhooks, {
        url: "",
        usePreset: true,
        fieldsPreset: "",
        fieldsMapping: []
      }]
    });
  };
  const removeWebhook = index => {
    const updatedWebhooks = [...webhooks];
    updatedWebhooks.splice(index, 1);
    setAttributes({
      webhooks: updatedWebhooks
    });
  };

  // Manage Fields Mapping
  const updateFieldMapping = (webhookIndex, mappingIndex, key, value) => {
    const updatedWebhooks = [...webhooks];
    const mapping = updatedWebhooks[webhookIndex].fieldsMapping || [];
    mapping[mappingIndex] = {
      ...mapping[mappingIndex],
      [key]: value
    };
    updatedWebhooks[webhookIndex].fieldsMapping = mapping;
    setAttributes({
      webhooks: updatedWebhooks
    });
  };
  const addFieldMapping = webhookIndex => {
    const updatedWebhooks = [...webhooks];
    updatedWebhooks[webhookIndex].fieldsMapping = [...(updatedWebhooks[webhookIndex].fieldsMapping || []), {
      key: "",
      field: ""
    }];
    setAttributes({
      webhooks: updatedWebhooks
    });
  };
  const removeFieldMapping = (webhookIndex, mappingIndex) => {
    const updatedWebhooks = [...webhooks];
    const mapping = updatedWebhooks[webhookIndex].fieldsMapping || [];
    mapping.splice(mappingIndex, 1);
    updatedWebhooks[webhookIndex].fieldsMapping = mapping;
    setAttributes({
      webhooks: updatedWebhooks
    });
  };

  // Manage Redirect Query
  const updateRedirectQuery = (index, key, value) => {
    const updatedRedirectQuery = [...redirectQuery];
    updatedRedirectQuery[index] = {
      ...updatedRedirectQuery[index],
      [key]: value
    };
    setAttributes({
      redirectQuery: updatedRedirectQuery
    });
  };
  const addRedirectQuery = () => {
    setAttributes({
      redirectQuery: [...redirectQuery, {
        key: "",
        field: ""
      }]
    });
  };
  const removeRedirectQuery = index => {
    const updatedRedirectQuery = [...redirectQuery];
    updatedRedirectQuery.splice(index, 1);
    setAttributes({
      redirectQuery: updatedRedirectQuery
    });
  };
  const fieldOptions = [{
    label: "Select",
    value: ""
  }, {
    label: "Full Name",
    value: "fullName"
  }, {
    label: "Phone",
    value: "phone"
  }, {
    label: "Email",
    value: "email"
  }, {
    label: "Full Address",
    value: "propertyAddress"
  }, {
    label: "Street Address",
    value: "street"
  }, {
    label: "City",
    value: "city"
  }, {
    label: "State",
    value: "state"
  }, {
    label: "Zipcode",
    value: "zipcode"
  }, {
    label: "Country",
    value: "country"
  }, {
    label: "UTM Source",
    value: "utm_source"
  }, {
    label: "UTM Term",
    value: "utm_term"
  }, {
    label: "UTM Campaign",
    value: "utm_campaign"
  }, {
    label: "UTM Medium",
    value: "utm_medium"
  }, {
    label: "UTM Content",
    value: "utm_content"
  }, {
    label: "Device",
    value: "device"
  }, {
    label: "GCLID",
    value: "gclid"
  }, {
    label: "FBCLID",
    value: "fbclid"
  }, {
    label: "MSCLKID",
    value: "msclkid"
  }, {
    label: "Page URL",
    value: "page_url"
  }, {
    label: "Lead Source",
    value: "lead_source"
  }, {
    label: "Timestamp",
    value: "timestamp"
  }, {
    label: "Client ID",
    value: "client_id"
  }, {
    label: "Session ID",
    value: "session_id"
  }, {
    label: "Form Name",
    value: "form_name"
  }];
  const presets = [{
    label: "Select",
    value: ""
  }, {
    label: "CMS",
    value: "cms"
  }, {
    label: "sGTM",
    value: "sgtm"
  }];
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    ...(0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.useBlockProps)(),
    style: {
      width: '35vw'
    }
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    style: {
      marginBottom: "30px"
    }
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Lead Form V2", "chris-buys-blocks"))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Button text", "doctor-homes-blocks"),
    value: btnText,
    onChange: onChangeBtnText,
    placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Enter button text", "doctor-homes-blocks"),
    style: {
      marginBottom: '15px',
      color: '#000000'
    }
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Redirect URL", "text-domain"),
    value: redirectUrl,
    onChange: onChangeRedirectUrl,
    placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Enter redirect URL", "text-domain"),
    style: {
      marginTop: '10px',
      color: '#000000'
    }
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", {
    className: "lead-form-title",
    style: {
      marginTop: '30px',
      marginBottom: '15px'
    }
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Webhooks", "text-domain")), webhooks.map((webhook, index) => (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    key: index,
    style: {
      marginBottom: '10px',
      padding: '10px',
      border: '1px solid rgb(221, 221, 221)'
    }
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("URL", "text-domain"),
    value: webhook.url,
    onChange: value => updateWebhook(index, "url", value),
    style: {
      marginBottom: '10px',
      color: '#000000'
    }
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    style: {
      marginBottom: '15px',
      marginTop: '20px',
      color: '#fff'
    }
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Use Preset", "text-domain"),
    checked: webhook.usePreset,
    onChange: value => updateWebhook(index, "usePreset", value)
  })), webhook.usePreset ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.SelectControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Fields Preset", "text-domain"),
    value: webhook.fieldsPreset,
    options: presets,
    onChange: value => updateWebhook(index, "fieldsPreset", value)
  }) : (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h4", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Fields Mapping", "text-domain")), webhook.fieldsMapping.map((mapping, mappingIndex) => (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    key: mappingIndex,
    style: {
      display: 'flex',
      marginTop: '10px',
      alignItems: 'center'
    }
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    style: {
      flexBasis: '0',
      flexGrow: '1',
      color: '#000000'
    }
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Key", "text-domain"),
    value: mapping.key,
    onChange: value => updateFieldMapping(index, mappingIndex, "key", value),
    style: {
      flexBasis: '0',
      flexGrow: '1'
    }
  })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    style: {
      flexBasis: '0',
      flexGrow: '1',
      color: '#000000'
    }
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.SelectControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Field", "text-domain"),
    value: mapping.field,
    options: fieldOptions,
    onChange: value => updateFieldMapping(index, mappingIndex, "field", value)
  })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.Button, {
    isDestructive: true,
    onClick: () => removeFieldMapping(index, mappingIndex),
    style: {
      alignSelf: 'flex-end'
    }
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Remove Field", "text-domain")))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.Button, {
    className: "is-primary is-compact",
    style: {
      marginTop: '12px'
    },
    onClick: () => addFieldMapping(index)
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Add Field Mapping", "text-domain"))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.Button, {
    isDestructive: true,
    style: {
      marginLeft: 'auto',
      display: 'block'
    },
    onClick: () => removeWebhook(index)
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Remove Webhook", "text-domain")))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.Button, {
    className: "is-primary is-compact",
    onClick: addWebhook
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Add Webhook", "text-domain")), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", {
    style: {
      marginTop: '20px',
      marginBottom: '15px'
    }
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Redirect Query", "text-domain")), redirectQuery.map((query, index) => (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    key: index,
    style: {
      padding: '10px',
      border: '1px solid',
      marginBottom: '10px',
      display: 'flex',
      alignItems: 'center'
    }
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    style: {
      flexBasis: '0',
      flexGrow: '1',
      transform: 'translateY(7.5px)',
      color: '#000000'
    }
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Key", "text-domain"),
    value: query.key,
    onChange: value => updateRedirectQuery(index, "key", value),
    style: {
      marginBottom: '10px',
      color: '#000000'
    }
  })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    style: {
      flexBasis: '0',
      flexGrow: '1',
      color: '#000000'
    }
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.SelectControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Field", "text-domain"),
    value: query.field,
    options: fieldOptions,
    onChange: value => updateRedirectQuery(index, "field", value)
  })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.Button, {
    isDestructive: true,
    style: {
      display: 'block',
      marginLeft: 'auto',
      alignSelf: 'flex-end'
    },
    onClick: () => removeRedirectQuery(index)
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Remove Query", "text-domain")))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.Button, {
    className: "is-primary is-compact",
    onClick: addRedirectQuery
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Add Redirect Query", "text-domain")));
}

/***/ }),

/***/ "./src/lead-form/index.js":
/*!********************************!*\
  !*** ./src/lead-form/index.js ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/blocks */ "@wordpress/blocks");
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _style_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./style.css */ "./src/lead-form/style.css");
/* harmony import */ var _edit__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./edit */ "./src/lead-form/edit.js");
/* harmony import */ var _block_json__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./block.json */ "./src/lead-form/block.json");




(0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__.registerBlockType)(_block_json__WEBPACK_IMPORTED_MODULE_3__.name, {
  edit: _edit__WEBPACK_IMPORTED_MODULE_2__["default"]
});

/***/ }),

/***/ "./src/lead-form/style.css":
/*!*********************************!*\
  !*** ./src/lead-form/style.css ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/***/ ((module) => {

module.exports = window["React"];

/***/ }),

/***/ "@wordpress/block-editor":
/*!*************************************!*\
  !*** external ["wp","blockEditor"] ***!
  \*************************************/
/***/ ((module) => {

module.exports = window["wp"]["blockEditor"];

/***/ }),

/***/ "@wordpress/blocks":
/*!********************************!*\
  !*** external ["wp","blocks"] ***!
  \********************************/
/***/ ((module) => {

module.exports = window["wp"]["blocks"];

/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/***/ ((module) => {

module.exports = window["wp"]["components"];

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ ((module) => {

module.exports = window["wp"]["element"];

/***/ }),

/***/ "@wordpress/i18n":
/*!******************************!*\
  !*** external ["wp","i18n"] ***!
  \******************************/
/***/ ((module) => {

module.exports = window["wp"]["i18n"];

/***/ }),

/***/ "./src/lead-form/block.json":
/*!**********************************!*\
  !*** ./src/lead-form/block.json ***!
  \**********************************/
/***/ ((module) => {

module.exports = /*#__PURE__*/JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":3,"name":"doctor-homes/lead-form","version":"0.1.0","title":"Lead Form V2","category":"widgets","icon":"feedback","description":"Form block built for the front-page.","supports":{"html":false},"textdomain":"doctor-homes-blocks","editorScript":"file:./index.js","editorStyle":"file:./index.css","render":"file:./render.php","viewScript":"file:./view.js","attributes":{"btnText":{"type":"string","default":"Get My Offer"},"redirectUrl":{"type":"string","default":"/step-2"},"webhooks":{"type":"array","default":[{"url":"https://workflow-automation.podio.com/catch/2kt203ir6i3uk64","usePreset":true,"fieldsPreset":"cms","fieldsMapping":[]},{"url":"https://server-side-tagging-ued2wljvbq-uc.a.run.app/lead","usePreset":true,"fieldsPreset":"sgtm","fieldsMapping":[]}]},"redirectQuery":{"type":"array","default":[{"key":"full-name","field":"fullName"},{"key":"phone","field":"phone"},{"key":"email","field":"email"},{"key":"propaddress","field":"propertyAddress"},{"key":"propstreet","field":"street"},{"key":"propcity","field":"city"},{"key":"propstate","field":"state"},{"key":"propzip","field":"zipcode"},{"key":"propcountry","field":"country"}]}},"style":"file:./style-index.css"}');

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"lead-form/index": 0,
/******/ 			"lead-form/style-index": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = globalThis["webpackChunkchris_buys_blocks"] = globalThis["webpackChunkchris_buys_blocks"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["lead-form/style-index"], () => (__webpack_require__("./src/lead-form/index.js")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;
//# sourceMappingURL=index.js.map