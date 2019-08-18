<template>
    <div class="container">
        <p v-if="!following.length">No Following</p>
        <div class="media" v-for="user in following" :key="user.id">
            <img class="mr-3" />
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
                following: []
            }
        },
        props: ['user'],
        mounted() {
            // console.log('user', this.user);
            axios.post('/following/list', {'id': this.user.id})
                .then(res => {
                    // console.log(res.data.following);
                    this.following = res.data.following;
            });
        }
    }
</script>
