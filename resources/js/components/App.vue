<template>
    <div>
        <header-nav></header-nav>
        <router-view></router-view>
    </div>
</template>

<script>
    import HeaderNav from "./layout/HeaderNav";

    export default {
        name: "App",
        components: {
            HeaderNav,
        },
        data () {
            return {
                isHidden: false
            }
        },
    }

</script>
<style scoped>
</style>
