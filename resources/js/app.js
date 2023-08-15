require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


import Vue from 'vue/dist/vue.js';

import VueChatScroll from 'vue-chat-scroll';

Vue.use(VueChatScroll);


// Use Import syntax for laravel mix 5  and above
import Chat from '../component/Chat.vue';

Vue.component('Chat', Chat)

const app = new Vue({
    el: '#app'
})
