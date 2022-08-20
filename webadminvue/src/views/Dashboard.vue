<template>
    <div class="Dashboard">
        <h1>Welcome back {{ user.userData.name }}</h1>
    </div>
</template>

<script>
    import { onMounted } from "vue";
    import { useStore } from "vuex";
    import { useState } from "../hook/vuexSugar.js";

    export default {
        components: {},
        setup() {
            const store = useStore();
            const states = useState(['user']);

            onMounted(() => {
                store.commit("endLoading");
            });

            return {
                ...states
            }
        },
    };
</script>

<style scoped lang="scss"></style>
