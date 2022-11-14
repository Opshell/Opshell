import { createRouter, createWebHistory } from 'vue-router';
import { store } from '@/store';

import routes from './routes'; // 路由列表

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
});

// 在 login 頁面還不能完全做到攔截不正確登入訊息，我們必須在router.js做更進一步處理
router.beforeEach(async (to, from) => {
    store.commit('route/setRouteFrom', from);
    store.commit('route/startLoading'); // 開啟遮罩
    // 目的路由在meta上是否有設置requireAuth: true
    if (to.meta.requireAuth) {
        const isLogin = store.state.user.isLogin;

        if (isLogin) {
            const token = localStorage.getItem('token');
            axios({
                url: '/api/auth/verify',
                method: 'GET',
                headers: { Authorization: `Bearer ${token}` },
            })
                .then((res) => {
                    if (res.status == 200) {
                        if (res.data.status == 'Success') {
                            localStorage.setItem('token', res.data.data);
                            store.commit('route/setRedirect', '');
                        } else {
                            localStorage.setItem('token', '');
                            return { name: 'LoginPage' };
                        }
                    } else {
                        localStorage.setItem('token', '');
                        return { name: 'LoginPage' };
                    }
                })
                .catch(() => {
                    localStorage.setItem('token', '');
                    return { name: 'LoginPage' };
                });
        } else {
            localStorage.setItem('token', '');
            return { name: 'LoginPage' };
        }
    }

    store.commit('route/setRouteTo', to);
});

export default router;
