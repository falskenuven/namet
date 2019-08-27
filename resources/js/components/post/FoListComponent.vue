<template>
    <div>
        <hr />
        <p v-if="!posts.length">No posts</p>
        <div class="media" v-for="post in posts" :key="post.id">
            <img class="mr-3" />
            <div class="media-body">
                <div class="mt-3">
                    <a :href="post.user.profileLink">
                    {{ post.user.name }}</a> | {{ post.createdDate }}
                </div>
                <a :href="'/post/read/'+ post.id">{{ post.title}} </a>
                <div v-html="$options.filters.cut(post.article)"></div>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    data() {
        return {
            posts: [],
        }
    },
    mounted() {
        axios.get('/posts')
            .then((res => {
                this.posts = res.data;
            }));

    },

}
</script>