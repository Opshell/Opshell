<template>
    <div class="row vertical" data-width="20rem">
        <el-input v-model="loginForm.username" type="text" placeholder="Username" />
        <el-input v-model="loginForm.password" type="password" placeholder="Password" />
        <el-button type="primary" @click="handleLogin">Login</el-button>
        <el-button @click="removeCookie">Clear</el-button>
    </div>
</template>

<script>
    import Cookies from 'js-cookie';

    export default {
        data() {
            return{
                loginForm: {
                    username: '',
                    password: '',
                    token: ''
                }
            }
        },
        methods: {
            handleLogin() {
                const token = 'asdsadsafASFadfsaf';
                let username = this.loginForm.username;
                let password = this.loginForm.password;

                if (username !== '' && password !== '') {
                    this.loginForm.token = token;
                } else {
                    alert('帳號密碼不能為空');
                }

                Cookies.set('login', JSON.stringify(this.loginForm), { expires: 1 });
                console.log(this.loginForm);
                if (Cookies.get('login') && this.loginForm.token) {
                    this.$router.push({name: 'Dashboard'});
                }
            },
            removeCookie() {
                Cookies.remove('login');
            }
        }
    }
</script>