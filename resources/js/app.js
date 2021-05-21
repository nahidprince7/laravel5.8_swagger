import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './components/routes/index/index';

Vue.use(VueRouter);
require('./bootstrap');

window.Vue = require('vue');

Vue.component('App', require('./components/App').default);
Vue.component('Header', require('./components/dms/partial/Header.vue').default);
Vue.component('Sidebar', require('./components/dms/partial/Sidebar.vue').default);

const app = new Vue({
    el:'#app',
    router: new VueRouter(routes),
});
