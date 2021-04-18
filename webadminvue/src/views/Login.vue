<template>
<div class="loginBlock">
    <article>
        <section>
            <elImg src="/image/Opshell-5x.phg" alt="Logo"/>
            <h1>Opsehll 管理後台</h1>
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
</div>
</template>

<script>
import Cookies from "js-cookie";
import elInput from "../components/el-input.vue";
import elBtn from "../components/el-button.vue";

export default {
    data() {
        return {
            loginForm: {
                username: "",
                password: "",
                token: "",
            },
        };
    },
    components: { 
        elInput, 
        elBtn
    },
    methods: {
        handleLogin() {
            const token = "asdsadsafASFadfsaf";
            let username = this.loginForm.username;
            let password = this.loginForm.password;

            if (username !== "" && password !== "") {
                this.loginForm.token = token;
            } else {
                alert("帳號密碼不能為空");
            }

            Cookies.set("login", JSON.stringify(this.loginForm), {
                expires: 1,
            });
            console.log(this.loginForm);
            if (Cookies.get("login") && this.loginForm.token) {
                this.$router.push({ name: "Dashboard" });
            }
        },
        removeCookie() {
            Cookies.remove("login");
        },
    },
};
</script>

<style scoped lang="scss">
.loginBlock{
    display:flex;
    flex-direction: column;
    width: 100%;
    max-width: 250px;
    padding: 20px;
    margin: 0 auto;
    box-sizing: border-box;
    box-shadow: 0 0 20px 1px rgba(0,0,0,.08);
    .input{
        margin: 0 0 10px;
    }
    .btnBox{
        display: flex;
        justify-content: center;
        .Btn + .Btn{
            margin: 0 0 0 10px;
        }
    }
}
</style>
