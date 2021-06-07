<template>
    <article class="accountBlock">
        <div class="logoBox">
            <img class="logo" src="../assets/images/Opshell-5x.png" alt="Vue logo" />
        </div>

        <div class="btnBox">
            <h2 class="text">{{ userData.name }}</h2>
            <elBtn @click="logout" text="" title="登出"/>
        </div>
    </article>
</template>

<script>
    // import Cookies from "js-cookie";
    import { mapState } from "vuex";

    import elBtn from "../components/el-button.vue";

    export default {
        data() {
            return {};
        },
        components: {
            elBtn,
        },
        methods: {
            logout() {
                // Cookies.remove("login");
                this.$store.commit("Signin");
                this.$router.push({ name: "Login" });
            },
        },
        computed: mapState([// 批量載入vuex state
            'isLogin',
            'isLoading',
            'userData',
        ]),
    };
</script>

<style scoped lang="scss">
    .accountBlock {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        padding: 20px;
        border-bottom: 5px solid $colorBack;
        box-sizing: border-box;
        margin: 0 auto;
        box-shadow: 0 0 20px 1px rgba(0, 0, 0, .08);

        color: $colorMain;
        .logoBox{
            background: #eee;
            @include setSize(90px, 90px);
            padding: 10px;
            border: 5px solid #f3f3f3;
            border-radius: 50%;
            box-sizing: border-box;
            margin: 0 0 10px;
            overflow: hidden;
            box-shadow: $bascShadow,
                        $bascShadow-in;

            .logo{ width: 100%; }
        }

        .btnBox {
            display: flex;
            justify-content: center;
            align-items: center;
            
            .text{ color: #000; }
            .Btn{
                flex-grow: 0;
                @include setSize(20px, 20px);
                padding: 0;
                border: 3px solid $colorSubs;
                border-radius: 50%;
                margin: 0 0 0 10px;
            }
        }
    }
</style>
