interface iRoute {
    name: string;
    path: string;
    component: () => {};
    meta: {
        title?: string;
        requireAuth?: boolean;
    };
}

const routes: iRoute[] = [
    {
        name: 'HomePage',
        path: '/',
        component: () => import('@/views/HomePage.vue'),
        meta: {},
    },
    {
        name: 'LoginPage',
        path: '/login',
        component: () => import('@/views/LoginPage.vue'),
        meta: { title: '登入' },
    },
    {
        name: 'Dashboard',
        path: '/dashboard',
        component: () => import('@/views/Dashboard.vue'),
        meta: { requireAuth: true, title: '後台總覽' },
    },
    {
        name: 'IconList',
        path: '/iconList',
        component: () => import('@/views/IconList.vue'),
        meta: { requireAuth: true },
    },
    {
        name: 'SectionList',
        path: '/sectionList',
        component: () => import('@/views/SectionList.vue'),
        meta: { requireAuth: true, title: '功能列表' },
    },
    {
        name: 'SectionInfo',
        path: '/sectionInfo/:id',
        component: () => import('@/views/SectionInfo.vue'),
        meta: { requireAuth: true, title: '功能' },
    },
    {
        name: 'ArticleList',
        path: '/articleList',
        component: () => import('@/views/ArticleList.vue'),
        meta: { requireAuth: true, title: '文章列表' },
    },
    {
        name: 'ArticleInfo',
        path: '/articleInfo/:id',
        component: () => import('@/views/ArticleInfo.vue'),
        meta: { requireAuth: true, title: '文章' },
    },
    {
        // 未定義網址 => 404
        name: 'PageNotFound',
        path: '/:pathMatch(.*)*',
        component: () => import('@/views/PageNotFound.vue'),
        meta: { title: '未定義網址' },
    },
    {
        name: 'IconList',
        path: '/iconList',
        component: () => import('@/views/IconList.vue'),
        meta: { title: 'Icon列表' },
    },
];

export default routes;
