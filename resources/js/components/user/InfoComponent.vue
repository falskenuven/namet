<template>
    <div>
        <h2>{{user.name}}</h2>
        <img :src="`/upload/${user.avatar}`">
        <div>Bio: {{user.bio}}</div>
        <div>Location: {{user.location}}</div>
        <div v-if="isBlock">Your account is unavailable until  {{user.disabled}}</div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
            }
        },

        props: ['user'],

        computed: {
            isBlock: function () {
                let today = new Date();
                let dd = today.getDate();
                let mm = today.getMonth() + 1;
                var yyyy = today.getFullYear();

                if (dd < 10) {
                  dd = '0' + dd;
                } 
                if (mm < 10) {
                  mm = '0' + mm;
                } 
                let date = yyyy + '-' + mm + '-' + dd;
                return this.user.disabled > date;
            }
        }

    }
</script>
