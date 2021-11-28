import { createApp } from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'

import recipesCreate from './components/recipes-create';

const app = createApp({});
app.use(VueAxios, axios)
app.component('add-recipe', recipesCreate);
app.mount('#app');
