export default {
    namespaced: true,
    state: {
        user: {

        }
    },
    getters: {
        user(state) {
            return state.user
        }
    },
    mutations: {
        user(state, user) {
            state.comment = user
        }
    },
    actions: {
        async login(context, payload) {
            try {
                const response = await axios.post('/login', {
                        email: payload.email,
                        password: payload.password
                    }
                )
                console.log(payload.email + " " + payload.password);
                console.log(response.data);
                if (response.status === 200) {
                    if (response.data.two_factor != null) { //if delete "!= null" part, then it will not work, but why?
                        console.log('login' + response.data.two_factor);
                    }

                } else {
                    //console.log(response.data)
                }
            } catch (error) {
                if (error.response) {
                     if (error.response.data.errors.email[0]) {
                         return error.response.data.errors.email[0]; //strange, but yet we will let it be like this.
                     }
                }
            }
        },


        async loadProfileAvatar() {
            try {
                const response = await axios.get('/user-profile');
                return response.data.avatar.user_avatar_name;
            } catch (error) {
                if (error.response) {
                    // if (error.response.data.errors.email[0]) {
                    //     return error.response.data.errors.email[0]; //strange, but yet we will let it be like this.
                    // }
                }
            }
        },

        async uploadProfileAvatar(context, payload){
            try {
                const avatar = payload.avatar;
                let data = new FormData();
                data.append('file',avatar);
                const response = await axios.post('/avatar', data);
                console.log("payload.avatar = ");
                console.log(payload.avatar);
                return response.data;
            } catch (error) {
            }
        },

        async getCurrentUserId(){
            try {
                const response = await axios.get('/users');
                return response.data;
            } catch (error) {

            }
        },

        register(context, payload) {
            console.log(payload.name + " " + payload.email + " " + payload.password + " " + payload.password_confirmation);
            axios.post('/register', {
                name: payload.name,
                email: payload.email,
                password: payload.password,
                password_confirmation: payload.password_confirmation
            }).then(response => {
                console.log(response.data);
            })
        },

        logout() {
            axios.post('logout').then(response => {
                if (response.status === 302 || 401) {
                    console.log('logout');
                }
            }).catch(error => {
                console.log('oops');
            });
            //return 'Hello Garry!!!'
        },
    }
}
