<template>
    <article class="gridBlock">
        <header class="gridBar">
            <div class="td check">
                <ElCheckBox type="checkbox" v-model:checked="allCheckStatus" @click="selectAll()" />
            </div>
            <div class="td parent">父層ID</div>
            <div class="td id">ID</div>
            <div class="td icon">圖示</div>
            <div class="td title">名稱</div>
            <div class="td link">連結</div>
            <div class="td crud">操作</div>
        </header>

        <!-- <elSectionBar :menu="list" /> -->
        <template v-for="(item, i) in list" :key="'bar_' + i">
            <div class="gridBar">
                <div class="td check"><ElCheckBox type="checkbox" :value="item.id" v-model:checked="item.checked" /></div>
                <div class="td parent">{{ item.stage }}</div>
                <div class="td id">{{ item.id }}</div>
                <div class="td icon">
                    <elSvgIcon :name="item.icon"></elSvgIcon>
                </div>
                <div class="td title">{{ item.title }}</div>
                <div class="td link">{{ item.link }}</div>
                <div class="td crud">
                    <elBtn class="tipsBtn" :href="'/sectionInfo/' + item.id" icon="edit" text="編輯" />
                    <elBtn class="tipsBtn" icon="trash" text="刪除" />
                </div>
            </div>
        </template>
    </article>
</template>

<script setup lang="ts">
    import { iMenu } from '@/components/el-treeItem.vue';

    import { useStore } from '@/store';
    import { getData } from '@/hook/getData';

    const store = useStore();

    // 取得列表
    const allCheckStatus = ref(false);

    // 宣告 list 為類型iMenu 的Ref陣列
    const list = ref<iMenu[]>([]);
    // onMounted(() => {
    console.log('SectionList onMounted');
    const token = localStorage.getItem('token');
    getData('/api/section/list', 'GET', {}, { Authorization: `Bearer ${token}` }).then((result) => {
        if (result && result.status) {
            list.value = result.data.data;
            console.log(list.value);
            store.commit('route/endLoading');
        }

        console.log(list.value);
    });
    // });

    // [+] 全選功能
    const selectAll = () => {
        // 有沒有已選的
        const notCheckAll = list.value.filter((e: iMenu) => {
            return e.checked == false;
        });

        if (notCheckAll.length > 0) {
            // 有未選的
            list.value.forEach((e: iMenu) => {
                e.checked = true;
            });
        } else {
            list.value.forEach((e: iMenu) => {
                e.checked = false;
            });
        }
    };

    // 監聽 list 裡面 item.checked 的變化
    // 如果有人發生改變
    // 隨著變化更改 selectAll 的狀態
    watch(
        () => list.value,
        () => {
            const notCheckAll = list.value.filter((e: iMenu) => {
                return e.checked == false;
            });

            if (notCheckAll.length > 0) {
                allCheckStatus.value = false;
            } else {
                allCheckStatus.value = true;
            }
        },
        { deep: true },
    );
</script>

<style scoped lang="scss">
    .gridBlock {
        display: flex;
        flex-direction: column;
        @include setSize(100%, 100%);
    }

    .gridBar {
        display: grid;
        grid-gap: 2px 2px; // 水平 垂直
        grid-template-areas: 'check parent id icon title link crud';
        grid-template-columns: 40px 100px 60px 65px 1fr 1fr 150px;
        width: 100%;
        border-bottom: 2px solid #1b1b1b;
        // align-items: center;
        // justify-items: start;
        .td {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            background: #333;
            height: 50px;
            padding: 6px 10px;
            box-sizing: border-box;
            font-size: 18px;
            color: #bbb;
            fill: #bbb;
            transition: 0.15s $cubic-FiSo;
        }
        .check {
            grid-area: check;
            align-items: center;
            justify-content: center;
        }
        .parent {
            grid-area: parent;
        }
        .id {
            grid-area: id;
            align-items: center;
            justify-content: center;
        }
        .icon {
            grid-area: icon;
            align-items: center;
            justify-content: center;
        }
        .title {
            grid-area: title;
        }
        .link {
            grid-area: link;
        }
        .crud {
            grid-area: crud;
            justify-content: flex-end;
        }

        &:hover .td {
            background: $colorMain;
            height: 50px;
            padding: 5px 10px;
            font-size: 20px;
            color: #bbb;
            fill: #bbb;
        }

        animation: fit-in 0.5s $cubic-FiSo both;
        @include setDelay('animation-delay', 15, 0.045);
    }
</style>
