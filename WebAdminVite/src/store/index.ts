// import { InjectionKey } from 'vue';
import { createStore, useStore as baseUseStore, Store } from 'vuex';

import { iRouteState } from './modules/route'; // 路由相關
import { iUserState } from './modules/user'; // 登入、使用者相關

export interface State {
    // state: {
    //     route: iRouteState;
    //     user: iUserState;
    // };
    user: iUserState;
    route: iRouteState;
}

// 全部模組導入
let modules = {};
const modulesFiles = import.meta.glob('./modules/*.ts', { eager: true, import: 'default' });
for (const path in modulesFiles) {
    const moduleName = path.replace(/(.*\/)*([^.]+).*/gi, '$2');

    modules = {
        ...modules,
        [moduleName]: modulesFiles[path],
    };

    // 未來想實現 批量載入 interface State
    // const faceName: string = `i${moduleName[0].toUpperCase() + moduleName.slice(1)}State`;
    // interface State {
    //     [moduleName]: modulesFiles[path].[faceName]
    // }
}

export const key: typeof InjectionKey<Store<State>> = Symbol();
export const store = createStore<State>({
    modules,
});

// 定義自己的 `useStore` composition(組合式) API
export function useStore() {
    return baseUseStore(key);
}
