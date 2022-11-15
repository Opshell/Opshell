<template>
    <template v-for="(item, i) in list" :key="'bar_' + i">
        <div class="gridBar">
            <div class="td check"><elInput type="checkbox" v-model="item.checked" /></div>
            <div class="td parent">{{ item.depath_id }}</div>
            <div class="td id">{{ item.id }}</div>
            <div class="td icon">
                <elSvgIcon :name="item.icon"></elSvgIcon>
            </div>
            <div class="td title">{{ item.title }}</div>
            <div class="td link">{{ item.link }}</div>
            <div class="td crud">
                <elBtn class="tipsBtn" :href="'/sectionInfo/' + item.id" icon="edit" text="編輯" />
                <elBtn class="tipsBtn" icon="trash" text="刪除" @click="delectSection(item.id)" />
            </div>
        </div>

        <elSectionBar v-if="item.child" :menu="item.child" :depth="depth + 1" />
    </template>
</template>

<script setup lang="ts">
    import { iMenu } from '@/components/el-treeItem.vue';
    import { obj } from '@/hook/opshellLibary';

    interface iProps {
        menu: iMenu[];
        depth?: number;
    }
    const props = withDefaults(defineProps<iProps>(), {
        depth: 0,
    });

    const list = ref(props.menu);

    for (const key in list.value) {
        if (obj.objHOP(list.value, key)) {
            const ele = list.value[key];

            let depath = '';
            for (let i = 0; i < props.depth; i++) {
                depath += '=';
            }
            if (props.depth > 0) {
                depath += '>';
            }

            // 父層紀錄 & 是否選取
            list.value[key].parent_id = ele.parent_id;
            list.value[key].depath_id = ele.parent_id + ' ' + depath;
            list.value[key].checked = false;
        }
    }

    const delectSection = (id: number) => {
        console.log(id);
    };

    watch(
        () => props.menu,
        (val) => {
            list.value = val;
        },
        { deep: true },
    );
</script>

<style scoped lang="scss"></style>
