<template>
    <div class="app" :class="{ login: isLogin }">
        <div class="popupBlock"></div>

        <div class="featuresBlock">
            <!-- <transition name="blackHole" mode="out-in"> -->
            <Account v-if="isLogin"></Account>
            <Login v-else></Login>
            <!-- </transition> -->

            <!-- <transition name="blackHole" mode="out-in"> -->
            <SideMenu v-if="isLogin"></SideMenu>
            <!-- </transition> -->
        </div>

        <div v-if="isLogin" class="viewBlock">
            <Header class="headerBlock"></Header>

            <section class="contentBlock">
                <router-view v-slot="{ Component }">
                    <transition name="fadeX" mode="out-in">
                        <component :is="Component"></component>
                    </transition>
                </router-view>
            </section>
            <footer class="footerBlock">
                <span>Copyright © 2021 www.Opshell.info </span>
                <span>Designed By IRONMAN</span>
            </footer>
        </div>
    </div>
</template>

<script>
    import { mapState } from "vuex";
    import Login from "./views/Login.vue";
    import Account from "./views/Account.vue";
    import SideMenu from "./views/block/_sideMenu.vue";
    import Header from "./views/block/_header.vue";
    
    // import elBtn from "./components/el-button.vue";

    // @ is an alias to /src
    export default {
        name: "App",
        components: {
            SideMenu,
            Header,
            Login,
            Account,
        },
        data: function () {
            return {};
        },
        mounted: function () {
            // console.log(isLogin);
            // console.log(this.$store);
        },
        method: {
            // logout: function () {
            //     this.$store.commit("Signin");
            // },
        },
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
            .viewBlock { @include setSize(100%, 100%); }
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
            background: #1b1b1b;
            padding: 20px;
            box-shadow: $bascShadow;
            overflow: hidden;
        }
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
    }
</style>
