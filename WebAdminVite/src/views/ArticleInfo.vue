<template>
    <form class="formBlock">
        <MolecImgUpload class="imgBlock" v-model="info.img"></MolecImgUpload>
        <div class="fieldBlock">
            <ElInput type="hidden" v-model="info.title" placeholder="請輸入標題"></ElInput>
            <ElInput v-model="info.sort" placeholder="請輸入排序"></ElInput>
            <ElCheck type="switch" v-model="info.enable"></ElCheck>
        </div>
        <ElJodit v-model="info.content"></ElJodit>

        <div class="BtnBox">
            <ElBtn class="submit" text="送出" @click="submit"></ElBtn>
            <ElBtn class="back" text="回列表" @click="backList"></ElBtn>
        </div>
    </form>
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

    // onMounted(() => {
    const id = route.params.id || '';
    const info: Ref<Opshell.iInfo> = ref({
        id: 0,
        title: '',
        content: '',
        category: '',
        img: '',
        created_at: '',
        updated_at: '',
    });

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

    const submit = () => {
        console.log(info.value);
        const token = localStorage.getItem('token');
        getData(`/api/news/update/${id}`, 'POST', info.value, { Authorization: `Bearer ${token}` }).then((result) => {
            console.log(result);
            if (result && result.status) {
                console.log(result.data);
                // result.data Json 轉 Array
                info.value = JSON.parse(result.data);

                store.commit('route/endLoading');
            }
        });
    };

    const backList = () => {
        // vite 回上一頁
        window.history.back();
    };
</script>

<style lang="scss">
    .formBlock {
        display: grid;
        grid-template-areas:
            'img field'
            'editor editor';
        grid-template-columns: 500px 1fr;
        width: 100%;
        max-width: 1024px;
        gap: 20px;
        .imgBlock {
            grid-area: img;
        }
        .fieldBlock {
            grid-area: field;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
            gap: 20px;
        }
        .jodit {
            grid-area: editor;
        }
    }

    .BtnBox {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 20px;
    }
</style>
