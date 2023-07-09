<template>
    <article class="News gridList">
        <header class="gridBar header">
            <div class="td check">
                <ElCheckBox type="checkbox" v-model:checked="allCheckStatus" />
            </div>
            <div class="td img">圖片</div>
            <div class="td category">分類</div>
            <div class="td title">標題</div>
            <div class="td crud">操作</div>
        </header>

        <div v-for="(item, i) in list" class="gridBar" :key="'gridBar_' + i">
            <div class="td check">
                <ElCheckBox type="checkbox" :value="item.id" />
            </div>
            <div class="td img">
                <img src="" alt="" />
            </div>
            <div class="td category">分類</div>
            <div class="td title">{{ item.title }}</div>
            <div class="td crud">
                <elBtn class="tipsBtn" :href="'/articleInfo/' + item.id" icon="edit" text="編輯" />
                <elBtn class="tipsBtn" icon="trash" text="刪除" />
            </div>
        </div>
    </article>
</template>

<script setup lang="ts">
    /* global Opshell */
    // [-] type import
    import { Ref } from 'vue';

    // [-] method import
    import { useStore } from '@/store';
    import { getData } from '@/hook/getData';

    // 取得列表
    const allCheckStatus = ref(false);

    const store = useStore();

    // 取得列表
    const list: Ref<Opshell.iList[]> = ref([]);
    // onMounted(() => {
    console.log('ArticleList onMounted');
    const token = localStorage.getItem('token');
    getData('/api/news/list', 'GET', {}, { Authorization: `Bearer ${token}` }).then((result) => {
        console.log(result);
        if (result && result.status) {
            // result.data Json 轉 Array
            list.value = JSON.parse(result.data);

            store.commit('route/endLoading');
        }
    });
    // });
</script>

<style scoped lang="scss">
    $borderColor: #ccc;
    .gridList {
        position: relative;
        display: flex;
        flex-direction: column;
        gap: 2px;
        margin: 2px 0 0;
        border-radius: 3px;
        overflow: auto;
        @include setSize(100%, 99%);

        /* 卷軸設定 */
        &::-webkit-scrollbar {
            background: #999;
            width: 8px;
            border-radius: 2px;
        }
        &::-webkit-scrollbar-thumb {
            background: $colorMain;
            border-radius: 5px;
            border: 0.5px solid rgba(153, 153, 153, 0.5);
            box-shadow: 0 0 10px 2px #20476e;
        }
    }
    .gridBar {
        display: grid;
        background: #1b1b1b;
        width: 100%;
        min-height: 50px;
        gap: 2px;

        grid-template-areas: checkbox img category title crud;
        grid-template-columns: 50px 150px 100px 1fr 150px;

        .td {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #555;
            padding: 10px;

            &.category,
            &.title {
                justify-content: flex-start;
            }
        }
        &.header {
            position: sticky;
            top: 0;
            font-size: 22px;
            z-index: 1;
            box-shadow: 0 1px 5px 1px rgba($color: #000000, $alpha: 0.5);
            .td {
                background: #888;
            }
        }

        &:nth-child(2n) {
            .td {
                background: #666;
            }
        }
    }
</style>
