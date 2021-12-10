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

        async setLikeOrDislike(context, payload){
            alert(payload.comment_id)
            try {
                await axios.post('/likes', {
                    comment_id:payload.comment_id,
                    type:payload.type
                }).then(res => {
                    //context.commit('posts', res.data);
                    // console.log(res.data);
                });
            } catch (error) {

            }
        }
    }
}
