import { Base64 } from "js-base64";

export const state = {
    isLogin: false, // 是否有登入
    jwtToken: '',
    userData: {
        // 登入資訊
        user: '',
        name: '',
        /** 使用者權限劃分 permission level
         *  0 最高管理者 全開
         *  1 網站管理者
         *  2 一般使用者
         *  3 訪客
         */
        auth: '3',
    },
};
export const actions = {};// 非同步
export const mutations = { // 同步
    signIn(state) { state.isLogin = true; },
    signOut(state) { state.isLogin = false; },
    /** 將登入後的 Token 轉 成userData
     * @param {*} state
     * @param {JWT} JWT
     */
    setUser(state, JWT) {
        state.jwtToken = JWT;

        // JWT = header.payload.Signature
        const Token = JWT.split("."); // 解析使用者資料
        const data = JSON.parse(Base64.decode(Token[1]));

        // 記錄登入者資訊
        state.userData.user = data.user;
        state.userData.name = data.name;
        state.userData.auth = data.auth;
    },
};
export const getters = {
    isAuthenticated: state => !!state.user || !!sessionStorage.getItem("user"),
};

export default {
    state,
    getters,
    actions,
    mutations,
    namespaced: true,
};