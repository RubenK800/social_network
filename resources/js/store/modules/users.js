export default {
    namespaced: true,
    state: {
        user: {}
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
                if (response.status === 201) {
                    console.log('login')
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
