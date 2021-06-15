<template>
    <div v-if="isLogin" class="menu">
        <router-link class="link" to="/">Vue Info</router-link>
        <router-link class="link" to="/dashboard">Dashboard</router-link>
        <router-link class="link" to="/about">About</router-link>
        <router-link class="link" to="/news">News</router-link>
        <router-link class="link" to="/newsinfo/testparam1">News-1</router-link>
        <router-link class="link" to="/product">Product</router-link>
        <router-link class="link" to="/contact">Contact</router-link>
        <router-link class="link" to="/webset">Web Setting</router-link>
    </div>
</template>

<script>
    import { mapState } from "vuex";

    export default {
        name: "nav",
        components: {},
        data: function () {
            return {};
        },
        mounted: function () {},
        method: {},
        computed: mapState(["isLogin", "isLoading"]),
    };
</script>

<style lang="scss">
    .menu {
        display: flex;
        flex-direction: column;
        background: $colorBack2;
        @include setSize(100%, 100%);
        padding: 5px;
        box-sizing: border-box;
        .link {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            @include setSize(100%, 40px);
            padding: 0 15px;
            border-bottom: 1px solid rgba(44, 62, 79, 0.7);
            box-sizing: border-box;

            color: #eee;
            font-weight: bold;
            z-index: 1;

            &::before {
                content: "";
                position: absolute;
                top: -1px;
                left: 0;
                background: linear-gradient(to right, #2c3e50 0%, #334e69 100%);
                @include setSize(0, calc(100% + 2px));
                box-shadow: 3px 0 3px 0 rgba(0, 0, 0, 0.15) inset;
                transform: translateX(-10px);
                transition: 0.15s $cubic-FiSo;
                opacity: 0;
                z-index: -1;
            }

            &:hover {
                color: #42b983;
                &::before {
                    width: 80%;
                    opacity: 0.5;
                }
            }
            &.router-link-exact-active {
                justify-content: flex-end;
                padding-right: 30px;
                color: $colorSubs;
                &::before {
                    width: calc(100% + 30px);
                    opacity: 1;
                }
            }
        }
    }
</style>
