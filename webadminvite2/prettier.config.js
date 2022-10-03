module.exports = {
    printWidth: 100, // 一行最多200字元
    tabWidth: 4, // Tab = 4個空白
    useTabs: false, // 不使用 Tab 縮排，使用空格
    semi: true, // 行尾需要有分號
    singleQuote: true, // 使用單引號代替雙引號
    quoteProps: 'as-needed', // Object 的 key 僅在必要时用引號
    jsxSingleQuote: false, // jsx 不使用單引號，而使用雙引號
    trailingComma: 'all',  // 末尾使用逗號
    bracketSpacing: true, // 大括號內 首尾需要空白 { title: 'Opshell' }
    jsxBracketSameLine: false, // jsx Tag的尾端括號换行(棄用)
    bracketSameLine: false,
    arrowParens: 'always', // 箭頭函數，只有一个參數的时候，也需要括號
    rangeStart: 0, // 每个文件格式化的範圍是文件的全部内容
    rangeEnd: Infinity, // 要用預設的話不要寫
    requirePragma: false, // 不需要寫文件開頭的 @prettier
    insertPragma: false, // 不需要自動在文件開頭插入 @prettier
    proseWrap: 'preserve', // 預設斷行
    htmlWhitespaceSensitivity: 'css', // 根據 CSS 設定決定 html 要不要斷行
    vueIndentScriptAndStyle: false, // vue 文件中的 script 和 style 内不用缩进
    endOfLine: 'lf' // 換行符號使用lf
}