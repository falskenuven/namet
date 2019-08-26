<template>
    <div class="posts">
        <p v-if="laravelData.length">No posts</p>
        <div>
            <div class="post" v-for="post in laravelData.data" :key="post.id">
                <a :href="user.profileLink" class="username" >{{ user.name }}</a>| <a :href="'/post/read/'+ post.id" role="button">{{ post.title}} </a>  | {{ post.createdDate }}
                <hr/>
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

    props: ['user', 'my_id'],

    mounted() {
        this.getResults(1);
    },

    methods: {
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
    .username {
        font-size: 2em;
        color: #15091B;
    }
    .post {
        padding: 10px 0;
    }
    .posts {
        background: #E4CCAF;
    }
</style>