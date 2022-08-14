import { createApp } from "vue";

import axios from "axios";
import VueAxios from "vue-axios";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import plugin from "./plugin";
// import { getData } from "./composition/getData"
import opsLib from "./assets/js/opshellLibary"; // 全部具名匯出到 opsLib


createApp(App)
    .use(VueAxios, axios)
    // .use(getData)
    .use(store)
    .use(router)
    .use(plugin, { imports: [] })
    .use(opsLib)
    .mount("#app");
