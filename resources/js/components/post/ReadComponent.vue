<template>
  <div>
      <span>{{post.title}}</span> |
      <a :href="post.user.profileLink">{{ post.user.name }}</a> 
      <span v-if="my_id == post.user.id">
        |
        <a :href="'/post/edit/'+ post.id" role="button" class="btn btn-light">Edit</a>
        <a @click="delPost(post.id)" role="button" class="btn btn-danger">Delete</a>
      </span>
      <div v-html="post.article"></div>
  </div>
</template>

<script>

export default {
  props: ['post', "my_id"],
  mounted() {
      // console.log(this.post)
  },
  methods: {
    delPost: function(post_id) {
      axios.get(`/post/delete/${post_id}`)
        .then(res => {
          // console.log('deleted');
          window.location.replace('/home');
        });
    },
  }
};
</script>