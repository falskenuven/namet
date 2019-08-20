/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Notifications from 'vue-notification';

Vue.use(Notifications);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('form-component', require('./components/post/FormComponent.vue').default);
Vue.component('list-component', require('./components/post/ListComponent.vue').default);
Vue.component('fo-list-component', require('./components/post/FoListComponent.vue').default);
Vue.component('following-component', require('./components/user/FollowingComponent.vue').default);
Vue.component('follow-component', require('./components/user/FollowComponent.vue').default);
Vue.component('form-edit-component', require('./components/post/FormEditComponent.vue').default);
Vue.component('admin-index-component', require('./components/admin/IndexComponent.vue').default);
Vue.component('chat-index-component', require('./components/chat/IndexComponent.vue').default);


Vue.filter('cut', function (value) {
  if (!value) return '';
  length = 140;
  value = value.toString().replace(/<[^>]*>?/gm, '');
  slice = value.slice(0, length);
  if(value.length > length) slice+= '...'
  return slice;
})
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
