<template>
    <div id="app" class="editor">
        <div class="field">
          <input type="text" v-model="title" placeholder="Title">
          <vue-editor v-model="content"></vue-editor>
            
        </div>
        <div>
            <button @click="saveContent">Save</button>
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
 
  methods: {
    saveContent: function() {
      console.log(this.content);
      axios.post('/post/save', {title: this.title, article: this.content, group_id: null}).then(res => {
        console.log(res.data);
        this.content = '';
        this.title = '';
      }).catch(e => {
        console.log(e);
      });
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
</style>