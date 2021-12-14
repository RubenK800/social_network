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
                    <div v-else-if="!comment.user" class="text-light bg-dark">
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
                    <button @click="enableCommentReplyForm(comment['id'])">Reply
                    </button>
                    <div v-if="comment.user && hasUserTheNeededPermission(comment.user['id'])">
                        <!--                            @if($independentcomment->user['id'] === $userId)-->
                        <button type="button" @click="enableCommentEditForm(comment['id'])">
                            Edit
                        </button>
                        <button type="button" @click="deleteComment(comment['id'])">
                            Delete
                        </button>
                        <form>
                            <!--                            action="{{route('comments.destroy',['id' => $independentcomment['id']])}}"-->
                            <!--                            method="post" -->
                            <!--                                >-->
                            <!--                            @method('DELETE')-->
<!--                            <input type="submit" value="Delete">-->
                        </form>
                        <!--                            @endif-->
                    </div>
                </div>

                <div v-if="editCommentEnableId === comment['id']">
                    <div> write your new comment here. It will replace the old one above </div>
                    <form>
                        <label>
                            <input type="text" v-model="commentNewText" name="comment-text" >
                        </label>
                        <label style="border: solid #1a202c 1px">Add Image
                            <input type="file" v-on:change="formFile" name="comment_image" hidden>
                        </label>
                        <input type="button" @click="saveCommentChanges(comment['id'])" value="Send comment">
                    </form>
                    <button type="button" class="comment-function-hide">I
                        changed my mind
                    </button>
                </div>

                <div v-if="replyCommentEnableId === comment['id']">
                    <div>write your reply here.</div>
                    <form>
                        <label>
                            <input type="text" v-model="commentNewText" name="comment-text" >
                        </label>
                        <label style="border: solid #1a202c 1px">Add Image
                            <input type="file" v-on:change="formFile" name="comment_image" hidden>
                        </label>
                        <input type="button" @click="sendTheCommentReply(comment['id'], comment['post_id'])" value="Send comment">
                    </form>
                    <button type="button" class="comment-function-hide">I
                        changed my mind
                    </button>
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
        props: {
            commentsArray: ""
        },
        data: () => {
            return {
                comments: [],
                editCommentEnableId: -1,
                replyCommentEnableId: -1,
                commentNewText: '',
                file: null
            }
        },
        methods: {
            hasUserTheNeededPermission(userId) {
                return Number.parseInt(userId) === Number.parseInt(Vue.prototype.$userId);
            },

            setlikeOrDislike(commentId, action) {
                this.$store.dispatch('comments/setLikeOrDislike', {
                    comment_id: commentId,
                    type: action
                });
            },

            enableCommentEditForm(commentId) {
                this.editCommentEnableId = commentId;
            },

            enableCommentReplyForm(commentId) {
                this.replyCommentEnableId = commentId;
            },

            saveCommentChanges(commentId) {
                this.$store.dispatch('comments/changeComment', {
                    comment_id: commentId,
                    new_text: this.commentNewText,
                    image: this.file
                });
            },

            sendTheCommentReply(commentId, postId) {
                this.$store.dispatch('comments/addComment', {
                    post_id: postId,
                    receiver_comment_id: commentId,
                    new_text: this.commentNewText,
                    image: this.file
                });
            },

            deleteComment(commentId){
                this.$store.dispatch('comments/deleteComment', {
                    id: commentId,
                });
            },

            formFile(e) {
                this.file = e.target.files[0];
            },
        }
    }

</script>

<style scoped>

</style>
