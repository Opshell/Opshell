import { createStore } from "vuex";
import user from "./user"; // 登入、使用者相關
import route from "./route"; // 路由相關

export default createStore({
    state: {},
    getter: {},
    actions: {}, // 變動state 用(可非同步)
    mutations: { // 變動 state 用(只能同步)

    },
    modules: { user, route },
});
