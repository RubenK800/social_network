export default {
    namespaced: true,
    state: {
        posts: []
    },

    getters: {
        posts(state) {
            //console.log(state.posts);
            return state.posts;
        }
    },

    mutations: {
        posts(state, posts) {
            //state.posts = posts.posts;  //not works
            Vue.set(state.posts,0, posts.posts) //works perfectly  //thanks to https://forum.vuejs.org/t/view-not-updating-when-vuex-state-changed/14326

            //console.log(state.posts);
            // console.log(state.posts.posts[0].body);
            // console.log(state.posts.posts[0].comments[0].comment_text);
        }
    },

    actions: {
        async addNewPost(context, payload){
            try {
                const postBody = payload.body;
                const formImages = payload.images;
                const data = new FormData();
                if (formImages) { //without this statement, if you pass no images, your body will not be used to create a post.
                    for (let i = 0; i < formImages.length; i++) { //multiple files only with this
                        data.append('files' + i, formImages[i]);
                    }
                }

                //console.log('Array.from() = '+formImages);
                data.append('body',postBody);

                await axios.post('/posts', data).then(res => {
                    context.commit('posts', res.data);
                    //console.log(res.data);
                });
            } catch (error) {

            }
        },

        async getPosts(context){
            try {
                await axios.get('/user-wall').then(res => {
                    context.commit('posts', res.data);
                    // console.log(res.data);
                });
            } catch (error) {
            }
        },

        async addPostLike(context,payload){
            alert(payload.post_id)
            try{
                await axios.post('/likes', {post_id:payload.post_id}).then(res => {
                    //context.commit('posts', res.data);
                    // console.log(res.data);
                });
            }catch (error) {

            }
        }
    },
}
