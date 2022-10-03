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
        name: 'IconList',
        path: '/iconList',
        component: () => import('@/views/IconList.vue'),
        meta: { title: 'Icon列表' },
    },
];

export default routes;
