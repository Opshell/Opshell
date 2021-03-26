module.exports = {
    publicPath: process.env.NODE_ENV === 'production' ? '/webadmin/' : '/webadminvue/', // cli 根目錄
    outputDir: '../WebAdmin/', // 輸出 目錄
    indexPath: 'index.php', // 輸出 index
    productionSourceMap: false // 如果你不需要生产环境的 source map，可以将其设置为 false 以加速生产环境构建。
}