<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <router-link class="navbar-brand" to="login">Ci4 Login</router-link>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <!--        <a class="nav-link " aria-current="page" href="{{route('user.profile.index')}}">Dashboard</a>-->
                            <router-link to="" class="nav-link">DashBoard</router-link>
                            <!--                        <router-view></router-view>-->
                        </li>
                        <li class="nav-item">
                            <!--            <a class="nav-link {{ Route::currentRouteNamed('user.profile.show') ? 'active' : '' }}" href="{{route('user.profile.index')}}">Profile</a>-->
                            <!--            <profile></profile>-->
                            <router-link to="user-profile" class="nav-link">Profile</router-link>
                            <!--                        <router-view></router-view>-->
                        </li>
                        <li class="nav-item">
                            <div @click.prevent v-on:click="logout" class="nav-link">Logout</div>
                        </li>
                    </ul>
                    <!--                    <form action="/logout" method="post" class="navbar-nav my-2 my-lg-0">-->
                    <!--                        @csrf-->
                    <!--                        <input type="submit" value="logout" class="nav-item">-->
                    <!--                    </form>-->
                    <!--                    <a href="#" @click.prevent="logout" class="nav-item">logout</a>-->
                    <!--                    <button v-on:click="logout" class="nav-item">logout</button>-->
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        name: "HeaderNav",
        data: () => ({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }),
        computed: {
            ...mapGetters('comments', ['comment']),
        },
        mounted() {
            console.log(this.comment);
        },
        methods: {
            logout() {
                this.$store.dispatch("users/logout").then((res) => {
                    //console.log(res)
                    Vue.prototype.$userId = null;
                    this.$router.push('/login');
                });
            },
        },
    }
</script>

<style scoped>

</style>
