module.exports = {
    "printWidth": 200, // 一行最多200字元
    "tabWidth": 4, // Tab = 4個空白
    "useTabs": false, // 不使用Tab 而使用空白
    "semi": true, // 行尾需要分號
    "singleQuote": true, // 使用單引號
    "quoteProps": 'as-needed', // 對象的 key 僅在必要時使用引號
    "jsxSingleQuote": false, // jsx 不使用單引號，使用雙引號
    "trailingComma": 'es5', // 末端需要有逗號 [all, es5]
    "bracketSpacing": true, // 大括號內 首尾需要空白
    "jsxBracketSameLine": false, // jsx Tag的尾端括號换行
    "bracketSameLine": false,
    "arrowParens": 'always', // 箭头函數，只有一个參數的时候，也需要括號
    "rangeStart": 0, // 每个文件格式化的范围是文件的全部内容
    "rangeEnd": Infinity,
    "requirePragma": false, // 寫文件開頭的 @prettier
    "insertPragma": false, // 自動在文件開頭插入 @prettier
    "proseWrap": 'preserve', // markdown文本中的換行 -> 什麼都不做，讓markdown保持原樣
    "htmlWhitespaceSensitivity": 'css', // HTML 空格敏感性
    "vueIndentScriptAndStyle": false, // 是否縮進 Vue 檔中的代碼和標記。
    "endOfLine": 'lf', // 換行符號
};