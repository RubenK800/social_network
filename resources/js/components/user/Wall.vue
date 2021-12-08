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
                <div v-for="comment in post.comments">
                    <div v-if="comment['receiver_comment_id'] === 0">
                        <br>
                        <div class="bg-light">
                            <div v-if="comment.user" class="text-light bg-dark">
                                <!--                            @if(!is_null($independentcomment->user))-->
                                {{comment.user['name']}}
                            </div>
                            <div v-if="!comment.user" class="text-light bg-dark">
                                {{'User'}}
                            </div>
                            <div>
                                {{comment['comment_text']}}
                            </div>
                            <!--                        <div v-if="comment.image['image_name']">-->
                            <!--                            <img :src="'storage/comment_pics/'+comment.image['image_name']"-->
                            <!--                                 alt="go away from me! I'm sad and angry" height="150px">-->
                            <!--                        </div>-->
                        </div>
                        <div>
                            <button class="comment-like-dislike"
                                    :data-comment-like-dislike="'ind-c-like'+comment['id']">Like
                            </button>
                            <button class="comment-like-dislike"
                                    :data-comment-like-dislike="'ind-c-dislike'+comment['id']">
                                Dislike
                            </button>
                            <button class="comment-function-show"
                                    :data-comment-function-show="'ind-reply'+comment['id']">Reply
                            </button>
                            <div v-if="hasUserTheNeededPermission(comment.user['id'])">
                                <!--                            @if($independentcomment->user['id'] === $userId)-->
                                <button class="comment-edit" :data-edit="'ind-edit'+comment['id']">Edit
                                </button>
                                <form>
                                    <!--                            action="{{route('comments.destroy',['id' => $independentcomment['id']])}}"-->
                                    <!--                            method="post" -->
                                    <!--                                >-->
                                    <!--                            @method('DELETE')-->
                                    <input type="submit" value="Delete">
                                </form>
                                <!--                            @endif-->
                            </div>
                        </div>
                    </div>
                    <div v-if="comment['receiver_comment_id'] !== 0" class="ms-4">
                        <br>
                        <div class="bg-light">
                            <div v-if="comment.user" class="text-light bg-dark">
                                <!--                            @if(!is_null($independentcomment->user))-->
                                {{comment.user['name']}}
                            </div>
                            <div v-if="!comment.user" class="text-light bg-dark">
                                {{'User'}}
                            </div>
                            <div>
                                {{comment['comment_text']}}
                            </div>
                            <!--                        <div v-if="comment.image['image_name']">-->
                            <!--                            <img :src="'storage/comment_pics/'+comment.image['image_name']"-->
                            <!--                                 alt="go away from me! I'm sad and angry" height="150px">-->
                            <!--                        </div>-->
                        </div>
                        <div>
                            <button class="comment-like-dislike"
                                    :data-comment-like-dislike="'ind-c-like'+comment['id']">Like
                            </button>
                            <button class="comment-like-dislike"
                                    :data-comment-like-dislike="'ind-c-dislike'+comment['id']">
                                Dislike
                            </button>
                            <button class="comment-function-show"
                                    :data-comment-function-show="'ind-reply'+comment['id']">Reply
                            </button>
                            <div v-if="hasUserTheNeededPermission(comment.user['id'])">
                                <!--                            @if($independentcomment->user['id'] === $userId)-->
                                <button class="comment-edit" :data-edit="'ind-edit'+comment['id']">Edit
                                </button>
                                <form>
                                    <!--                            action="{{route('comments.destroy',['id' => $independentcomment['id']])}}"-->
                                    <!--                            method="post" -->
                                    <!--                                >-->
                                    <!--                            @method('DELETE')-->
                                    <input type="submit" value="Delete">
                                </form>
                                <!--                            @endif-->
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <hr>
        </div>
    </div>
</div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        name: "Wall",
        data: () => {
            return {
                body: '',
                files: '',
                userPosts: '',
                postId: 0,
                isShown: false,
                text: '',
                userId: Vue.prototype.$userId
            }
        },

        computed: {
            ...mapGetters('posts', ['posts']), //[] - is vuex getter's name
        },

        mounted() {
            this.userPosts = this.posts;
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

            hasUserTheNeededPermission(userId){
                return Number.parseInt(userId) === Number.parseInt(Vue.prototype.$userId);
            }
        },

        beforeCreate() {
            this.$store.dispatch('posts/getPosts');
        },
    }

</script>

<style scoped>

</style>
