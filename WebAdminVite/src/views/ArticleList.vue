<template>
    <article class="News">
        <h1>Here show the news list.</h1>

        <header class="gridBar">
            <div class="td check">
                <ElInput type="checkbox" v-model="allCheckStatus" @click="selectAll()" />
            </div>
            <div class="td parent">分類</div>
            <div class="td title">標題</div>
            <div class="td icon">圖示</div>
            <div class="td crud">操作</div>
        </header>

        <div v-for="(item, i) in list" class="gridBar" :key="'gridBar_' + i">
            <div class="td check"><elInput type="checkbox" v-model="item.checked" /></div>
            <div class="td parent">{{ item.category.title }}</div>
            <div class="td icon">
                <img src="" alt="" />
            </div>
            <div class="td title">{{ item.title }}</div>
            <div class="td crud">
                <elBtn class="tipsBtn" :href="'/articleInfo/' + item.id" icon="edit" text="編輯" />
                <elBtn class="tipsBtn" icon="trash" text="刪除" @click="deleteSection(item.id)" />
            </div>
        </div>

        <elTable :value="list"></elTable>
    </article>
</template>

<script setup lang="ts">
    /* global Opshell */
    // [-] type import
    import { Ref } from 'vue';

    // [-] method import
    import { useStore } from '@/store';
    import { getData } from '@/hook/getData';

    const store = useStore();
    let aa: Opshell.iList = { title: '123', id: 1 };
    console.log(aa);

    // 取得列表
    const list: Ref<Opshell.iList[]> = ref([]);
    onMounted(() => {
        const token = localStorage.getItem('token');
        getData('/api/news/list', 'GET', {}, { Authorization: `Bearer ${token}` }).then((result) => {
            if (result && result.status) {
                list.value = result.data.data;
                store.commit('route/endLoading');
            }
        });
    });
</script>

<style scoped lang="scss"></style>
