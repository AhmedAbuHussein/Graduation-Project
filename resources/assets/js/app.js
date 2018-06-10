/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.component('notification', require('./components/notification.vue'));
Vue.component('stores', require('./components/stores.vue'));
Vue.component('users', require('./components/users.vue'));
Vue.component('employee', require('./components/employee.vue'));
Vue.component('itemdetails', require('./components/details.vue'));
Vue.component('progressbar', require('./components/progress.vue'));
Vue.component('covenant', require('./components/covenantOwner.vue'));
const app = new Vue({
    el: '#app'
});