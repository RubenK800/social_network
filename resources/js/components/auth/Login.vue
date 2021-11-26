<template>
<div id="login">
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>Sign In</h3>
                    <div class="d-flex justify-content-end social_icon">
                        <span><i class="fab fa-facebook-square"></i></span>
                        <span><i class="fab fa-google-plus-square"></i></span>
                        <span><i class="fab fa-twitter-square"></i></span>
                    </div>
                </div>
                <div class="card-body">
                    <form v-on:click.prevent="login">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <label>
                                <input type="email" v-model="email" name="email" class="form-control" placeholder="email">
                            </label>
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <label>
                                <input type="password" v-model = "password" name="password" class="form-control" placeholder="password">
                            </label>
                        </div>
                        <div class="row align-items-center remember">
                            <label>
                                <input type="checkbox">
                            </label>Remember Me
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Login" class="btn float-right login_btn">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        Don't have an account?
                        <router-link to="register" v-on:click.prevent="$emit('login-button-clicked')">Sign Up</router-link>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="#">Forgot your password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--    <router-link to="/register">Hellooser</router-link>-->
</div>
</template>

<script>

export default {
    name: "Login",
    data: () => {
        return {
            email: '',
            password: ''
        }
    },

    methods:{
        login(){
            this.$store.dispatch("users/login")
        },
        register(){
            this.$destroy();
            console.log('deleted');
        }
    },
}

</script>

<style scoped>

</style>
