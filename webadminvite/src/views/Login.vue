<template>
    <article class="loginBlock">
        <section class="logoBlock">
            <div class="logoBox">
                <img class="logo" src="@/assets/images/Opshell-5x.png" alt="Vue logo" />
            </div>
            <h1 class="title">Opsehll 管理後台</h1>
        </section>

        <form>
            <elInput v-model="loginForm.username" placeholder="Username" />
            <elInput v-model="loginForm.password" type="password" placeholder="Password" />
            <elInput v-model="loginForm.verification" placeholder="verification" :disabled="true" />
            <div class="btnBox">
                <elBtn @click="handleLogin" text="登入" />
                <elBtn text="忘記密碼" />
            </div>
        </form>
    </article>
</template>

<script lang="ts">
    import { useStore } from '@/store';
    import { getData } from '@/hook/getData';

    export default {
        name: "Login",
        setup() {
            const store = useStore();
            const router = useRouter();

            // data
            const loginForm = reactive({
                username: '',
                password: '',
                verification: '',
            });

            onMounted(() => {
                loginForm.username = 'Opshell';
                loginForm.password = 'pass';
            });

            // Methods
            const handleLogin = () => {
                const verification = 'test';
                const username = loginForm.username;
                const password = loginForm.password;

                if (username !== '' && password !== '') {
                    // 登入成功
                    // let store = useStore();
                    loginForm.verification = verification;

                    // this.authenticate(username, password)
                    getData(
                        "/api/backEnd/login", "POST",
                        { username, password }
                    ).then((auth) => {
                        if (auth && auth.status) {
                            localStorage.setItem("token", auth.data); // 紀錄token

                            store.commit("user/signIn");
                            store.commit("user/setUser", auth.data); // 記錄使用者資料

                            const redirect = store.state.redirect == "" || store.state.redirect == undefined ? "Home" : store.state.redirect;
                            router.push({ name: redirect });
                        } else {
                            console.log(auth);
                        }
                    });
                } else {
                    // 登入失敗
                    alert("帳號密碼不能為空");
                }
            };

            return {
                // ...vuexState,
                loginForm,
                handleLogin
            }
        }
    };
</script>

<style lang="scss">
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
        backdrop-filter: blur(5px);
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