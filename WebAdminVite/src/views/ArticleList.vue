<template>
    <div class="News">
        <h1>Here show the news list.</h1>

        <elTable :value="list"></elTable>
    </div>
</template>

<script setup lang="ts">
    import { useStore } from '@/store';
    import { getData } from '@/hook/getData';

    const store = useStore();

    // 取得列表
    const list = ref([]);
    onMounted(() => {
        const token = localStorage.getItem('token');
        getData('/api/news/list', 'GET', {}, { Authorization: `Bearer ${token}` }).then(
            (result) => {
                if (result && result.status) {
                    list.value = result.data.data;
                    store.commit('route/endLoading');
                }
            },
        );
    });
</script>

<style scoped lang="scss"></style>
