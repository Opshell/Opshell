<template>
    <div class="app" :class="{login: isLogin}">
        <div class="popupBlock"></div>

        <div class="featuresBlock">
            <!-- <transition name="blackHole" mode="out-in"> -->
                <Account v-if="isLogin"></Account>
                <Login v-else></Login>
            <!-- </transition> -->

            <!-- <transition name="blackHole" mode="out-in"> -->
                <Nav v-if="isLogin"></Nav>
            <!-- </transition> -->
        </div>

        <div v-if="isLogin" class="viewBlock">
            <header class="headerBlock">
                <h1 class="breadcrumbs">
                    <transition-group name="verbatim">
                    <span
                        v-for="item in pageData.title"
                        v-bind:key="item"
                    >
                        {{ item }}
                    </span>
                    </transition-group>
                </h1>
                <div class="btnBox"></div>
            </header>

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
    import { mapState } from 'vuex';
    import Login from "./views/Login.vue";
    import Account from "./views/Account.vue";

    import Nav from "./views/block/nav.vue";
    // import elBtn from "./components/el-button.vue";

    // @ is an alias to /src
    export default {
        name: "App",
        components: {
            Nav,
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
            'isLogin',
            'isLoading',
            'userData',
            'pageData',
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
        background: #2c3e50;
        @include setSize(100%, 100vh);

        font-family: Avenir, Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: center;
        color: #eee;
    }
    .app{
        display: flex;
        align-items: center;
        @include setSize(100%, 100vh);

        &.login{
            .featuresBlock{ width: 200px; }
            .viewBlock{
                @include setSize(100%, 100%);
                padding: 0 15px;
            }
        }
    }

    .featuresBlock{
        flex-shrink: 0;
        display: flex;
        flex-direction: column; 
        align-items: center;
        justify-content: center;
        background: $colorBack2;
        @include setSize(100%, 100%);

        transition: .15s $cubic-FiSo;
    }
    .viewBlock{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        @include setSize();
        box-sizing: border-box;

        transition: .3s $cubic-FiSo .08s;
        overflow: hidden;
        .headerBlock{
            flex-shrink: 0;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            background: $colorBack2;
            @include setSize(100%, 80px);
            padding: 10px 20px 20px;
            box-sizing: border-box;
            border-radius: 0 0 15px 15px;
            margin: 0 0 15px;
            .breadcrumbs{
                font-weight: normal;
                font-size: 24px;
            }
        }
        .contentBlock{
            flex: 1;
            background: $colorBack2;
            padding: 20px;
            border-radius: 15px;
            box-shadow: $bascShadow;
            overflow: hidden;
        }
        .footerBlock{
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            @include setSize(100%, 50px);
            .text + .text{margin: 0 0 0 20px;}
        }
    }
</style>
