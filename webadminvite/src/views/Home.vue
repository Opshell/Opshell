<script lang="ts">
export default defineComponent({ // 為了讓TypeScript看得懂，要加defineComponent來處理
        name: "Home",
        props: {
            msg: {
                type: String,
                default: ''
            },
        },
        setup() {
            const count: number = ref(0);

            return {
                count,
            }
        }
    });
</script>

<template>
    <div class="homeBlock">
        <div>
            <a href="https://vitejs.dev" target="_blank">
                <img src="/vite.svg" class="logo" alt="Vite logo" />
            </a>
            <a href="https://vuejs.org/" target="_blank">
                <img src="@/assets/vue.svg" class="logo vue" alt="Vue logo" />
            </a>
        </div>

        <h1>{{ msg }}</h1>

        <div class="card">
            <button type="button" @click="count++">count is {{count}} </button>
            <p>
            Edit
            <code>components/HelloWorld.vue</code> to test HMR
            </p>
        </div>

        <p>
            Check out
            <a href="https://vuejs.org/guide/quick-start.html#local" target="_blank"
            >create-vue</a
            >, the official Vue + Vite starter
        </p>
        <p>
            Install
            <a href="https://github.com/johnsoncodehk/volar" target="_blank">Volar</a>
            in your IDE for a better DX
        </p>
        <p class="read-the-docs">Click on the Vite and Vue logos to learn more</p>
    </div>
</template>

<style scoped lang="scss">
    .homeBlock{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        @include setSize(100%, 100%);
    }
    .read-the-docs { color: #888; }

    :root {
        font-family: Inter, Avenir, Helvetica, Arial, sans-serif;
        font-size: 16px;
        line-height: 24px;
        font-weight: 400;

        color-scheme: light dark;
        color: rgba(255, 255, 255, 0.87);
        background-color: #242424;

        font-synthesis: none;
        text-rendering: optimizeLegibility;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        -webkit-text-size-adjust: 100%;
    }

    .logo {
        height: 6em;
        padding: 1.5em;
        will-change: filter;
        &:hover {
            filter: drop-shadow(0 0 2em #646cffaa);
        }
        &.vue:hover {
            filter: drop-shadow(0 0 2em #42b883aa);
        }
    }

    a {
        font-weight: 500;
        color: #646cff;
        text-decoration: inherit;
        &:hover {
            color: #535bf2;
        }
    }
    p{
        line-height: 1.8em;
    }

    h1 {
        font-size: 3.2em;
        line-height: 1.1;
    }

    button {
        background: #eee;
        border-radius: 8px;
        border: 1px solid transparent;
        padding: 0.6em 1.2em;
        margin: 0 0 20px;
        font-size: 1em;
        font-weight: 500;
        font-family: inherit;
        cursor: pointer;
        transition: border-color 0.25s;
        &:hover {
            border-color: #646cff;
        }
        &:focus,
        &:focus-visible {
            outline: 4px auto -webkit-focus-ring-color;
        }
    }

    .card {
        padding: 2em;
    }

    @media (prefers-color-scheme: light) {
        :root {
            color: #213547;
            background-color: #ffffff;
        }

        a:hover { color: #747bff; }
        button { background-color: #f9f9f9; }
    }
</style>
