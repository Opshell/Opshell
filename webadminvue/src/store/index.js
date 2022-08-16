import { createStore } from "vuex";

export default createStore({
    state: {
        // 存放所有需要共用的變數
        isLoading: false, // 是否處於Loading狀態
        isLogin: false, // 是否有登入
        userData: {
            // 登入資訊
            name: "",
            /** 使用者權限劃分
             *  0 最高管理者
             *  1 網站管理者
             *  2 一般使用者
             *  3 訪客
             */
            auth: "3",
        },
        redirect: "",
        route: {
            from: null,
            to: null
        },
        pageData: {},
    },
    getter: {},
    mutations: { // 變動 state 用(只能同步)
        startLoading(state) { state.isLoading = true; },
        endLoading(state) { state.isLoading = false; },
        signin(state) {
            state.isLogin = !state.isLogin;
        },
        setUser(state, userData) {
            // 記錄登入者資訊
            state.userData.user = userData.user;
            state.userData.name = userData.name;
            state.userData.auth = userData.auth;
        },
        setRedirect(state, redirect) {// 導向紀錄
            state.redirect = redirect;
        },
        setRouteFrom(state, from) {// 導向紀錄
            state.route.from = from;
        },
        setRouteTo(state, to) {// 導向紀錄
            state.route.to = to;
        },
        setPage(state, pageData) {
            state.pageData = pageData;
        },
    },
    actions: {
        // 變動state 用(可非同步)
    },
    modules: {},
});
