import { RouteLocationNormalized } from "vue-router";

export interface iPageData {
    [key: string]: string
}
export interface iRouteState {
    isLoading: Boolean, // 是否處於Loading狀態
    redirect: string,
    route: {
        from: RouteLocationNormalized | null,
        to: RouteLocationNormalized | null
    },
    pageData: iPageData,
}

export default {
    namespaced: true,
    state: {
        isLoading: false,
        redirect: "",
        route: {
            from: null,
            to: null
        },
        pageData: {},
    },
    mutations: { // 變動 state 用(只能同步)
        startLoading(state: iRouteState) { state.isLoading = true; },
        endLoading(state: iRouteState) { state.isLoading = false; },
        setRedirect(state: iRouteState, redirect: string) { // 導向紀錄
            state.redirect = redirect;
        },
        setRouteFrom(state: iRouteState, from: RouteLocationNormalized) { // 導向紀錄
            state.route.from = from;
        },
        setRouteTo(state: iRouteState, to: RouteLocationNormalized) { // 導向紀錄
            state.route.to = to;
        },
        setPage(state: iRouteState, pageData: iPageData) {
            state.pageData = pageData;
        },
    },
}