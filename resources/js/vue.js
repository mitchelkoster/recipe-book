import { createApp } from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'

import recipesCreate from './components/recipes-create';
import recipesEdit from './components/recipes-edit';
import tagsCreate from './components/tags-create';
import tagsSearch from './components/tags-search';

const app = createApp({});

if (process.env.NODE_ENV === 'production') {
  app.config.devtools = false;
  app.config.performance = false;
} else {
  app.config.devtools = true;
  app.config.performance = true;
}

app.use(VueAxios, axios);
app.component('add-recipe', recipesCreate);
app.component('edit-recipe', recipesEdit);
app.component('tags-create', tagsCreate);
app.component('tags-search', tagsSearch);
app.mount('#app');
