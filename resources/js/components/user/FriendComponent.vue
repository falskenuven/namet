<template>
    <div>
        <h3>Some interesting Users</h3>
        <div v-for="user in users">
            <a :href="user.profileLink">{{user.name}}</a>
            <img :src="`/upload/${user.avatar}`">
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                users: {}
            }
        },

        mounted() {
            axios.get('/user/random')
                .then(res => {
                    this.users = res.data;
            })
        },

    }
</script>
