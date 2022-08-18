<template>
    <div class="iconBlock">
        <div v-for="(item, i) in iconList" class="iconBox" :key="i">
            <div class="box" :title="item">
                <elSvgIcon :name="item" />
            </div>
            <!-- <div class="name">{{item}}</div> -->
        </div>

    </div>
</template>

<script>
    import { mapState } from "vuex";
    // import { getData } from "../hook/getData.js"

    import elSvgIcon from "../components/el-svgIcon.vue";

    export default {
        data() {
            return {
                iconList: [],
            };
        },
        mounted: function () {
            // getData(
            //     '/sprite.svg',
            //     {},
            //     'GET'
            // ).then((result) => {

            let spriteSvg = [...document.getElementById('__SVG_SPRITE_NODE__').children];
            spriteSvg.forEach(svgDom => {
                this.iconList.push(svgDom.id);
            });

            // console.log(this);
            this.$store.commit('endLoading');


            // this.axios({
            //     url: "/sprite.svg",
            //     method: "GET",
            // }).then((result) => {
            //     if (result.status == 200) {
            //         if(result.data != ''){
            //             const regexp = /id="([^"]*)"/g;
            //             let matches = [...result.data.matchAll(regexp)];
            //             matches.forEach(el => {
            //                 this.iconList.push(el[1]);
            //             });
            //         }
            //     }
            // });
        },
        components: { elSvgIcon },
        methods: {},
        computed: mapState([
            // 批量載入vuex state
            "userData",
        ]),
    };
</script>

<style scoped lang="scss">
    .iconBlock {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: flex-start;
        width: 100%;
        .iconBox {
            display: flex;
            flex-direction: column;
            background: #666;
            width: calc(10% - 10px);
            border-radius: 5px;
            margin: 5px;
            cursor: pointer;
            transition: .3s $cubic-FiSo;
            .box{
                position: relative;
                display: flex;
                flex-direction: column;
                width: 100%;
                @include setProportion();
            }
            .icon {
                position: absolute;
                @include setSize(100%, 100%);
                padding: 12px;
                box-sizing: border-box;
            }
            .name {
                width: 100%;
                padding: 8px;
                box-sizing: border-box;
                word-break: break-all;
            }

            &:hover { fill: #ccc; }
        }
    }
</style>
