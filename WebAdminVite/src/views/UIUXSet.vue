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
        <!-- <ckeditor :editor="editorStyle" v-model="description" /> -->
        <ElBtn @click="getContent" text="取得內容" />
        <!-- <ElCkeditor ref="editor" /> -->

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

    const editorStyle = 'ClassicEditor';
    const description: Ref<string> = ref('<h3>Description</h3>');
    // const editorConfig = {
    //     toolbar: {
    //         items: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList'],
    //         // 設定工具列，可使用'|'隔開功能
    //     },
    //     removePlugins: ['Bold', 'Italic'],
    //     // 刪除工具列的功能
    //     placeholder: '請輸入文章...',
    //     // 當編輯器內容為空時顯示此字串
    //     initialData: '<h2>我是預設字串</h2>',
    //     // 初始化載入文字
    //     heading: {
    //         // 設定 Heading 內的樣式，可新增多個
    //         options: [
    //             {
    //                 model: 'paragraph',
    //                 title: 'Paragraph',
    //                 class: 'ck-heading_paragraph',
    //             },
    //             {
    //                 model: 'heading1',
    //                 view: 'h2',
    //                 title: 'Heading 1',
    //                 class: 'ck-heading_heading1',
    //             },
    //             {
    //                 model: 'heading2',
    //                 view: 'h3',
    //                 title: 'Heading 2',
    //                 class: 'ck-heading_heading2',
    //             },
    //         ],
    //     },
    //     language: 'zh',
    //     // 設定語言
    // };

    //變量名必須與template里的ref引用名相同
    const editor = ref();
    function getContent() {
        let content = editor.value.getContent();
        //調用子組件的getContent方法
        alert(content);
    }

    onMounted(() => {
        const val = '<p>script setup 是在單文件組件 (SFC) 中使用組合式 API 的編譯時語法糖。相比於普通的 script 語法，它具有更多優勢：</p>' + '<ul>' + '<li>更少的樣板內容，更簡潔的代碼。</li>' + '<li>能夠使用純 Typescript 聲明 props 和拋出事件。</li>' + '<li>更好的運行時性能 (其模板會被編譯成與其同一作用域的渲染函數，沒有任何的中間代理)。</li>' + '<li>更好的 IDE 類型推斷性能 (減少語言伺服器從代碼中抽離類型的工作)。</li>' + '</ul>';

        console.log(editor.value);

        // 調用子組件initCKEditor方法，初始化編輯器並傳初值val。
        editor.value.initCKEditor(val);
    });

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
