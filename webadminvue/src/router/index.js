import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Cookies from 'js-cookie'

const routes = [
    {
        path: '/login',
        name: 'Login',
        component: () => import('../views/Login.vue'),
    },
    {
        path: '/',
        name: 'Home',
        component: Home,
        meta: { requireAuth: true }, // 用來作為此頁是否需要權限驗證的設定
    },
    {
        path: '/about',
        name: 'About',
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () =>
            import(/* webpackChunkName: "about" */ '../views/About.vue'),
        meta: { requireAuth: true }, // 用來作為此頁是否需要權限驗證的設定
    },
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
})

// 在 login 頁面還不能完全做到攔截不正確登入訊息，我們必須在router.js做更進一步處理
router.beforeEach(async (to, from) => {
    // 看看 to 和 from 兩個 arguments 會吐回什麼訊息
    console.log('to: ', to)
    console.log('from: ', from)

    // 目的路由在meta上是否有設置requireAuth: true
    if (to.meta.requireAuth) {
        // 獲取Cookies當中的login資訊並取得token
        const info = Cookies.get('login')

        if (info) {
            const token = JSON.parse(info).token
            // 如果token不為空，且確實有這個欄位則讓路由變更
            if (token.length == 0 || token === undefined) {
                // 未通過則導回login頁面
                return { name: 'Login' }
            }
        } else {
            return { name: 'Login' }
        }
    }
})

export default router
