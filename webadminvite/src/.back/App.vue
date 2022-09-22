<script setup lang="ts">
    // This starter template is using Vue 3 <script setup> SFCs
    // Check out https://vuejs.org/api/sfc-script-setup.html#script-setup
    import HelloWorld from './components/HelloWorld.vue'
</script>

<template>
    <div>
        <a href="https://vitejs.dev" target="_blank">
            <img src="/vite.svg" class="logo" alt="Vite logo" />
        </a>
        <a href="https://vuejs.org/" target="_blank">
            <img src="./assets/vue.svg" class="logo vue" alt="Vue logo" />
        </a>
    </div>
    <HelloWorld msg="Vite + Vue" />
</template>

<template>
    <div class="app" :class="{ login: user.isLogin }">
        <div class="popupBlock"></div>

        <div class="featuresBlock">
            <!-- <transition name="blackHole" mode="out-in"> -->
                <Account v-if="user.isLogin"></Account>
                <Login v-else></Login>
            <!-- </transition> -->

            <transition name="blackHole" mode="out-in">
                <SideMenu v-if="user.isLogin"></SideMenu>
            </transition>
        </div>

        <div v-if="user.isLogin" class="viewBlock">
            <Header class="headerBlock"></Header>

            <section class="contentBlock">
                <transition name="fadeX" mode="out-in">
                    <div class="loadingMask" v-show="isLoading"></div>
                </transition>
                <router-view v-slot="{ Component }">
                    <transition name="fadeX" mode="out-in">
                        <component :is="Component"></component>
                    </transition>
                </router-view>
            </section>

            <Footer class="footerBlock"></Footer>
        </div>
    </div>
</template>

<style scoped lang="scss">
    .logo {
        height: 6em;
        padding: 1.5em;
        will-change: filter;
    }
    .logo:hover {
        filter: drop-shadow(0 0 2em #646cffaa);
    }
    .logo.vue:hover {
        filter: drop-shadow(0 0 2em #42b883aa);
    }
</style>



