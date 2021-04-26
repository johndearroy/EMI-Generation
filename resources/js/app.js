require('./bootstrap');

import Vue from 'vue'

//Main pages
import App from './app.vue'

// Register components
Vue.component('login', require('./pages/auth/login.vue').default);
Vue.component('register', require('./pages/auth/register.vue').default);


const app = new Vue({
    el: '#app',
    components: { App }
});
