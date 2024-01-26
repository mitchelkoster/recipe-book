import { createApp } from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'

import recipesCreate from './components/recipes-create';
import recipesEdit from './components/recipes-edit';

const app = createApp({});
app.config.devtools = true;
app.use(VueAxios, axios);
app.component('add-recipe', recipesCreate);
app.component('edit-recipe', recipesEdit);
app.mount('#app');
