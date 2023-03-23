module.exports = {
    env: {
        browser: true,
        es2021: true,
        node: true,
    },
    extends: [
        './.eslintrc-auto-import.json', // `unplugin-auto-import` 生成的規則設定
        'eslint:recommended',
        'plugin:vue/vue3-essential',
        'plugin:@typescript-eslint/recommended',
        'plugin:prettier/recommended',
        'prettier',
    ],
    overrides: [],
    parser: 'vue-eslint-parser',
    parserOptions: {
        ecmaVersion: 'latest',
        sourceType: 'module',
        parser: '@typescript-eslint/parser',
    },
    plugins: ['vue', '@typescript-eslint'],
    rules: {
        '@typescript-eslint/ban-types': [
            // 關閉錯誤(error)：不要以 {} 當作一個類型
            'error',
            {
                extendDefaults: true,
                types: {
                    '{}': false,
                },
            },
        ],
        // '@typescript-eslint/no-undef': ['off'], // 關閉警告(warning)：不允許未定義的變數
        // '@typescript-eslint/no-unused-vars': ['off'], // 關閉警告(warning)：不允許未使用的變數
        // "@typescript-eslint/no-explicit-any": ["off"], // 關閉警告(warning)：不允許使用 any
    },
};
