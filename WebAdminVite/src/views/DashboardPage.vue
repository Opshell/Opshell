<template>
    <div class="Dashboard">
        <h1>Welcome back {{ states.user.userData.name }}</h1>
    </div>
</template>

<script setup lang="ts">
    import { useStore } from '@/store';

    const store = useStore();
    const states = store.state;

    onMounted(() => {
        store.commit('route/endLoading');
    });
</script>

<style scoped lang="scss"></style>
