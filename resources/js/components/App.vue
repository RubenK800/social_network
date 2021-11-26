<template>
    <div>
        <header-nav></header-nav>
        <login v-if="!hideLogin" @login-button-clicked="hideLogin=true"></login>
        <router-view></router-view>
    </div>
</template>

<script>
    import HeaderNav from "./layout/HeaderNav";
    import Login from "./auth/Login";

    export default {
        name: "App",
        components: {
            HeaderNav,
            Login
        },
        data () {
            return {
                hideLogin: false
            }
        }
    }

</script>
<style scoped>
</style>
