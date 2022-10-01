<template>
    <article class="accountBlock">
        <div class="logoBox">
            <img class="logo" src="../assets/images/Opshell-5x.png" alt="Vue logo" />
        </div>

        <div class="btnBox">
            <h2 class="text">{{ user.userData.name }}</h2>
            <elBtn @click="logout" text="登出" title="登出" icon="sign-out" />
            <elBtn @click="logout" text="選項" title="選項" icon="settings-sliders" />
        </div>
    </article>
</template>

<script lang="ts">
    import { useStore } from '@/store';

    export default {
        setup() {
            const store = useStore();
            const router = useRouter();

            const logout = () => {
                store.commit("user/signOut");
                router.push({ name: "Login" });
            }

            return {
                ...store.state,
                logout
            }
        }
    };
</script>

<style scoped lang="scss">
    .accountBlock {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        padding: 20px 10px 10px;
        border-bottom: 5px solid $colorBack;
        box-sizing: border-box;
        margin: 0 auto;
        box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.08);

        color: $colorMain;
        .logoBox {
            background: #eee;
            @include setSize(120px, 120px);
            padding: 10px;
            border: 5px solid #f3f3f3;
            border-radius: 50%;
            box-sizing: border-box;
            margin: 10px 10px 25px;
            overflow: hidden;
            box-shadow: $bascShadow, $bascShadow-in;
            .logo {
                width: 100%;
            }
        }
        .btnBox {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;

            .text {
                flex-grow: 1;
                display: flex;
                align-items: center;
                justify-content: flex-start;
                color: #fff;
                text-align: center;
            }

        }
    }
</style>
