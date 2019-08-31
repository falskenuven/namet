<template>
    <div id="app" class="editor">
        <div class="field">
          <input type="text" v-model="title" placeholder="Title" class="form-control titl">
          <div class="error" v-if="isTitle">Вибачте, заголовок обов'язковий!</div>
          <vue-editor v-model="content"></vue-editor>
          <div class="error" v-if="isContent">Вибачте, заголовок обов'язковий!</div>
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
      isTitle: false,
      isContent: false,
    };
  },

  props: ['post'],
 
  methods: {
    update: function() {
      if(this.title.trim().length <= 0) {
        this.isTitle = true;
      } else {
        this.isTitle = false;
      }

      if(this.content.toString().replace(/<[^>]*>?/gm, '').trim().length > 0 || this.content.includes('<img')) {
        this.isContent = false;
      } else {
        this.isContent = true;
      }

      if(this.isTitle == false && this.isContent == false) {
        axios.post('/post/update', {post_id: this.post.id, title: this.title, article: this.content, group_id: null}).then(res => {
          // console.log(res.data);
          this.$noty.success('Твір відредаговано!');
        }).catch(e => {
          // console.log(e);
          this.$noty.warning('Перегружено! (приберіть картинку)');
        });
      }
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