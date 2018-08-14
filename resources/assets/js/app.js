
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
import VueImg from 'v-img';
import BackToTop from 'vue-backtotop';

Vue.use(VueImg);
Vue.use(VueRouter);
Vue.use(BackToTop);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('photos', require('./components/PhotoComponent.vue'));

const router = new VueRouter({
	mode: 'history', // remove url #
});

const app = new Vue({
    el: '#app',
    router,
    data: {

    },
});
