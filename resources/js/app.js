// /**
//  * First we will load all of this project's JavaScript dependencies which
//  * includes Vue and other libraries. It is a great starting point when
//  * building robust, powerful web applications using Vue and Laravel.
//  */
//
// require('./bootstrap');
//
// window.Vue = require('vue').default;
//
// /**
//  * The following block of code may be used to automatically register your
//  * Vue components. It will recursively scan this directory for the Vue
//  * components and automatically register them with their "basename".
//  *
//  * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
//  */
//
// // const files = require.context('./', true, /\.vue$/i)
// // files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
//
// Vue.component('login', require('./components/auth/Login.vue').default);
//
// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */
//
// const app = new Vue({
//     el: '#app',
// });

// import './bootstrap'
// import Vue from 'vue'
// import Login from './components/auth/Login'
// // Set Vue globally
// window.Vue = Vue
// // Load Index
// Vue.component('login', Login)
// const app = new Vue({
//     el: '#app'
// });

import './bootstrap'
import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from './components/auth/Login.vue'
import Register from './components/auth/Register.vue';
import Profile from './components/user/Profile.vue';
import Wall from './components/user/Wall.vue';
import HeaderNav from './components/layout/HeaderNav.vue';

window.Vue = Vue
Vue.component('login', Login);
Vue.component('register',Register);
Vue.component('profile',Profile);
Vue.component('wall',Wall);
Vue.component('header-nav',HeaderNav);
Vue.use(VueRouter);

const routes = [
    { path: '/login', component: Login},
    { path: '/register', component: Register},
    { path: '/user-profile', component: Profile},
    { path: '/user-wall', component: Wall},
    // { path: '/header-nav', component: HeaderNav},
];

const router = new VueRouter({
    routes // short for `routes: routes`
});

const app = new Vue({
    el:'#app',
    router
});//.$mount('#app')

//i think this is a bad idea
// new Vue({
//    el:'#app2'
// });
