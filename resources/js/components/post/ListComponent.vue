<template>
    <div class="col-md-8 posts">
        <p v-if="laravelData.length">No posts</p>
        <div>
            <div class="post" v-for="post in laravelData.data" :key="post.id">
                <a :href="user.profileLink">{{ user.name }}</a>| {{ post.title}}  | {{ post.createdDate }}
                <hr/>
                <div>
                    <a :href="'/post/edit/'+ post.id" role="button" class="btn btn-light">Edit</a>
                    <a @click="delPost(post.id)" role="button" class="btn btn-danger">Delete</a>
                </div>
                <!-- <div v-html="post.article"></div> -->
                <div v-html="$options.filters.cut(post.article)"></div>
            </div>
        </div>

        <pagination :data="laravelData" @pagination-change-page="getResults"></pagination>

    </div>
</template>
<script>

export default {
    data() {
        return {
            laravelData: {},
        }
    },

    props: ['user'],

    mounted() {
        this.getResults(1);
    },

    methods: {
        delPost: function(post_id) {
            axios.get(`/post/delete/${post_id}`)
                .then(res => {
                    // console.log('deleted');
                });
            
        },

        getResults(page) {
            axios.post(`/post/list/${page}`, {id: this.user.id})
                .then(response => {
                    this.laravelData = response.data;
                });
        }
    },

}
</script>

<style>
    .hidden {
        background: red;
    }
    .post {
        padding: 10px 0;
    }
</style>