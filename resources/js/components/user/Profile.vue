<template>
    <div>
        <div class="d-flex justify-content-center">
<!--            @if($avatar!=null)-->
            <img :src="src" alt="something that I can't show you" width="250px">
<!--                 alt="{{asset('storage/avatars/avatar-of-user'.\Illuminate\Support\Facades\Auth::id().'/' . $avatar->user_avatar_name)}}" width="250px">-->
<!--            @endif-->
        </div>

<!--        <form method="post" action="{{route('avatar.store')}}" enctype = "multipart/form-data">-->
<!--            @csrf-->
<!--            <input type="file" name="img">-->
<!--            <input type="submit">-->
<!--        </form>-->

        <div>
<!--            <a href="{{route('user-wall.index'/*, ['id' => Auth::id()]*/)}}">-->
                Wall
            <button type="button">Hello</button>
<!--            </a>-->
        </div>
    </div>
</template>

<script>
    export default {
        name: "Profile",
        data:()=>{
          return {
              src: ''
          }
        },

        mounted() {
            this.getImage();
        },
        methods: {
            getImage(){
                //console.log(this.$userId);

                this.$store.dispatch('users/profileAvatar').then((res) => {
                    console.log('/storage/avatars/avatar-of-user'+this.$userId+'/'+res)
                    this.src = '/storage/avatars/avatar-of-user'+this.$userId+'/'+res;
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
