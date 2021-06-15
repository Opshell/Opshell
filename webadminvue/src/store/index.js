import { createStore } from "vuex";

export default createStore({
    state: {
        // 存放所有需要共用的變數
        isLoading: false, // 是否處於Loading狀態
        redirect: "",
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
        pageData: {
            // 頁面資訊
            title: "測試",
            do: "list",
            breadcrumbs: "",
        },
    },
    getter: {},
    mutations: {
        // 變動 state 用(只能同步)
        Loaded(state) {
            // state的isLoading true/false 互轉
            state.isLoading = !state.isLoading;
        },
        Signin(state) {
            state.isLogin = !state.isLogin;
        },
        SetUser(state, userData) {
            // 記錄登入者資訊
            state.userData.name = userData.username;
            state.userData.auth = 0;
        },
        setRedirect(state, redirect) {
            // 導向紀錄
            state.redirect = redirect;
        },
        setPage(state, name) {
            // 導向紀錄
            state.pageData.title = name;
        },
    },
    actions: {
        // 變動state 用(可非同步)
    },
    modules: {},
});
