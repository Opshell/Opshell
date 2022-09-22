<template>
    <div class="app" :class="{ login: user.isLogin }">
        <Home v-if="user.isLogin"></Home>
        <Login v-else></Login>
    </div>
</template>

<script lang="ts">
    import { useStore } from './store';
    // import { useState } from "./hook/vuexSugar.js";

    // import Home from "./views/block/_header.vue";
    // import Header from "./views/block/_header.vue";
    // import Footer from "./views/block/_footer.vue";
    // import Account from "./views/Account.vue";
    // import SideMenu from "./views/block/_sideMenu.vue";

    // @ is an alias to /src
    export default {
        name: "App",
        setup() {
            const store = useStore();

            return {
                ...store.state
            }
        }
    };
</script>

<style lang="scss">
    #app {
        display: flex;
        align-items: center;
        background: $colorBack;
        @include setSize(100%, 100vh);

        font-family: Avenir, Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: center;
        color: #eee;
    }
    .app {
        display: flex;
        align-items: center;
        @include setSize(100%, 100vh);

        &.login {
            .featuresBlock {
                width: 25%;
                max-width: 300px;
            }
            .viewBlock {
                @include setSize(100%, 100%);
            }
        }
    }

    .featuresBlock {
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: $colorBack2;
        @include setSize(100%, 100%);

        transition: 0.15s $cubic-FiSo;
    }
    .viewBlock {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        @include setSize();
        box-sizing: border-box;

        transition: 0.3s $cubic-FiSo 0.08s;
        overflow: hidden;

        .contentBlock {
            flex: 1;
            position: relative;
            background: #1b1b1b;
            padding: 20px;
            box-shadow: $bascShadow;
            overflow: hidden;
            overflow-y: auto;

            .loadingMask {
                position: absolute;
                top: 0;
                left: 0;
                background: #1e2b2e;
                @include setSize(100%, 100%);
                z-index: 1;
            }

            /* 卷軸設定 */
            &::-webkit-scrollbar {
                background: #999;
                width: 8px;
                border-radius: 2px;
            }
            &::-webkit-scrollbar-thumb {
                background: $colorMain;
                border-radius: 5px;
                border: 0.5px solid rgba(153, 153, 153, 0.5);
                box-shadow: 0 0 10px 2px #20476e;
            }
        }
    }
</style>
