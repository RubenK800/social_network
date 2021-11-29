import VueRouter from 'vue-router'
import Login from "../components/auth/Login";
import Register from "../components/auth/Register";
import Profile from "../components/user/Profile";
import Wall from "../components/user/Wall";
import Vue from "vue";

Vue.use(VueRouter);
const routes = [
    { path: '/login', component: Login, name: 'login'},
    { path: '/register', component: Register, name: 'register'},
    { path: '/user-profile', component: Profile, name: 'user-profile'},
    { path: '/user-wall', component: Wall, name: 'user-wall'},
    // { path: '/header-nav', component: HeaderNav},
];

export const router = new VueRouter({
    routes,
    //mode: "history", //commented yet
});

