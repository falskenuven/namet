<template>
    <div class="container">
        <h3>Some interesting Posts</h3>
        <div class="row">
            <div v-for="post in posts" class="col-md-4">
                <a :href="post.user.profileLink">{{ post.user.name }}</a>
                <a :href="'/post/read/'+ post.id">{{ post.title}} </a>
                <div v-html="$options.filters.shortCut(post.article)"></div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                posts: {}
            }
        },

        mounted() {
            axios.get('/post/random')
                .then(res => {
                    this.posts = res.data;
            })
        },

    }
</script>
