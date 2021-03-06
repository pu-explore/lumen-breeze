require('./bootstrap');

import {createApp} from 'vue';
import App from '@/layouts/App.vue';
import router from '@/router';
import store from '@/store';

const app = createApp(App);
app.use(store);
app.use(router);
app.mount('#app');
