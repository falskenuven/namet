<template>
    <div class="posts">
        <p v-if="laravelData.length">No posts</p>
        <div>
            <div class="post" v-for="post in laravelData.data" :key="post.id">
                <a :href="'/post/read/'+ post.id" class="title">{{ post.title}} </a>  
                <!-- <div v-html="post.article"></div> -->
                <div class="text" v-html="$options.filters.cut(post.article)"></div>
                <div class="center">
                    <a :href="user.profileLink" class="username" >{{ user.name }}</a>
                    <span>{{ post.createdDate }}</span>
                </div>
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
        font-size: 1.2em;
        color: #39004d;
        
    }
    .title {
        font-size: 2em;
        font-family: fantasy;
        font-weight: bold;
        border-bottom: 5px solid #085F06;
        color: #085F06;
    }
    .post {
        font-size: 0.8em;
        color: #000A13;
        border-top: 1px grooved #06335F; 
        padding: 10px;
        margin-bottom: 20px;
        background: #AECCFA;
        border: 2px solid #06333b;
        border-radius: 5px;
    }
    .center {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .posts {
        padding-left: 20px;
    }
    .posts span {
        color: black;
        
    }
    .text{
        font-size: 1.5em;
        background: #AECCFA;

    }
</style>
