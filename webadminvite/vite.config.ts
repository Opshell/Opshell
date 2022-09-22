import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import AutoImport from 'unplugin-auto-import/vite';
import Components from 'unplugin-vue-components/vite';
import { NaiveUiResolver } from 'unplugin-vue-components/resolvers';
import path from 'path';

// https://vitejs.dev/config/
export default defineConfig({
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'src')
        }
    },

    plugins: [
        vue({

        }),
        Components({
            dirs: [ 'src/components', 'src/views' ], // 指定components位置 預設是'src/components'
            dts: 'src/types/components.d.ts', // .d.ts生成位置
            // resolvers: [ NaiveUiResolver() ] // 解析規則
         }),
        AutoImport({ // targets to transform
            // global imports to register
            imports: [ // presets
                'vue',
                'vue-router',
                'vuex',
                {// custom
                    '@vueuse/core': [
                        // named imports
                        'useMouse', // import { useMouse } from '@vueuse/core',
                        // alias
                        ['useFetch', 'useMyFetch'], // import { useFetch as useMyFetch } from '@vueuse/core',
                    ],
                    'axios': [ // 整包 axios import
                        ['default', 'axios'], // import { default as axios } from 'axios',
                    ],
                    'vue': [
                        'PropType', 'defineProps'
                    ]
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
    ],

    // 代理伺服器
    server: {
        port: 8080,
        strictPort: false, // Port被占用時直接退出， false會嘗試連接下一個可用Port
        open: true, // dev時自動打開網頁，也可以給網址指定。
        // 自訂代理規則，配合後端進行Api呼叫等。
        // 預設使用 [http-proxy](https://github.com/http-party/node-http-proxy) 完整設定請見官方
        proxy: {
            '/api': {
                target: "http://www.opshell/api/", // 本機串接
                ws: true, // 代理的WebSockets
                changeOrigin: true, // 允許websockets跨域
                rewrite: (path) => path.replace(/^\/api/, '')
            },
        }
    },

    // SCSS
    css: {
        preprocessorOptions: {
            scss: { // 設定全域SCSS
                additionalData: '@import "@/assets/scss/stylesheet.scss";'
            }
        }
    },

    build: {
        outDir: '../WebAdmin/', // 指定輸出位置(相對於project根目錄).
    }
});
