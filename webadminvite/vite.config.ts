import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import AutoImport from 'unplugin-auto-import/vite';
import Components from 'unplugin-vue-components/vite';
import { createSvgIconsPlugin } from 'vite-plugin-svg-icons';
import { resolve } from 'path';

// https://vitejs.dev/config/
export default defineConfig({
    resolve: {
        alias: {
            '@': resolve(__dirname, 'src'), // 設定路徑別名 '@'指向'src'目录
        },
    },
    plugins: [
        vue(),
        AutoImport({
            // targets to transform
            // global imports to register
            imports: [
                // presets
                'vue',
                'vue-router',
                'vuex',
                {
                    // custom
                    '@vueuse/core': [
                        // named imports
                        'useMouse', // import { useMouse } from '@vueuse/core',
                        // alias
                        ['useFetch', 'useMyFetch'], // import { useFetch as useMyFetch } from '@vueuse/core',
                    ],
                    // '@vue/reactivity': ['Ref'],
                    axios: [
                        // 整包 axios import
                        ['default', 'axios'], // import { default as axios } from 'axios',
                    ],
                    vue: ['PropType', 'defineProps', 'InjectionKey', 'Ref'],
                },
            ],
            dirs: [],
            dts: 'src/types/auto-imports.d.ts', // typescript 宣告檔案位置
            vueTemplate: false,
            eslintrc: {
                enabled: false, // Default `false`
                filepath: './.eslintrc-auto-import.json', // Default `./.eslintrc-auto-import.json`
                globalsPropValue: true, // Default `true`, (true | false | 'readonly' | 'readable' | 'writable' | 'writeable')
            },
        }),
        Components({
            dirs: ['src/components', 'src/views'], // 指定components位置 預設是'src/components'
            // include: [/\.vue$/],
            dts: 'src/types/components.d.ts', // .d.ts生成位置
            extensions: ['vue'],
        }),
        createSvgIconsPlugin({
            iconDirs: [resolve(process.cwd(), 'src/assets/icons')], // 指定需要占存的Icon目錄
            symbolId: '[name]', // 指定symbolId格式 預設：'icon-[dir]-[name]

            inject: 'body-last', // | 'body-first' sprite插入位置
            customDomId: '__svg__icons__dom__', // 自訂 Dom ID
        }),
    ],
    base: '/WebAdmin/', // 部署到非根目錄時使用
    // 代理伺服器
    server: {
        port: 8080,
        strictPort: false, // Port被占用時直接退出， false會嘗試連接下一個可用Port
        open: true, // dev時自動打開網頁，也可以給網址指定。
        // 自訂代理規則，配合後端進行Api呼叫等。
        // 預設使用 [http-proxy](https://github.com/http-party/node-http-proxy) 完整設定請見官方
        proxy: {
            '/api': {
                target: 'http://www.opshell/api/', // 本機串接
                ws: true, // 代理的WebSockets
                changeOrigin: true, // 允許websockets跨域
                rewrite: (path) => path.replace(/^\/api/, ''),
            },
        },
    },
    // 全域 SCSS
    css: {
        preprocessorOptions: {
            scss: {
                additionalData: `@import "@/assets/scss/stylesheet.scss";`,
                charset: false,
            },
        },
    },
    build: {
        outDir: '../WebAdmin/', // 指定輸出位置(相對於project根目錄).
    },
});
