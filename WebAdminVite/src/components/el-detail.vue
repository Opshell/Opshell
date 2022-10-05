<template>
    <section v-if="info" class="gridList" role="table">
        <header class="header">
            <ElSvgIcon :name="header.icon" />
            <h2 class="title">
                <ElFormGroup title="功能名稱">
                    <ElInput v-model="header.title" />
                </ElFormGroup>
            </h2>
        </header>

        <div class="groupBlock">
            <ElFormGroup v-for="(item, i) in info" :title="item.title" :key="'group_' + i">
                <elInput v-model="item.value" :type="item.type" />
            </ElFormGroup>
        </div>
    </section>
</template>

<script setup lang="ts">
    import { getData } from '@/hook/getData';
    import { obj } from '@/hook/opshellLibary';
    import { useStore } from '@/store';
    const store = useStore();

    interface iProps {
        url: string;
        demand: string[];
        value?: {};
    }
    const props = withDefaults(defineProps<iProps>(), {});

    const info = obj.deepCopy(props.demand);
    // let data = {};

    interface iData {
        title: string;
        icon: string;
        img: string;
    }

    let header: iData = { title: '', icon: '', img: '' };

    const token = localStorage.getItem('token');
    getData(props.url, 'GET', {}, { Authorization: `Bearer ${token}` }).then((result) => {
        if (result && result.status) {
            let data = result.data;

            if (!obj.isObjEmpty(data)) {
                header.title = data.title;
                header.icon = data.icon;
                header.img = data.img;

                for (const key in info) {
                    if (obj.objHOP(info, key)) {
                        const ele = info[key];

                        // 設定資料庫撈出來的值到info
                        info[key].value = data[ele.field] ? data[ele.field] : info[key].default;
                    }
                }
            }
        }

        store.state.commit('route/endLoading');
    });
</script>

<style scoped lang="scss">
    .header {
        display: flex;
        align-items: flex-end;
        justify-content: flex-start;
        .groupBox {
            width: calc(100% - 150px);
        }
        .icon {
            @include setSize(100px, 100px);
            padding: 5px;
            border: 5px solid #333;
            border-radius: 3px;
            margin: -20px 5px 5px;
        }
        .title {
            flex: 1;
        }
    }

    .groupBlock {
        display: flex;
        flex-wrap: wrap;
        width: 100%;
    }
</style>
