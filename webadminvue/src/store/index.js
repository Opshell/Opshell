import { createStore } from "vuex";
import user from "./user"; // 登入、使用者相關

export default createStore({
    state: {
        // 存放所有需要共用的變數
        isLoading: false, // 是否處於Loading狀態
        redirect: "",
        route: {
            from: null,
            to: null
        },
        pageData: {},
    },
    getter: {},
    actions: { // 變動state 用(可非同步)

    },
    mutations: { // 變動 state 用(只能同步)
        startLoading(state) { state.isLoading = true; },
        endLoading(state) { state.isLoading = false; },
        setRedirect(state, redirect) { // 導向紀錄
            state.redirect = redirect;
        },
        setRouteFrom(state, from) { // 導向紀錄
            state.route.from = from;
        },
        setRouteTo(state, to) { // 導向紀錄
            state.route.to = to;
        },
        setPage(state, pageData) {
            state.pageData = pageData;
        },
    },
    modules: { user },
});
