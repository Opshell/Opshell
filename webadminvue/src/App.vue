

<template>
    <div v-if="singIn" id="nav">
        <router-link to="/">Home</router-link> |
        <router-link to="/about">About</router-link>

        <elBtn @click="logout" v-text="登出"/>
    </div>

    <router-view></router-view>
</template>

<script>
// @ is an alias to /src
export default {
    name: "App",
    components: {},
    data: function(){
        return {}
    },
    mounted: function(){
        console.log(singIn);
    },
    method:{
        logout: function(){
            this.$store.commit("Signin");
        }
    },
    computed: {
        singIn: state => state.Signing,
    }
};
</script>

<style lang="scss">
#app {
    display: flex;
    align-items: flex-start;
    width: 100%;
    height: 100vh;

    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
}

#nav {
    display: flex;
    flex-direction: column;
    background: #2c3e50;
    @include setSize(200px, 100%);
    padding: 20px;
    box-sizing: border-box;
    a {
        font-weight: bold;
        color: #eee;
        &:hover{
            color: #fff;
        }

        &.router-link-exact-active {
            color: #42b983;
        }
    }
}
</style>