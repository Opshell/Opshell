<template>
    <!-- https://blog.csdn.net/qq_40596488/article/details/108514323 -->
    <!-- 做一個jodit 的編輯器元件 -->
    <jodit-editor v-model="content" :editorOptions="options"></jodit-editor>
</template>

<script setup lang="ts">
    // https://www.npmjs.com/package/jodit-vue3
    import 'jodit/build/jodit.min.css';

    // 用vue3 setup + typescript寫一個 jodit的編輯器元件
    import { JoditEditor } from 'jodit-vue3';

    // const editor = new Jodit('#editor');
    const editor = new JoditEditor('#editor');

    // content:"",
    //   options:{
    //     textIcons: false,
    //     iframe: false,
    //     iframeStyle: '*,.jodit_wysiwyg {color:red;}',
    //     height: 'auto',
    //     minHeight:400,
    //     maxHeight:600,
    //     defaultMode: Jodit.MODE_WYSIWYG,
    //     imageDefaultWidth:'100%',
    //     observer: {
    //         timeout: 100
    //     },
    //     commandToHotkeys: {
    //         'openreplacedialog': 'ctrl+p'
    //     },
    //   }
</script>
