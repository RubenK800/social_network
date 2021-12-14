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
        comment(state, comment)
        {
            state.comment = comment
        }
    },

    actions: {
        loadComments({commit}) {
            axios
                .get('/api/posts')
                .then(res => {
                    commit('comment', res.data)
                })
                .catch(err => {
                console.log(err)
            })
        },

        async setLikeOrDislike(context, payload){
            alert(payload.comment_id)
            try {
                await axios
                    .post('/likes', {
                    comment_id:payload.comment_id,
                    type:payload.type
                    })
                    .then(res => {
                    //context.commit('posts', res.data);
                    // console.log(res.data);
                    });
            } catch (error) {

            }
        },

        // async addComment(context, payload){
        //     try {
        //         //alert(payload.receiver_comment_id);
        //         const data = new FormData();
        //         data.append('post_id', payload.post_id);
        //         data.append('receiver_comment_id', payload.receiver_comment_id)
        //         data.append('comment_image', payload.image);
        //         data.append('comment_text', payload.new_text);
        //         await axios
        //             .post('/comments', data)
        //             .then(res => {
        //                 //context.commit('posts', res.data);
        //                 console.log(res.data);
        //             });
        //     } catch (error) {
        //
        //     }
        // },

        async changeComment(context, payload){
            try {
                //alert(payload.new_text);
                const data = new FormData();
                data.append('comment_image', payload.image);
                data.append('comment_text', payload.new_text);
                data.append('_method', 'PUT');
                await axios
                    .post('/comments/'+payload.comment_id,
                    data)
                    .then(res => {
                    //context.commit('posts', res.data);
                     console.log(res.data);
                });
            } catch (error) {

            }
        },

        async addComment(context, payload){
            try {
                //alert(payload.receiver_comment_id);
                const data = new FormData();
                data.append('post_id', payload.post_id);
                data.append('receiver_comment_id', payload.receiver_comment_id)
                data.append('comment_image', payload.image);
                data.append('comment_text', payload.new_text);
                await axios
                    .post('/comments', data)
                    .then(res => {
                    //context.commit('posts', res.data);
                    console.log(res.data);
                });
            } catch (error) {

            }
        },

        async deleteComment(context, payload){
            try {
                //alert(payload.receiver_comment_id);
                const data = new FormData();
                data.append('_method', 'DELETE');
                await axios
                    .post('/comments/'+ payload.id, data)
                    .then(res => {
                        //context.commit('posts', res.data);
                        console.log(res.data);
                    });
            } catch (error) {

            }
        }
    }
}
