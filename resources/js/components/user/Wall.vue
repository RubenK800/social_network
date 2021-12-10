<template>
<div>
<!--    action="{{route('posts.store')}}"-->
    <form enctype="multipart/form-data">
        <div class="col-8 mx-auto">
            <label>
                <textarea v-model="body" class="form-control" name="post-body" id="text" rows="10" style="width: 800px"></textarea>
            </label>
        </div>
        <div class="col-8 mx-auto">
            <label for="image" style="border: solid #1a202c 1px">Add image</label>
            <input type="file" v-on:change='formFile' id="image" name="img[]" multiple hidden>
        </div>
        <br>
        <div class="col-8 mx-auto">
            <input type="button" name="submit" value="Send post" @click="postSubmit">
        </div>
    </form>

    <div v-for="post in userPosts[0]">
        <div class="col-8 mx-auto" style="background-color: #cbd5e0; margin-bottom: 50px;">
            <hr>
            <div style="overflow: hidden; word-wrap: break-word">
                {{post['body']}}
            </div>
            <div class="d-flex align-content-start flex-wrap">
                <div class="col-0" v-for="image in post.images">
                    <img v-bind:src="'storage/post_pics/' + image['image_name']"
                         alt="alternate text"
                         height="250px" width="250px">
                </div>
            </div>
            <hr>
            <div>
                <button @click="postLike(post['id'])">Like it</button>
                <button v-if="!isShowCommentsEnabled(post['id'])" @click="selectedPostId(post['id'], true)">Show Comments</button>
                <button v-if="isHideCommentsEnabled(post['id'])" @click="selectedPostId(post['id'], false)">Hide Comments</button>
<!--                <button class="post-edit" data-edit="post-edit{{$post['id']}}">Edit</button>-->
<!--                <form action="{{route('posts.destroy',['id'=>$post['id']])}}" method="post">-->
<!--                    @method('DELETE')-->
<!--                    @csrf-->
<!--                    <input type="submit" value="Delete">&#45;&#45;}}-->
<!--                </form>-->
            </div>
            <hr>

            <div v-if="isCommentsListEnabled(post['id'])">
                <comments-cycle :commentsArray = "comments = post.comments"></comments-cycle>
<!--                <comments-cycle :commentsArray = "comments = post.comments[0].dependent_comments"></comments-cycle>-->
            </div>
            <hr>
        </div>
    </div>
</div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import CommentsCycle from "../comments/CommentsCycle";

    export default {
        name: "Wall",
        components: {CommentsCycle},
        data: () => {
            return {
                body: '',
                files: '',
                userPosts: '',
                postId: 0,
                isShown: false,
                text: '',
                userId: Vue.prototype.$userId,
                comments: ''
            }
        },

        computed: {
            ...mapGetters('posts', ['posts']), //[] - is vuex getter's name
        },

        mounted() {
            this.userPosts = this.posts;
            this.comments = ''
            console.log(this.userPosts);
            //console.log('Vue.prototype.$userId = '+Vue.prototype.$userId)
        },

        methods: {
            postSubmit() {
                //с помощью change попробуй
                if (this.files.length === 0 && this.body === '') {
                    alert("nothing to post");
                } else {
                    console.log('body = ' + this.body);
                    this.$store.dispatch('posts/addNewPost', {
                        images: this.files,
                        body: this.body
                    });
                    this.getPosts();
                }
            },

            isShowCommentsEnabled(postId){
                if (this.isShown) { //без этих if неправильно будет работать
                    return this.postId === postId;
                }
            },

            isHideCommentsEnabled(postId){
                if (this.isShown) {
                    return this.postId === postId;
                }
            },

            isCommentsListEnabled(postId) {
                if (this.isShown) {
                    return this.postId === postId;
                }
            },

            postLike(postId) {
                this.$store.dispatch('posts/addPostLike', {
                    post_id: postId,
                });
            },

            selectedPostId(postId, isShown){
                this.postId = postId;
                this.isShown = isShown
            },

            formFile(e){
                this.files = e.target.files;
                console.log(this.files.length);
            },

            // hasUserTheNeededPermission(userId){
            //     return Number.parseInt(userId) === Number.parseInt(Vue.prototype.$userId);
            // }
        },

        beforeCreate() {
            this.$store.dispatch('posts/getPosts');
        },
    }

</script>

<style scoped>

</style>
