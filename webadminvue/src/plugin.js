import svgIcon from "@/components/el-svgIcon.vue";

const componentPlugin = {
    install: function (vue, options) {
        if (options && options.imports && Array.isArray(options.imports) && options.imports.length > 0) {
            // 按需引入圖示
            const { imports } = options;
            imports.forEach((name) => {
                require(`@/assets/icons/${name}.svg`);
            });
        } else {
            // 全量引入圖示
            // import所有符合條件的svg 參數：路徑、是否import子資料夾、正則
            const ctx = require.context("@/assets/icons", false, /\.svg$/);
            ctx.keys().forEach((path) => {
                const temp = path.match(/\.\/([A-Za-z0-9\-_]+)\.svg$/);
                if (!temp) return;
                const name = temp[1];
                require(`@/assets/icons/${name}.svg`);
            });
        }
        vue.component(svgIcon.name, svgIcon);
    },
};

export default componentPlugin;
