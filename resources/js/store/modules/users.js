export default {
    namespaced: true,
    state: {
        user:{}
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
    actions:
        {
            login() {
                axios.post('/login', {
                    email: this.email, password: this.password
                }).then(response => {
                    if (response.status === 201) {
                        console.log('login')
                    } else {
                        console.log(response.status)
                    }
                }).catch(error => {
                    console.log('oops')
                });
            },

            logout() {
                axios.post('logout').then(response => {
                    if (response.status === 302 || 401) {
                        console.log('logout')
                    }
                }).catch(error => {
                    console.log('oops')
                });
            },
        }
}
