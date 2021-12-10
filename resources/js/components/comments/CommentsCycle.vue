<template>
    <div>
<!--        Hello from comments cycle {{commentsArray}}-->
        <div v-for="comment in commentsArray">
                <br>
            <div>
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
                    <div v-if="comment.image">
                        <img :src="'storage/comment_pics/'+comment.image['image_name']"
                             alt="go away from me! I'm sad and angry" height="150px">
                    </div>
                </div>
                <div>
                    <button @click="setlikeOrDislike(comment['id'],'like')">Like
                    </button>
                    <button @click="setlikeOrDislike(comment['id'],'dislike')">
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
            <div class="ms-4">
                <comments-cycle :commentsArray = "comment.dependent_comments"></comments-cycle>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CommentsCycle",
        props: {commentsArray:""},
        data: () => {
            return {
                comments:[]
            }
        },
        methods:{
            hasUserTheNeededPermission(userId){
                return Number.parseInt(userId) === Number.parseInt(Vue.prototype.$userId);
            },

            setlikeOrDislike(commentId, action){
                this.$store.dispatch('comments/setLikeOrDislike', {
                    comment_id: commentId,
                    type:action
                });

                //alert('commentId = '+commentId);

                    // $.ajax({
                    //     url: 'likes',
                    //     data: {'comment_id': commentId, 'type': action},
                    //     type: 'post',
                    //     success: function (response) {
                    //         console.log(response);
                    //     },
                    //     error: function (x, xs, xt) {
                    //         console.log(x);
                    //     }
                    // });
                    //alert(commentId);
            }
        }
    }
</script>

<style scoped>

</style>
