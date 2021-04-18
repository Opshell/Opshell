import { createStore } from "vuex";

export default createStore({
    state: {
        Signing: false, // 是否有登入
        isLoading: false, // 是否處於Loading狀態
    },
    mutations: { // 變動 state 用
        Loaded(state) { // state的isLoading true/false 互轉
            state.isLoading = !state.isLoading
        },
        Signin(state){
            state.Signing = !state.isLoading
        }
    },
    actions: {},
    modules: {},
});
