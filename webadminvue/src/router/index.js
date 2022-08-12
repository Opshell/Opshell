import { createRouter, createWebHistory } from "vue-router";
import axios from "axios";
import store from "../store";
import Home from "../views/Home.vue";
// import Cookies from "js-cookie";

const routes = [
    {
        name: "Login",
        path: "/login",
        component: () => import("../views/Login.vue"),
    }, {
        name: "Dashboard",
        path: "/dashboard",
        component: () => import("../views/Dashboard.vue"),
        meta: { requireAuth: true },
    }, {
        name: "IconList",
        path: "/iconList",
        component: () => import("../views/IconList.vue"),
        meta: { requireAuth: true },
    }, {
        name: "News",
        path: "/news",
        component: () => import("../views/News.vue"),
        meta: { requireAuth: true },
    }, {
        name: "Section",
        path: "/section",
        component: () => import("../views/Section.vue"),
        meta: { requireAuth: true },
    }, {
        name: "NewsInfo",
        path: "/newsinfo/:newsId",
        component: () => import("../views/NewsInfo.vue"),
        meta: { requireAuth: true },
    }, {
        // Home
        name: "Home",
        path: "/",
        component: Home,
        meta: { requireAuth: true }, // 用來作為此頁是否需要權限驗證的設定
    }, {
        // About
        name: "About",
        path: "/about",
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import(/* webpackChunkName: "about" */ "../views/About.vue"),
        meta: { requireAuth: true }, // 用來作為此頁是否需要權限驗證的設定
    }, {
        // 未定義網址 => 404
        name: "PageNotFound",
        path: "/:pathMatch(.*)*",
        component: () => import("../views/PageNotFound.vue"),
    },
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});

// 在 login 頁面還不能完全做到攔截不正確登入訊息，我們必須在router.js做更進一步處理
router.beforeEach(async (to, from) => {
    // 看看 to 和 from 兩個 arguments 會吐回什麼訊息
    // console.log("to: ", to);
    // console.log("from: ", from);

    store.commit("setRedirect", from.name);

    // 目的路由在meta上是否有設置requireAuth: true
    if (to.meta.requireAuth) {
        const isLogin = store.state.isLogin;

        if (isLogin) {
            // const userDate = store.state.userData;
            const token = localStorage.getItem("token");
            axios({
                url: "/api/auth/verify",
                method: "GET",
                headers: { Authorization: `Bearer ${token}` },
            })
                .then((res) => {
                    if (res.status == 200) {
                        if (res.data.status == "Success") {
                            localStorage.setItem("token", res.data.data);
                            store.commit("setRedirect", "");
                        } else {
                            localStorage.setItem("token", "");
                            return { name: "Login" };
                        }
                    } else {
                        localStorage.setItem("token", "");
                        return { name: "Login" };
                    }
                })
                .catch(() => {
                    localStorage.setItem("token", "");
                    return { name: "Login" };
                });
        } else {
            localStorage.setItem("token", "");
            return { name: "Login" };
        }
    }

    store.commit("setPage", to.name);
});

export default router;
