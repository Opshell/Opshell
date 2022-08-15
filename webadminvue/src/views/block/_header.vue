<template>
    <header class="headerBlock">
        <h1 class="breadcrumbs">
            <transition-group name="verbatim">
                <span v-for="(item, i) in pageData.title" v-bind:key="i">
                    {{ item }}
                </span>
            </transition-group>
        </h1>

        <div class="searchBar"></div>

        <div class="CRUDBox">
            <elSvgIcon name="disk"></elSvgIcon>
            <elSvgIcon name="undo"></elSvgIcon>
            <elSvgIcon name="trash"></elSvgIcon>
        </div>
    </header>
</template>

<script>
    import { mapState } from "vuex";
    import elSvgIcon from "@/components/el-svgIcon.vue";


    // import elBtn from "./components/el-button.vue";

    // @ is an alias to /src
    export default {
        name: "Header",
        components: { elSvgIcon },
        data: function () {
            return {};
        },
        mounted: function () {},
        method: {},
        computed: mapState([
            "isLogin",
            "isLoading",
            "userData",
            "pageData",
            // isLogin(){ // 取得共用狀態(是否登入)
            //     return this.$store.state.isLogin;
            // },
        ]),
    };
</script>

<style lang="scss">
    .headerBlock {
        position: relative;
        flex-shrink: 0;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        background: $colorBack;
        width: 100%;
        padding: 25px;
        box-sizing: border-box;
        .breadcrumbs {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            background: $colorBack2;
            padding: 5px 15px;
            @include setSize(100%, 50px);
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 20px;
            font-family: "Noto Sans CJK TC";
            font-weight: normal;
            color: #fff;
            line-height: 0.8;
        }
        .CRUDBox {
            position: absolute;
            right: 0;
            bottom: 0;
            display: flex;
            background: $colorBack;
            padding: 10px;
            border-radius: 5px;
            transform: translate3d(-25px, 50%, 0);
            z-index: 1;
            .icon {
                @include setSize(40px, 40px);
                + .icon {
                    margin: 0 0 0 10px;
                }
            }
        }
    }
</style>
