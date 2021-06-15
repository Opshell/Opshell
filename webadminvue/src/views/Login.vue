<template>
    <article class="loginBlock">
        <section class="logoBlock">
            <div class="logoBox">
                <img class="logo" src="../assets/images/Opshell-5x.png" alt="Vue logo" />
            </div>
            <h1 class="title">Opsehll 管理後台</h1>
        </section>

        <form>
            <elInput 
                v-model="loginForm.username" 
                placeholder="Username" 
            />
            <elInput 
                v-model="loginForm.password" 
                type="password" 
                placeholder="Password" 
            />
            <elInput 
                v-model="loginForm.verification" 
                placeholder="verification" 
            />
            <div class="btnBox">
                <elBtn @click="handleLogin" text="登入" />
                <elBtn @click="removeCookie" text="忘記密碼" />
            </div>
        </form>
    </article>
</template>

<script>
    import Cookies from "js-cookie";
    import { mapState } from "vuex";

    // import elImg from "../components/el-img.vue";
    import elBtn from "../components/el-button.vue";
    import elInput from "../components/el-input.vue";

    export default {
        data() {
            return {
                loginForm: {
                    username: "Opshell",
                    password: "pass",
                    verification: "test",
                },
            };
        },
        components: {
            // elImg,
            elBtn,
            elInput,
        },
        methods: {
            handleLogin() {
                const verification = "test";
                const username = this.loginForm.username;
                const password = this.loginForm.password;

                if (username !== "" && password !== "") {
                    // 登入成功
                    let store = this.$store;
                    this.loginForm.verification = verification;

                    this.authenticate(username, password).then((auth) => {
                        if (auth.status) {
                            localStorage.setItem("token", auth.data);
                            store.commit("Signin");
                            store.commit("SetUser", this.loginForm);

                            const redirect = store.state.redirect == "" || store.state.redirect == undefined ? "Dashboard" : store.state.redirect;
                            this.$router.push({ name: redirect });
                        } else {
                            console.log(auth.msg);
                        }
                    });
                } else {
                    // 登入失敗
                    alert("帳號密碼不能為空");
                }
            },
            authenticate: async function (email, password) {
                return await this.axios({
                    url:"/api/backEndAuth/login",
                    method: "POST",
                    data: { email, password },
                    // headers: { 'Content-Type': 'application/json' },
                })
                .then((result) => {
                    if (result.status == 200) {
                        return {
                            status: true,
                            msg: "登入成功",
                            data: result.data.data,
                        };
                    } else {
                        return {
                            status: false,
                            msg: result.data.message,
                            data: result.data.data,
                        };
                    }
                })
                .catch(() => {
                    return false;
                });
            },
            removeCookie() {
                Cookies.remove("login");
            },
        },
        computed: mapState([
            // 批量載入vuex state
            "isLogin",
            "isLoading",
            "userData",
        ]),
    };
</script>

<style scoped lang="scss">
    .loginBlock {
        display: flex;
        flex-direction: column;
        background: #eee;
        width: 100%;
        max-width: 250px;
        padding: 20px;
        border-radius: 8px;
        box-sizing: border-box;
        margin: 0 auto;
        box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.08);

        color: $colorMain;
        .logoBlock {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 0 0 15px;
            .logoBox {
                background: #eee;
                @include setSize(90px, 90px);
                padding: 10px;
                border: 5px solid #f3f3f3;
                border-radius: 50%;
                box-sizing: border-box;

                overflow: hidden;
                box-shadow: $bascShadow, $bascShadow-in;
            }
            .logo { width: 100%; }
            .title { color: #000; }
        }

        .input { margin: 0 0 10px; }
        .btnBox {
            display: flex;
            justify-content: center;
            margin: 10px 0 0;
            .Btn + .Btn { margin: 0 0 0 10px; }
        }
    }
</style>
