<template>
    <div>
    	<h2>Find and delete Post</h2>
        <input type="text" v-model="title" @input="changeTitle">
        <div v-for="post in posts">
        	<div>
        		{{post.id}} | {{post.title}} | {{post.user.name}}
				 <a role="button" class="btn btn-danger" @click="delPost(post.id)">del</a>
        	</div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                title: '',
                posts: {},
            }
        },

        mounted() {
            
        },

        methods: {
            changeTitle(event) {
            	if(event.target.value.trim().length  != 0) { 

	                axios.post('/post/find', {search: event.target.value})
	                    .then((res => {
	                        this.posts = res.data;
	                    }));
                } else {
                	this.posts = {};
                }
            },

            delPost(id) {
                axios.get(`/post/delete/${id}`)
                    .then((res => {
                        console.log('deleted');
                    }));
                this.title = '';
                this.posts = {};
            },
        }
    }
</script>
