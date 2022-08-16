<template>
    <footer class="footerBlock">
        <span class="text copyright">Copyright © 2022 www.Opshell.info </span>
        <span class="text design">
            <a href="https://github.com/Opshell" target="_blank" rel="noopener noreferrer">Designed By Opshell</a>
        </span>
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
        justify-content: flex-end;
        background: #282828;
        font-size: 10px;
        @include setSize(100%, 50px);
        .text + .text {
            margin: 0 20px;
        }
    }
</style>
