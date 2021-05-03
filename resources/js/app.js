require('./bootstrap');

// Import Vue
import Vue from 'vue';
import App from './components/recipes-create';

const app = new Vue({
    el: '#app',
    components: { App }
});

require('alpinejs');
