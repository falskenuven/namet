<template>
    <div id="app" class="editor">
        <div class="field">
          <input type="text" v-model="title" placeholder="Title" class="form-control titl">
          <div class="error" v-if="isTitle">Будь ласка, введіть назву!</div>
          <vue-editor v-model="content"></vue-editor>
          <div class="error" v-if="isContent">Помилка</div>
        </div>
        <div>
            <button class="btn btn-save" @click="saveContent">Зберегти</button>
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
          this.$noty.success('Твір збережено');
        }).catch(e => {
          // console.log(e);
          this.$noty.warning('Перегружено! Забагато інформації');
        });
      }
    }
  }
};
</script>

<style>
  .btn-save {
    background: #153338;
    color: #dfe9eb;
    border: 1px solid #dfe9eb;

  }
  .titl {
    background: #5f6e70;
    border: 1px solid #17282b;
  } 
  .titl::placeholder {
    color:#1f2121;
  }
  .titl:focus {
    background: #5f6e70;
    color:#1f2121;
  }
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
    color:#152d30;
  }
</style>