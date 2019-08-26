<template>
    <div id="app" class="editor">
        <div class="field">
          <input type="text" v-model="title" placeholder="Title" class="form-control">
          <div class="error" v-if="isTitle">Error. The title is required</div>
          <vue-editor v-model="content"></vue-editor>
          <div class="error" v-if="isContent">Error. The field is required</div>
        </div>
        <div>
            <button class="btn btn-success" @click="saveContent">Save</button>
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
 
  methods: {
    saveContent: function() {
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

        axios.post('/post/save', {title: this.title, article: this.content, group_id: null}).then(res => {
          // console.log(res.data);
          this.content = '';
          this.title = '';
          this.$noty.success('Your post has been saved');
        }).catch(e => {
          // console.log(e);
          this.$noty.warning('Payload Too Large');
        });
      }
    }
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
    .error {
      color: red;
    }
</style>