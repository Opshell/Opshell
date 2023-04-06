<!--
    建立一個名為 UIUXSet 的元件 (component)
    裡面是各種基礎的el-input.vue的 component 引入
    這樣就可以在這裡測試 統一風格
    之後可以在其他頁面直接使用
-->
<template>
    <div class="uisBlock">
        <div class="bar"><ElCheck type="radio" :list="list" v-model="radioList" /></div>
        <div class="bar"><ElCheck type="check" :list="list" v-model="checkList" /></div>
        <ElCheck type="switch" v-model="show" />
        <ElInput placeholder="hk4" />
        <ElInput type="number" />
        <ElInput type="email" />
        <ElInput type="tel" />
        <ElInput type="password" />
        <ElJodit v-model="description" :config="config" />

        <!--
        <ElImg />
        <ElIcon />
        <ElRadio />
        <ElSwitch />
        <ElSelect />
        <ElTextarea />
        <ElFile />
        <ElBtn />
        <ElTag />
        -->
    </div>
</template>

<script setup lang="ts">
    import { useStore } from '@/store';
    import { Ref } from 'vue';

    const store = useStore();
    const radioList: Ref<string | number> = ref('');
    const checkList: Ref<Array<string | number>> = ref([]);
    const show: Ref<boolean> = ref(false);
    const list = [
        {
            text: '各種文字測試',
            value: '1',
        },
        {
            text: 'Obgpiz013259',
            value: '2',
        },
        {
            text: '!@#$%^&*?><+*/([".{|}])`',
            value: '3',
        },
    ];

    const description: Ref<string> = ref('<h3>Description</h3>');

    //配置项
    let config = {
        theme: 'default', // 可以dark
        height: 500,
    };
    setTimeout(() => {
        description.value = '改變編輯器內容';
    }, 2000);

    store.commit('route/endLoading');
</script>

<style lang="scss">
    .uisBlock {
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        gap: 21px;
        .bar {
            display: flex;
        }
    }
</style>
