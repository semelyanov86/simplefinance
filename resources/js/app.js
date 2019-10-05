/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import 'jquery';
import $ from 'jquery';
window.$ = window.jQuery = $;
// global.$ = global.jQuery = require('jquery');

// import 'jquery-ui/ui/widgets/datepicker.js';

import 'popper.js/dist/popper.js';

// import 'select2/dist/js/select2';
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/index.css';
import BootstrapVue from 'bootstrap-vue';
import vbMsgBox from 'bootstrap-vue-msgbox';
import vSelect from 'vue-select';
// import VueGoodTablePlugin from 'vue-good-table';

// import the styles
// import 'vue-good-table/dist/vue-good-table.css'

// Vue.use(VueGoodTablePlugin);
Vue.use(vbMsgBox);

Vue.use(VueToast);
Vue.use(BootstrapVue);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('v-select', vSelect);

Vue.component('profile-component', require('./components/ProfileComponent.vue').default);
Vue.component('register-user-component', require('./components/RegisterUserComponent.vue').default);
Vue.component('currencies-component', require('./components/CurrenciesComponent.vue').default);
Vue.component('categories-component', require('./components/CategoriesComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

$(document).ready(function () {

    var num1 = "";
    var nums = [];
    var operator = "";
    var results = "";


    $(".number").on("click", function () {
        var press = $(this).attr("value");
        //grab html value, make operator a valid btn
        operator = "#";
        num1 += press;
        //update num1 in html
        $("#result").html(num1);
    });




    $(".operator").on("click", function () {
        if (num1) {
            //store first number in an array once an operator is clicked
            nums.push(num1);
        }
        //grab operator value, push it to nums array and update html. reset num1 for next input
        if (operator) {
            operator = $(this).attr("value");
            nums.push(operator);
            $("#result").html(operator);
            num1 = "";
        }
    });


    //push last num1 and eval the string in nums array
    $(".equal").on("click", function () {
        nums.push(num1);
        operator = "#";
        num1 = "";

        //eval doesnt work with '^' so we grab the values on either side of a "^" index, eval them with math.pow,
        //then remove those 3 indexes from the array and reinsert the math.pow return (num2)
        for (; nums.indexOf("^") > -1;) {
            var num2 = Math.pow(nums[nums.indexOf("^") - 1], nums[nums.indexOf("^") + 1]);
            var index = nums.indexOf("^");
            nums.splice((nums.indexOf("^") - 1), 3);
            nums.splice((index - 1), 0, num2);
        }

        //join the array and eval, reset the array and then push result so it can still be operated on until clear is clicked
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

    });


    //reset everything
    $(".clear").on("click", function () {
        num1 = "";
        nums = [];
        operator = "";
        results = "";
        $("#result").html("");
    });

});

$('#leftTab a').on('click', function (e) {
    e.preventDefault();
    $(this).tab('show')
});
$('.collapse').collapse();
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});
/*$("#calendar").datepicker();
var datepicker = $('.ui-datepicker');
datepicker.hide();
$('#collapseRightFour').on('hidden.bs.collapse', function () {
    datepicker.hide();
});
$('#collapseRightFour').on('shown.bs.collapse', function () {
    datepicker.show();
});
$('.select2').select2();*/
