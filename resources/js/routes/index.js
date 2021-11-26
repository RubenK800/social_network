import VueRouter from 'vue-router'
import Login from "../components/auth/Login";
import Register from "../components/auth/Register";
import Profile from "../components/user/Profile";
import Wall from "../components/user/Wall";
import Vue from "vue";

Vue.use(VueRouter);
const routes = [
    { path: '/login', component: Login},
    { path: '/register', component: Register},
    { path: '/user-profile', component: Profile},
    { path: '/user-wall', component: Wall},
    // { path: '/header-nav', component: HeaderNav},
];

export const router = new VueRouter({
    routes // short for `routes: routes`
});
