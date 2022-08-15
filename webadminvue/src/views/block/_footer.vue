<template>
    <footer class="footerBlock">
        <span>Copyright © 2021 www.Opshell.info </span>
        <span>Designed By IRONMAN</span>
    </footer>
</template>

<script>
    import { mapState } from "vuex";

    // import elBtn from "./components/el-button.vue";

    // @ is an alias to /src
    export default {
        name: "Header",
        components: {},
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
    .footerBlock {
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #282828;
        font-size: 10px;
        @include setSize(100%, 50px);
        .text + .text {
            margin: 0 0 0 20px;
        }
    }
</style>
