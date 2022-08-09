import { createApp } from "vue";

import axios from "axios";
import VueAxios from "vue-axios";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import plugin from "./plugin";
// import { getData } from "./composition/getData"


// // webpack 一次性匯入 SVG
// const requireAll = requireContext => requireContext.keys().map(requireContext);
// // import所有符合條件的svg 參數：路徑、是否import子資料夾、正則
// const req = require.context("@/assets/icons", true, /\.svg$/);
// requireAll(req);

// // 全域註冊 SVG
// import svgIcon from "@/components/el-svgIcon";
// // Vue.component("icon", SvgIcon);

createApp(App)
    .use(VueAxios, axios)
    // .use(getData)
    .use(store)
    .use(router)
    .use(plugin, { imports: [] })
    .mount("#app");
