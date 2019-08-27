<template>
    <div class="posts">
        <p v-if="laravelData.length">No posts</p>
        <div>
            <div class="post" v-for="post in laravelData.data" :key="post.id">
                <a :href="user.profileLink" class="username" >{{ user.name }}</a>| <a :href="'/post/read/'+ post.id" class="title">{{ post.userntitle}} </a>  | <span>{{ post.createdDate }}</span>
                <hr/>
                <!-- <div v-html="post.article"></div> -->
                <div class="text" v-html="$options.filters.cut(post.article)"></div>
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
        padding: 5px;
        font-size: 1.8em;
        color: #39004d;
    }
    .post {
        font-size: 1em;
        color: #260d26;
        padding: 20px 0;
        border: 20px solid red;
    }
    .posts {
        background: #white;
    }
    .posts span {
        color: black;
    }
</style>