<template>
    <div class="container">
        <p v-if="!followers.length">No Followers</p>
        <div class="media" v-for="user in followers" :key="user.id">
            <div class="media-body">
                <hr/>
                <div class="mt-3">
                    <a :href="user.profileLink">
                    {{ user.name }}</a>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                followers: []
            }
        },
        mounted() {
            // console.log('user', this.user);
            axios.get('/followers/list')
                .then(res => {
                    // console.log(res.data.followers);
                    this.followers = res.data.followers;
            });
        }
    }
</script>
