import './bootstrap'
import Vue from 'vue'
import {router} from './routes/index'
import App from './components/App.vue';
import store from './store/index'

window.Vue = Vue

const app = new Vue({
    el:'#app',
    router,
    store,
    render: h => h(App)
});//.$mount('#app')

// class p{
//     constructor(options = {}) {
//         console.log(this._actions = options._actions);
//     }
// }
//
// let _actions = 8;
// new p({_actions});

// let p = {
//     pol(){
//         return 5;
//     }
// }
//
// alert(p.pol());
