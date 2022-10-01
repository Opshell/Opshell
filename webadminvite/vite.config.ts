import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import AutoImport from 'unplugin-auto-import/vite';
import Components from 'unplugin-vue-components/vite';
import { resolve } from 'path';

// https://vitejs.dev/config/
export default defineConfig({
    resolve: {
        alias: {
            '@': resolve(__dirname, 'src'), // 设置 `@` 指向 `src` 目录
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
                    '@vue/reactivity': ['Ref'],
                    axios: [
                        // 整包 axios import
                        ['default', 'axios'], // import { default as axios } from 'axios',
                    ],
                    vue: ['PropType', 'defineProps'],
                },
            ],
            dirs: [],
            dts: 'src/types/auto-imports.d.ts', // typescript 宣告檔案位置
            vueTemplate: false,
            eslintrc: {
                enabled: true, // Default `false`
                filepath: './.eslintrc-auto-import.json', // Default `./.eslintrc-auto-import.json`
                globalsPropValue: true, // Default `true`, (true | false | 'readonly' | 'readable' | 'writable' | 'writeable')
            },
        }),
        Components({
            dirs: ['src/components', 'src/views'], // 指定components位置 預設是'src/components'
            dts: 'src/types/components.d.ts', // .d.ts生成位置
        }),
    ],

    // 全域 SCSS
    css: {
        preprocessorOptions: {
            scss: {
                additionalData: `@import "@/assets/scss/stylesheet.scss";`,
                charset: false,
            },
        },
    },
});
