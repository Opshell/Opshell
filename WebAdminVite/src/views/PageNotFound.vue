<template>
    <div class="">
        <h1 class="text">404 | Page Not Found.</h1>
    </div>
</template>

<script setup lang="ts">
    import { useStore } from '@/store';

    const store = useStore();

    onMounted(() => {
        store.state.commit('route/endLoading');
    });
</script>

<style scoped lang="scss">
    .text {
        color: #eee;
        font-size: 36px;
    }
</style>
