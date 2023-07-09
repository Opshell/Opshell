<template>
    <div class="NewsInfo">
        <h1>Here show the news{{ id }}'s information .</h1>
    </div>
</template>

<script setup lang="ts">
    /* global Opshell */
    // [-] type import
    import { Ref } from 'vue';

    // [-] method import
    import { useStore } from '@/store';
    import { getData } from '@/hook/getData';

    const store = useStore();
    const route = useRoute();

    interface infoFace {
        id: number;
        title: string;
        content: string;
        category: string;
        img: string;
        created_at: string;
        updated_at: string;
    }

    // onMounted(() => {
    const info: Ref<infoFace> = ref({
        id: 0,
        title: '',
        content: '',
        category: '',
        img: '',
        created_at: '',
        updated_at: '',
    });
    const id = route.params.id;

    const token = localStorage.getItem('token');
    getData(`/api/news/info/${id}`, 'GET', {}, { Authorization: `Bearer ${token}` }).then((result) => {
        console.log(result);
        if (result && result.status) {
            console.log(result.data);
            // result.data Json 轉 Array
            info.value = JSON.parse(result.data);

            store.commit('route/endLoading');
        }
    });
    // });
</script>

<style scoped lang="scss"></style>
