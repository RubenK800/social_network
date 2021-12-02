import VueRouter from 'vue-router'
import Login from "../components/auth/Login";
import Register from "../components/auth/Register";
import Profile from "../components/user/Profile";
import Wall from "../components/user/Wall";
import Vue from "vue";

Vue.use(VueRouter);
const routes = [
    {
        path: '/login',
        component: Login,
        name: 'login',
        meta: {
            requiresAuth: false,
        }
    },
    {
        path: '/register',
        component: Register,
        name: 'register',
        meta: {
            requiresAuth: false,
        }
    },
    {
        path: '/user-profile',
        component: Profile,
        name: 'user-profile',
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/user-wall',
        component: Wall,
        name: 'user-wall',
        meta: {
            requiresAuth: true,
        }
    }
    // { path: '/header-nav', component: HeaderNav},
];

export const router = new VueRouter({
    routes,
    //mode: "history", //commented yet
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        console.log("Vue.prototype.$userId = " + Vue.prototype.$userId);
        if (!Vue.prototype.$userId) {
            next({ name: 'login'})
        } else {
            next() // go to wherever I'm going
        }
    } else {
        if ((to.matched.some(record => record.name.includes('login'))
            || to.matched.some(record => record.name.includes('register'))) && Vue.prototype.$userId){
        } else {
            next(); // does not require auth, make sure to always call next()!
        }
    }
})

