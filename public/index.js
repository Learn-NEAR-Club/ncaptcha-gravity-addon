!function(t){var n={};function e(o){if(n[o])return n[o].exports;var r=n[o]={i:o,l:!1,exports:{}};return t[o].call(r.exports,r,r.exports,e),r.l=!0,r.exports}e.m=t,e.c=n,e.d=function(t,n,o){e.o(t,n)||Object.defineProperty(t,n,{enumerable:!0,get:o})},e.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},e.t=function(t,n){if(1&n&&(t=e(t)),8&n)return t;if(4&n&&"object"==typeof t&&t&&t.__esModule)return t;var o=Object.create(null);if(e.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:t}),2&n&&"string"!=typeof t)for(var r in t)e.d(o,r,function(n){return t[n]}.bind(null,r));return o},e.n=function(t){var n=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(n,"a",n),n},e.o=function(t,n){return Object.prototype.hasOwnProperty.call(t,n)},e.p="",e(e.s=0)}([function(t,n,e){t.exports=e(1)},function(t,n){document.addEventListener("DOMContentLoaded",(function(t){var n=document.getElementById("nCaptcha-verification"),e=document.querySelector(".nCaptcha-transaction-field");e&&function(t){var n;t.disabled=!0,t.value=null!==(n=window)&&void 0!==n&&n.userAccount?"Submit":"Validate with nCaptcha before Submit"}(e.closest("form").querySelector('input[type="submit"]'));if(n){var o;window.initNCaptcha();var r=n.closest("form").querySelector('input[type="submit"]'),l=null==n||null===(o=n.closest("form"))||void 0===o?void 0:o.querySelector(".nCaptcha-transaction-field"),i=setInterval((function(){var t,n,e;null!==(t=window)&&void 0!==t&&t.nCaptchaWallet&&null!==(n=window)&&void 0!==n&&null!==(e=n.nCaptchaWallet)&&void 0!==e&&e.nCaptcha&&(clearInterval(i),function(t){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:600,e=null;setInterval((function(){var n,o,r,l=null===(n=window)||void 0===n||null===(o=n.nCaptchaWallet)||void 0===o||null===(r=o.nCaptcha)||void 0===r?void 0:r.isValid;l!==e&&(e=l,t(l))}),n)}((function(t){var n,e,o;!0===t&&(r.value="Submit",r.disabled="",l&&(l.value=null===(n=window)||void 0===n||null===(e=n.nCaptchaWallet)||void 0===e||null===(o=e.nCaptcha)||void 0===o?void 0:o.transaction))})))}),100)}}))}]);