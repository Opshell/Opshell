module.exports = {
    env: {
        "vue/setup-compiler-macros": true,
        browser: true, // 瀏覽器全域變數
        es2021: true,
        node: true, // Node.js 全域變數 和 Node.js 作用域。
        'vue/setup-compiler-macros': true, // 啟用setup語法糖環境
    },
    // 繼承套件的規則設定
    extends: [
        './.eslintrc-auto-import.json', // `unplugin-auto-import` 生成的規則設定
        'plugin:vue/vue3-recommended',
        'plugin:@typescript-eslint/recommended',
        'plugin:prettier/recommended',
        'prettier'
    ],
    // parser 解析依賴設定
    parser: 'vue-eslint-parser',
    parserOptions: {
        ecmaVersion: 2021, // 設定ECMAScript版本
        sourceType: 'module', // 設定原始碼類型
        parser: {
            '@typescript-eslint/parser', // 設定解析器
            ts: "@typescript-eslint/parser",
            '<template>': 'espree',
        },
        'vueFeatures': { // 指定如何解析與 Vue 功能相關
            'filter': true,
            'interpolationAsNonHTML': true,
            'styleCSSVariableInjection': true,
        }
        // ecmaFeatures: {} // 其他語言擴展，包含jsx、全域嚴格模式等
    },

    // 自訂規則
    rules: {
        'no-undef': 'off',
        'no-console': 'off',
        'no-debugger': 'off',
        'vue/no-v-html': 'off',
    }
}