<template>
    <div class="app" :class="{ login: states.user.isLogin }">
        <!-- <ElCanvasBg></ElCanvasBg> -->
        <div class="popupBlock"></div>

        <div class="featuresBlock">
            <!-- <transition name="blackHole" mode="out-in"> -->
            <BlockAccount v-if="states.user.isLogin"></BlockAccount>
            <LoginPage v-else></LoginPage>
            <!-- </transition> -->

            <transition name="blackHole" mode="out-in">
                <BlockSideMenu v-if="states.user.isLogin"></BlockSideMenu>
            </transition>
        </div>

        <div v-if="states.user.isLogin" class="viewBlock">
            <BlockHeader class="headerBlock"></BlockHeader>

            <section class="contentBlock">
                <transition name="fadeX" mode="out-in">
                    <div class="loadingMask" v-show="states.route.isLoading"></div>
                </transition>
                <router-view v-slot="{ Component }">
                    <transition name="fadeX" mode="out-in">
                        <component :is="Component"></component>
                    </transition>
                </router-view>
            </section>

            <BlockFooter class="footerBlock"></BlockFooter>
        </div>
    </div>
</template>

<script setup lang="ts">
    import { useStore } from './store';

    // @ is an alias to /src
    const store = useStore();

    const states = store.state;

    onMounted(() => {
        console.log('App onMounted');
    });
</script>

<style lang="scss">
    //  載入基礎樣式
    @import '@/assets/scss/base.scss';

    #app {
        display: flex;
        align-items: center;
        background: $colorBack;
        @include setSize(100%, 100vh);

        padding: 0;
        margin: 0;

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
