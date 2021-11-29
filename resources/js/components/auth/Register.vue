<template>
    <div>
        <div class="d-flex justify-content-center">
            <form class="form-horizontal">
                <fieldset>
                    <div id="legend">
                        <legend class="">Register</legend>
                    </div>
                    <div class="control-group">
                        <!-- Username -->
                        <label class="control-label" for="username">Username</label>
                        <div class="controls">
                            <input type="text" id="username" v-model = "name" name="name" placeholder="" class="input-xlarge">
                            <p class="help-block">Username can contain any letters or numbers, without spaces</p>
                        </div>
                    </div>

                    <div class="control-group">
                        <!-- E-mail -->
                        <label class="control-label" for="email">E-mail</label>
                        <div class="controls">
                            <input type="text" id="email" v-model="email" name="email" placeholder="" class="input-xlarge">
                            <p class="help-block">Please provide your E-mail</p>
                        </div>
                    </div>

                    <div class="control-group">
                        <!-- Password-->
                        <label class="control-label" for="password">Password</label>
                        <div class="controls">
                            <input type="password" id="password" v-model = "password" name="password" placeholder=""
                                   class="input-xlarge">
                            <p class="help-block">Password should be at least 4 characters</p>
                        </div>
                    </div>

                    <div class="control-group">
                        <!-- Password -->
                        <label class="control-label" for="password_confirm">Password (Confirm)</label>
                        <div class="controls">
                            <input type="password" id="password_confirm" v-model = "password_confirmation"
                                   name="password_confirmation" placeholder=""
                                   class="input-xlarge">
                            <p class="help-block">Please confirm password</p>
                        </div>
                    </div>

                    <div class="control-group">
                        <!-- Button -->
                        <div class="controls">
                            <button class="btn btn-success" v-on:click.prevent="register">Register</button>
                        </div>
                    </div>
                </fieldset>
            </form>
            <!--    <div class="card-footer">-->
            <!--    </div>-->
        </div>
        <div class="d-flex justify-content-center links">
            Already have an account?
            <router-link :to="{name: 'login'}" v-on:click.native.prevent='hideRegister'>Sign in</router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: "Register",
    data: () => {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation:''
        }
    },
    methods:{
        register(){
            this.$store.dispatch('users/register', {
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation:this.password_confirmation
            })
        },

        hideRegister(){
            //this.$emit('hideRegister');
            console.log(this.$route.name);
            console.log('Hide Register');
        }
    },
}
</script>

<style scoped>

</style>
