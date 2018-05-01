/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


Vue.component('stores', require('./components/stores.vue'));
Vue.component('users', require('./components/users.vue'));
Vue.component('itemdetails', require('./components/details.vue'));
const app = new Vue({
    el: '#app'
});