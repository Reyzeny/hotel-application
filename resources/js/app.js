/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import store from './store'
import router from './router'
import axios from 'axios'
import VueAxios from 'vue-axios'
//import App from './App.vue'
import jspdf from 'jspdf'
import VueTyperPlugin from 'vue-typer'
import VeeValidate from 'vee-validate';
import moment from 'moment'


//import VueUploadMultipleImage from 'vue-upload-multiple-image'
 
Vue.use(VueAxios, axios)
Vue.use(BootstrapVue)
Vue.use(jspdf)
Vue.use(VueTyperPlugin)
Vue.use(VeeValidate);
Vue.use(moment);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('header-component', require('./components/HeaderComponent.vue').default);
Vue.component('main-page', require('./components/MainPage.vue').default);
Vue.component('room-listing-component', require('./components/RoomListingComponent.vue').default);
Vue.component('room-info-component', require('./components/RoomInfo.vue').default);
Vue.component('receipt-component', require('./components/ReceiptComponent.vue').default);
//Vue.component('image-upload', require(VueUploadMultipleImage).default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store,
    router,
    //render: h => h(App)
});
