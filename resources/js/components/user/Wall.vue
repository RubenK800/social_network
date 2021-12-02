<template>
<div>
<!--    action="{{route('posts.store')}}"-->
    <form enctype = "multipart/form-data">
        <div class="col-8 mx-auto">
            <label>
                <textarea class="form-control" name="post-body" id="text" rows="10" style="width: 800px"></textarea>
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
</div>
</template>

<script>
    export default {
        name: "Wall",
        data: () => {
            return {
                src: '',
                file: null
            }
        },
        methods: {
            postSubmit() {
                if ($("#image")[0].files.length === 0 && $("#text")[0].value === '') {
                    alert("nothing to post");
                } else {
                    console.log(this.file);
                    this.$store.dispatch('users/addNewPost', {
                        image:this.file
                    }).then((res) => {
                        this.getImage();
                        console.log(res);
                    }).catch((error) => {
                        // catch the error
                        console.log(error);
                    });
                }
            },

            formFile(e){
                this.file = e.target.files;
            },
        }
    }
</script>

<style scoped>

</style>
