<template>
    <div>
        <div class="d-flex justify-content-center">
            <img v-if="src!==''" v-bind:src="src" alt="something that I can't show you" height="250px">
        </div>
        <div class="d-flex justify-content-center">
            <form enctype="multipart/form-data">
                <input type="file" v-on:change='formFile' name="img">
                <input type="button" v-on:click="uploadImage" value="upload">
            </form>
        </div>
        <div>
            <router-link to="/user-wall">Wall</router-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Profile",
        data: () => {
            return {
                src: '',
                file: null
            }
        },

        mounted() {
            this.getImage();
        },

        methods: {
            getImage() {
                this.$store.dispatch('users/loadProfileAvatar').then((res) => {
                    console.log('/storage/avatars/avatar-of-user' + this.$userId + '/' + res)
                    this.src = '/storage/avatars/avatar-of-user' + this.$userId + '/' + res;
                }).catch((error) => {
                    // catch the error
                    console.log(error);
                });
            },

            formFile(e){
                this.file = e.target.files[0];
            },

            uploadImage() {
                console.log(this.file);
                this.$store.dispatch('users/uploadProfileAvatar', {
                    avatar:this.file
                }).then((res) => {
                    this.getImage();
                    console.log(res);
                }).catch((error) => {
                    // catch the error
                    console.log(error);
                });
            }
        }
    }
</script>

<style scoped>

</style>
