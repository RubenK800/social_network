import './bootstrap';
import Vue from 'vue';
import {router} from './routes/index';
import App from './components/App.vue';
import store from './store/index';

window.Vue = Vue;
window.$ = require('jquery');

Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');

const app = new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App)
});//.$mount('#app')

