import Vue from 'vue'
import Vuex from 'vuex'
import comments from "./modules/comments";
import users from "./modules/users";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        comments,
        users
    }
})
