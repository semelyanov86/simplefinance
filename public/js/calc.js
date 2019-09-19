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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/calc.js":
/*!******************************!*\
  !*** ./resources/js/calc.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  var num1 = "";
  var nums = [];
  var operator = "";
  var results = "";
  $(".number").on("click", function () {
    var press = $(this).attr("value"); //grab html value, make operator a valid btn

    operator = "#";
    num1 += press; //update num1 in html

    $("#result").html(num1);
  });
  $(".operator").on("click", function () {
    if (num1) {
      //store first number in an array once an operator is clicked
      nums.push(num1);
    } //grab operator value, push it to nums array and update html. reset num1 for next input


    if (operator) {
      operator = $(this).attr("value");
      nums.push(operator);
      $("#result").html(operator);
      num1 = "";
    }
  }); //push last num1 and eval the string in nums array

  $(".equal").on("click", function () {
    nums.push(num1);
    operator = "#";
    num1 = ""; //eval doesnt work with '^' so we grab the values on either side of a "^" index, eval them with math.pow,
    //then remove those 3 indexes from the array and reinsert the math.pow return (num2)

    for (; nums.indexOf("^") > -1;) {
      var num2 = Math.pow(nums[nums.indexOf("^") - 1], nums[nums.indexOf("^") + 1]);
      var index = nums.indexOf("^");
      nums.splice(nums.indexOf("^") - 1, 3);
      nums.splice(index - 1, 0, num2);
    } //join the array and eval, reset the array and then push result so it can still be operated on until clear is clicked
    //update html
    //add check to see if a number isnt whole and limit result decimal places when necessary using toFixed


    results = eval(nums.join(""));
    nums = [];
    nums.push(results.toString());

    if (results % 1 === 0) {
      $("#result").html(results);
    } else {
      results = results.toFixed(4);
      $("#result").html(results);
    }
  }); //reset everything

  $(".clear").on("click", function () {
    num1 = "";
    nums = [];
    operator = "";
    results = "";
    $("#result").html("");
  });
});

/***/ }),

/***/ 1:
/*!************************************!*\
  !*** multi ./resources/js/calc.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /data/web/simplefinance/resources/js/calc.js */"./resources/js/calc.js");


/***/ })

/******/ });