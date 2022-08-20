const routes = [
    {
        name: "Login",
        path: "/login",
        component: () => import("../views/Login.vue"),
            meta: { title: '登入' },
    }, {
    name: "Dashboard",
        path: "/dashboard",
            component: () => import("../views/Dashboard.vue"),
                meta: { requireAuth: true, title: '後台總覽' },
}, {
    name: "IconList",
        path: "/iconList",
            component: () => import("../views/IconList.vue"),
                meta: { requireAuth: true },
}, {
    name: "SectionList",
        path: "/sectionList",
            component: () => import("../views/SectionList.vue"),
                meta: { requireAuth: true, title: "功能列表" },
}, {
    name: "SectionInfo",
        path: "/sectionInfo/:id",
            component: () => import("../views/SectionInfo.vue"),
                meta: { requireAuth: true, title: "功能" },
}, {
    name: "ArticleList",
        path: "/articleList",
            component: () => import("../views/ArticleList.vue"),
                meta: { requireAuth: true, title: "文章列表" },
}, {
    name: "ArticleInfo",
        path: "/articleInfo/:id",
            component: () => import("../views/ArticleInfo.vue"),
                meta: { requireAuth: true, title: "文章" },
}, {
    // 未定義網址 => 404
    name: "PageNotFound",
        path: "/:pathMatch(.*)*",
            component: () => import("../views/PageNotFound.vue"),
    },
];

export default routes;