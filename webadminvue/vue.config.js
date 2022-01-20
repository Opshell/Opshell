// const model = 'build' // dev 为开发环境 build 为测试环境  product 为生产环境
// let host = 'http://39.106.171.35:8090';
// if (model == 'build') {
//     host = 'http://39.106.171.35:8090'
// }else if (model == 'dev') {
//     host = 'http://localhost:8090'
// }

// let host = 'http://127.0.0.1/opshell/WebAdmin/api/';

const path = require("path");
const host = "http://www.opshell/api/";

module.exports = {
    publicPath: process.env.NODE_ENV === "production" ? "/webadmin/" : "/webadminvue/", // cli 根目錄
    outputDir: "../WebAdmin/", // 輸出 目錄
    // indexPath: "index.php", // 輸出 index
    indexPath: "router.php", // 輸出 index
    runtimeCompiler: true, // [HMR] Waiting for update signal from WDS...
    devServer: {
        // 代理伺服器
        port: 1025,
        proxy: {
            "/api": {
                target: host, // 本機串接
                ws: true, // 代理的WebSockets
                changeOrigin: true, // 允許websockets跨域
                pathRewrite: {
                    "^/api": "",
                },
            },
            "/ukapi": {
                // UBike範例
                target: "https://data.ntpc.gov.tw/api/", // Ubike api 網址
                ws: true, // 代理的WebSockets
                changeOrigin: true, // 允許websockets跨域
                pathRewrite: {
                    "^/ukapi": "",
                },
            },
        },
    },
    productionSourceMap: false, // 如果你不需要生产环境的 source map，可以将其设置为 false 以加速生产环境构建。
    css: {
        sourceMap: false, // 是否为 CSS 开启 source map。设置为 true 之后可能会影响构建的性能
        loaderOptions: {
            sass: {
                prependData: `@import "@/assets/scss/stylesheet.scss";`, // 全域 Component 引用 基礎SCSS
            },
        },
    },
    chainWebpack: (config) => {
        const dir = path.resolve(__dirname, "src/assets/icons"); // 路徑

        config.module.rules.delete("svg"); // 刪除預設的svg配置
        config.module
            .rule("svg-sprite-loader")
            .test(/\.svg$/) // 符合正則 副檔名為SVG的檔案
            .include.add(dir).end() // 包含的資料夾 exclude 則是不包含的資料夾
            .use("svg-sprite-loader")
            .loader("svg-sprite-loader")
            .options({ symbolId: "[name]" })
            .end();

        // const svgRule = config.module.rule("svg");
        //     svgRule.uses.clear();
        //     svgRule
        //     .use("svg-sprite-loader")
        //     .loader("svg-sprite-loader")
        //     .options({
        //         symbolId: "icon-[name]",
        //         include: [dir]
        //     });

        // 修改 images-loader 配置 => 排除icon資料夾
        config.module.rule("images").exclude.add(dir).end();
    },
};
