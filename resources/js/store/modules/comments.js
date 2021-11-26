export default {
    namespaced: true,
    state: {
        comment: {
            'id': 1,
            'name': 'jon'
        }
    },
    getters: {
        comment(state) {
            return state.comment
        }
    },
    mutations: {
        comment(state, comment) {
            state.comment = comment
        }
    },
    actions: {
        loadComments({commit}) {
            axios.get('/api/posts')
                .then(res => {
                    commit('comment', res.data)
                }).catch(err => {
                console.log(err)
            })
        },
    }
}
