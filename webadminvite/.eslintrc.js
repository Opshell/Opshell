module.exports = {
    // parser 解析依賴設定
    parser: 'vue-eslint-parser',
    parserOptions: {
        parser: '@typescript-eslint/parser', // 設定解析器
        ecmaVersion: 2020, // 設定ECMAScript版本
        sourceType: 'module', // 設定原始碼類型
        ecmaFeatures: {} // 其他語言擴展，包含jsx、全域嚴格模式等
    },
    // 繼承套件的規則設定
    extends: [
        './.eslintrc-auto-import.json', // `unplugin-auto-import` 生成的規則設定
        'plugin:vue/vue3-recommended',
        'plugin:@typescript-eslint/recommended',
        'plugin:prettier/recommended',
        'prettier'
    ],
    // 自訂規則
    rules: {}
}