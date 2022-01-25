<template>
    <div class="iconBlock">
        <div class="iconBox">
            <div class="box">
                <div class="icon"><elSvgIcon name="bulb" /></div>
                <div class="name"></div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState } from "vuex";

    import elSvgIcon from "../components/el-svgIcon.vue";

    export default {
        data() {
            return {
                iconList: [],
            };
        },
        mounted: function () {
            this.axios({
                url: "/sprite.svg",
                method: "GET",
            }).then((result) => {
                if (result.status == 200) {
                    if(result.data != ''){
                        const regexp = /id="([^"]*)"/g;
                        let matches = [...result.data.matchAll(regexp)];
                        matches.forEach(el => {
                            this.iconList.push(el[1]);
                        });

                        console.log(this.iconList);
                    }
                }
            });
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
        align-items: flex-start;
        justify-content: space-around;
        width: 100%;
        .iconBox {
            display: flex;
            width: 12.5%;
            @include setProportion();
            .icon {
            }
            .icon-name {
            }
        }
    }
</style>
