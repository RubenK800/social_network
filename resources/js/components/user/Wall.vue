<template>
<div>
<!--    action="{{route('posts.store')}}"-->
    <form>
        <div class="col-8 mx-auto">
            <label>
                <textarea v-model="body" class="form-control" name="post-body" id="text" rows="10" style="width: 800px"></textarea>
            </label>
        </div>
        <div class="col-8 mx-auto">
            <label for="image" style="border: solid #1a202c 1px">Add image</label>
            <input type="file" v-on:change='postFormFile' id="image" name="img[]" multiple hidden>
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
                         height="250px" width="250px"
                         @error="hidePostPic"
                    >
                </div>
            </div>
            <hr>
            <div>
                <button @click="postLike(post['id'])">Like it</button>
                <button v-if="!isShowCommentsEnabled(post['id'])" @click="selectedPostId(post['id'], true)">Show Comments</button>
                <button v-if="isHideCommentsEnabled(post['id'])" @click="selectedPostId(post['id'], false)">Hide Comments</button>
                <button @click="editPost">
                    Edit
                </button>
                <button @click="deletePost(post['id'])">
                    Delete
                </button>
            </div>
            <hr>

            <div v-if="isEditPostEnabled">
<!--                action="{{route('posts.update', ['id' => $post['id']])}}" method="post"-->
                <form>
<!--                    @method('PUT')-->
                    <div class="col-8 mx-auto">
                        <label>
                            <textarea v-model="editPostText" rows="5" style="width: 800px"></textarea>
                        </label>
                    </div>
                    <div class="row container" v-for="image in post.images">
                        <div class="col-sm-3">
                            <div class="row">
                                <img v-bind:src="'storage/post_pics/'+image['image_name']"
                                     alt="alternate text"
                                     height="250px">
                            </div>
                            <div>
                                <button type="button" class="delete-post-image">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-8 mx-auto">
                        <label style="border: solid #1a202c 1px">Add image
                            <input type="file" name="img[]" multiple hidden>
                        </label>
                    </div>
                    <br>
                    <div class="col-8 mx-auto">
                        <input type="button" value="Save changes">
                    </div>
                </form>
                <button class="post-edit-form-hide">
                    I changed my mind
                </button>
            </div>

            <div v-if="isCommentsListEnabled(post['id'])">

                <form>
                    <label>
                        <input type="text" v-model="commentText" name="comment-text" >
                    </label>
                    <label style="border: solid #1a202c 1px">Add Image
                        <input type="file" v-on:change="formFile" name="comment_image" hidden>
                    </label>
                    <input type="button" @click="sendComment(post['id'])" value="Send comment">
                </form>

                <comments-cycle :commentsArray = "comments = post.comments"></comments-cycle>
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
                postFiles: [],
                commentFile:[],
                userPosts: '',
                postId: 0,
                isShown: false,
                text: '',
                userId: Vue.prototype.$userId,
                comments: '',
                postImageShow: true,
                commentText: '',
                isEditPostEnabled: true,
                editPostText: '',
                editPostFiles: []
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

            hidePostPic(e){
                e.target.style.display='none';
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

            postFormFile(e){
                this.postFiles = e.target.files;
                console.log(this.postFiles.length);
            },

            formFile(e){
                this.commentFile = e.target.files[0]
            },

            deletePost(postId){
                this.$store.dispatch('posts/deletePost', {
                    id: postId,
                });
            },

            sendComment(postId){
                this.$store.dispatch('comments/addComment', {
                    post_id: postId,
                    receiver_comment_id: 0,
                    new_text: this.commentText,
                    image: this.commentFile
                });
            },

            editPost(postId){
                this.$store.dispatch('posts/editPost', {
                    id: postId,
                    new_text: this.editPostText,
                    image: this.editPostFiles
                });
            }

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
