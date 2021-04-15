<template>
    <div class="row vertical" data-width="20rem">
        <elInput
            v-model="loginForm.username"
            type="text"
            placeholder="Username"
        ></elInput>
        <elInput
            v-model="loginForm.password"
            type="password"
            placeholder="Password"
        ></elInput>
        <el-Button type="primary" @click="handleLogin">Login</el-Button>
        <el-Button @click="removeCookie">Clear</el-Button>
    </div>
</template>

<script>
import Cookies from 'js-cookie'
import elInput from '../components/el-input.vue'

export default {
    data() {
        return {
            loginForm: {
                username: '',
                password: '',
                token: '',
            },
        }
    },
    components: { elInput },
    methods: {
        handleLogin() {
            const token = 'asdsadsafASFadfsaf'
            let username = this.loginForm.username
            let password = this.loginForm.password

            if (username !== '' && password !== '') {
                this.loginForm.token = token
            } else {
                alert('帳號密碼不能為空')
            }

            Cookies.set('login', JSON.stringify(this.loginForm), { expires: 1 })
            console.log(this.loginForm)
            if (Cookies.get('login') && this.loginForm.token) {
                this.$router.push({ name: 'Dashboard' })
            }
        },
        removeCookie() {
            Cookies.remove('login')
        },
    },
}
</script>
