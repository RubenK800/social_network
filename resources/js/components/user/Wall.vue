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
                <button class="likeIt" :data-post-like="post['id']" @click="postLike">Like it</button>
                <button :class="'hide-c'+post['id']" :data-show-c = "'show-c'+post['id']" @click="showPostComments">Show Comments</button>
                <button :class="'show-c'+post['id']" :data-hide-c = "'hide-c'+post['id']" @click="hidePostComments" hidden>Hide Comments</button>
<!--                <button class="post-edit" data-edit="post-edit{{$post['id']}}">Edit</button>-->
<!--                <form action="{{route('posts.destroy',['id'=>$post['id']])}}" method="post">-->
<!--                    @method('DELETE')-->
<!--                    @csrf-->
<!--                    <input type="submit" value="Delete">&#45;&#45;}}-->
<!--                </form>-->
            </div>
            <hr>
            <div :class="'show-c' + post['id'] + ' hide-c' + post['id']" hidden>
                <div v-for="comment in post.comments">
                    {{comment['comment_text']}}
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
                userPosts: ''
            }
        },

        computed: {
            ...mapGetters('posts', ['posts']), //[] - is vuex getter's name
        },

        mounted() {
            this.userPosts = this.posts;
            console.log(this.userPosts);
        },

        methods: {
            postSubmit() {
                if ($("#image")[0].files.length === 0 && $("#text")[0].value === '') {
                    alert("nothing to post");
                } else {
                    console.log('body = ' + this.body);
                    this.$store.dispatch('posts/addNewPost', {
                        images: this.files,
                        body: this.body
                    });
                    //this.forceRerender();
                    this.getPosts();
                    //console.log(this.posts);
                }
            },

            postLike(){
                    let postId = $(event.target).attr('data-post-like');
                    this.$store.dispatch('posts/addPostLike', {
                        post_id: postId,
                    });
            },

            showPostComments(){
                let type = $(event.target).attr('data-show-c');
                $('.' + type).attr("hidden", false);
                $(event.target).attr("hidden", true);
            },

            hidePostComments(){
                let type = $(event.target).attr('data-hide-c');
                $('.' + type).attr("hidden", true);
                $(event.target).attr("hidden", false);
            },

            formFile(e){
                this.files = e.target.files;
                //console.log(this.files);
            },

            // forceRerender() {
            //     this.userWallKey += 1;
            //     //this.$forceUpdate();
            // },

            getPosts(){
                //this.$store.dispatch('posts/getPosts');
                //console.log(this.posts);
            }
        },

        beforeCreate() {
            this.$store.dispatch('posts/getPosts');
        },
    }

</script>

<style scoped>

</style>
