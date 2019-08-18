<template>
    <div id="app" class="editor">
        <div class="field">
          <input type="text" v-model="title" placeholder="Title">
          <vue-editor v-model="content"></vue-editor>
            
        </div>
        <div>
            <button @click="update">Update</button>
        </div>
    </div>

</template>

<script>
import { VueEditor } from "vue2-editor";

export default {
  components: {
    VueEditor,
  },
 
  data() {
    return {
      title: '',
      content: '',
    };
  },

  props: ['post'],
 
  methods: {
    update: function() {

      axios.post('/post/update', {post_id: this.post.id, title: this.title, article: this.content, group_id: null}).then(res => {
        console.log(res.data);
      }).catch(e => {
        console.log(e);
      });
    }
  },

  mounted() {
    this.title = this.post.title;
    this.content = this.post.article;
  }
};
</script>

<style>
    .editor {
        display: flex;
        justify-content: space-between;
    }
    .field {
        max-width: 70vw;
    }
    img {
      max-width: 90%;
    }
</style>