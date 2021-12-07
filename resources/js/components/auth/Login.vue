<template>
    <div id="login">
        <!--    <header-nav></header-nav>-->
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
                        <form>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <label>
                                    <input type="email" v-model="email" name="email" class="form-control"
                                           placeholder="email">
                                </label>
                            </div>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <label>
                                    <input type="password" v-model="password" name="password" class="form-control"
                                           placeholder="password">
                                </label>
                            </div>
                            <div class="row align-items-center remember">
                                <label>
                                    <input type="checkbox">
                                </label>Remember Me
                            </div>
                            <div class="form-group">
                                <input type="submit" v-on:click.prevent="login" value="Login"
                                       class="btn float-right login_btn">
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center links">
                            Don't have an account?
                            <router-link to="register">Sign Up</router-link>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="#">Forgot your password?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center" v-if="!isHidden">Sorry, but your entered login or password is not
            correct
        </div>
        <!--    <router-link to="/register">Hellooser</router-link>-->
    </div>
</template>

<script>

    // import HeaderNav from "../layout/HeaderNav";

    export default {
        name: "Login",
        //components: {HeaderNav},
        data: () => {
            return {
                email: '',
                password: '',
                isHidden: true
            }
        },

        methods: {
            login() {
                this.$store.dispatch('users/login', {
                    email: this.email,
                    password: this.password
                }).then((res) => {
                    console.log(res)
                    if (res === 'These credentials do not match our records.') {
                        this.isHidden = false;
                    } else {
                        this.$store.dispatch('users/getCurrentUserId').then((res) => {
                            //console.log('userId = ' + res.userId)
                            Vue.prototype.$userId = res.userId;
                            this.$router.push('/user-profile');
                        });
                    }
                }).catch((error) => {
                    // catch the error
                    console.log(error);
                });
            },

            goToUserProfile() {
                this.$router.push('/home');
                console.log('Open user profile component');
            }
        },

        //template: HeaderNav
    }

</script>

<style>
    /*input:-webkit-autofill,*/
    /*input:-webkit-autofill:hover,*/
    /*input:-webkit-autofill:focus,*/
    /*textarea:-webkit-autofill,*/
    /*textarea:-webkit-autofill:hover,*/
    /*textarea:-webkit-autofill:focus,*/
    /*select:-webkit-autofill,*/
    /*select:-webkit-autofill:hover,*/
    /*select:-webkit-autofill:focus {*/
    /*    font-size: 24px;*/
    /*}*/

    /*input{*/
    /*    font-size: 24px;*/
    /*}*/
    /*input:-webkit-autofill{*/
    /*    font-size: 24px;*/
    /*}*/
    input:-webkit-autofill::first-line {
        font-size: 14px;
        font-family: Roman Italic, serif !important;
    }

</style>
