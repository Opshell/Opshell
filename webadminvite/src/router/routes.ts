interface iRoute {
    name: string,
    path: string,
    component: () => {},
    meta: {
       title?: string,
       requireAuth?: boolean,
    }
}

const routes: iRoute[] = [
    {// Home
        name: "Home",
        path: "/",
        component: () => import('@/views/Home.vue'),
        meta: { },
    }, {
        name: "Login",
        path: "/login",
        component: () => import('@/views/Login.vue'),
        meta: { title: '登入' },
    }
];

export default routes;