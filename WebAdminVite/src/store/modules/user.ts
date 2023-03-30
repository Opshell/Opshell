import { Base64 } from 'js-base64';

// 把使用者權限列舉起來
enum PERMISSION_LEVEL {
    TOP_MANAGEMENT, // 0 最高管理者 全開
    MANAGER, // 1 網站管理者
    USER, // 2 一般使用者
    VISITOR, // 3 訪客
}

// 宣告、並匯出user的State
export interface iUserState {
    isLogin: boolean; // 是否有登入
    jwtToken: string;
    userData: {
        user: string;
        name: string;
        auth: PERMISSION_LEVEL;
    };
}

export default {
    namespaced: true,
    state: {
        isLogin: false,
        jwtToken: '',
        userData: {
            user: '',
            name: '',
            auth: PERMISSION_LEVEL.VISITOR,
        },
    },
    // 把state通通補上型別
    mutations: {
        // 同步
        signIn(state: iUserState) {
            state.isLogin = true;
        },
        signOut(state: iUserState) {
            state.isLogin = false;
        },
        /** 將登入後的 Token 轉 成userData
         * @param {*} state
         * @param {JWT} JWT
         */
        setUser(state: iUserState, JWT: string) {
            state.jwtToken = JWT;

            // JWT = header.payload.Signature
            const Token = JWT.split('.'); // 解析使用者資料
            const data = JSON.parse(Base64.decode(Token[1]));

            // 記錄登入者資訊
            state.userData.user = data.user;
            state.userData.name = data.name;
            state.userData.auth = data.auth;
        },
    },
    getters: {
        // 這邊順便被提醒state.user 不存在，把userData補上去。
        isAuthenticated: (state: iUserState) => !!state.userData.user || !!sessionStorage.getItem('user'),
    },
};
