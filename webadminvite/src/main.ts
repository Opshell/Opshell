import { createApp } from 'vue';
import App from './App.vue';
import { store, key } from './store';
import router from './router';
import 'virtual:svg-icons-register';
import CKEditor from '@ckeditor/ckeditor5-vue';

const app = createApp(App);
app.use(store, key); // 傳入 Injection key
app.use(router);
app.use(CKEditor);

app.mount('#app');
