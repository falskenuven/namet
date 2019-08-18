<template>
    <div class="container">
        <div v-if="this.user.id != this.my_id">
            <div v-if="canFollow">
                <a @click="follow" class="btn btn-success">Follow</a>
            </div>
            <div v-if="!canFollow">
                <a @click="unFollow" class="btn btn-danger">No Follow</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                canFollow: null
            }
        },

        props: ['user', 'my_id', 'following'],

        mounted() {
            axios.post('/can/follow', this.user)
                .then(res => {
                    if(res.data == 0) {
                        this.canFollow = true;
                    } else {
                        this.canFollow = false;
                    }
            })
        },

        methods: {
            follow: function() {
                axios.get(`/users/follow/${this.user.id}`)
                    .then(res => {
                        res.data.res
                            this.canFollow = !this.canFollow;
                    })
            },

            unFollow: function() {
               axios.get(`/users/unfollow/${this.user.id}`)
                    .then(res => {
                        if (res.data.res)
                            this.canFollow = !this.canFollow;
                    }) 
            }
        }
    }
</script>
