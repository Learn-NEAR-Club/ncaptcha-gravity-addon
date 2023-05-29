/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./app.js":
/*!****************!*\
  !*** ./app.js ***!
  \****************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("var nCaptchaProcessor = function nCaptchaProcessor(submit) {\n  var _window;\n  submit.disabled = true;\n  submit.value = (_window = window) !== null && _window !== void 0 && _window.userAccount ? 'Submit' : 'Validate with nCaptcha before Submit';\n};\nfunction checkForChanges(callback) {\n  var interval = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 600;\n  var previousValue = null;\n  setInterval(function () {\n    var _window2, _window2$nCaptchaWall, _window2$nCaptchaWall2;\n    var currentValue = (_window2 = window) === null || _window2 === void 0 ? void 0 : (_window2$nCaptchaWall = _window2.nCaptchaWallet) === null || _window2$nCaptchaWall === void 0 ? void 0 : (_window2$nCaptchaWall2 = _window2$nCaptchaWall.nCaptcha) === null || _window2$nCaptchaWall2 === void 0 ? void 0 : _window2$nCaptchaWall2.isValid;\n    if (currentValue !== previousValue) {\n      previousValue = currentValue;\n      callback(currentValue);\n    }\n  }, interval);\n}\ndocument.addEventListener('DOMContentLoaded', function (event) {\n  var nCaptcha = document.getElementById('nCaptcha-verification');\n  var nCaptchaFieldInput = document.querySelector('.nCaptcha-transaction-field');\n  if (nCaptchaFieldInput) {\n    var submit = nCaptchaFieldInput.closest('form').querySelector('input[type=\"submit\"]');\n    nCaptchaProcessor(submit);\n  }\n  if (nCaptcha) {\n    var _nCaptcha$closest;\n    window.initNCaptcha();\n    var _submit = nCaptcha.closest('form').querySelector('input[type=\"submit\"]');\n    var transactionField = nCaptcha === null || nCaptcha === void 0 ? void 0 : (_nCaptcha$closest = nCaptcha.closest('form')) === null || _nCaptcha$closest === void 0 ? void 0 : _nCaptcha$closest.querySelector('.nCaptcha-transaction-field');\n    var checkNcaptchaAvailability = setInterval(function () {\n      if (window.nCaptchaWallet && window.nCaptchaWallet.nCaptcha) {\n        clearInterval(checkNcaptchaAvailability);\n        checkForChanges(function (newValue) {\n          if (newValue === true) {\n            _submit.value = 'Submit';\n            _submit.disabled = '';\n            if (transactionField) {\n              var _window3, _window3$nCaptchaWall, _window3$nCaptchaWall2;\n              transactionField.value = (_window3 = window) === null || _window3 === void 0 ? void 0 : (_window3$nCaptchaWall = _window3.nCaptchaWallet) === null || _window3$nCaptchaWall === void 0 ? void 0 : (_window3$nCaptchaWall2 = _window3$nCaptchaWall.nCaptcha) === null || _window3$nCaptchaWall2 === void 0 ? void 0 : _window3$nCaptchaWall2.transaction;\n            }\n          }\n        });\n      }\n    }, 100);\n  }\n});\n\n//# sourceURL=webpack:///./app.js?");

/***/ }),

/***/ 0:
/*!**********************!*\
  !*** multi ./app.js ***!
  \**********************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("module.exports = __webpack_require__(/*! ./app.js */\"./app.js\");\n\n\n//# sourceURL=webpack:///multi_./app.js?");

/***/ })

/******/ });