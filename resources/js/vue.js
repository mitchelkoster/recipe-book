import { createApp } from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'

import recipesCreate from './components/recipes-create.vue';
import recipesEdit from './components/recipes-edit.vue';
import tagsCreate from './components/tags-create.vue';
import tagsSearch from './components/tags-search.vue';

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

const appElm = document.getElementById('app');
if (appElm) {
    app.mount(appElm);
}
