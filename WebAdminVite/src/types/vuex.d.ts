import '@vue/runtime-core';

import { iRouteState } from '@/store/modules/route'; // 路由相關
import { iUserState } from '@/store/modules/user'; // 登入、使用者相關

declare module '@vue/runtime-core' {
    // 宣告vuex內部的 store state
    interface State {
        user: iUserState;
        route: iRouteState;
    }

    // 宣告 `this.$store` 型別
    interface ComponentCustomProperties {
        $store: Store<State>;
    }
}
