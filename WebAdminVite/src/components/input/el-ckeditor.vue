<template>
    <div class="ckeditor">
        <div id="toolbar-container"></div>
        <div id="editor"></div>
    </div>
</template>

<script lang="ts">
    // 宣告每一行功能
    // 然後合併進 toolbarItems
    const heading = ['heading'];
    const text = ['|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'mediaEmbed'];
    const font = ['|', 'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor'];
    const code = ['|', 'uploadImage', 'code', 'codeBlock'];
    const doing = ['|', 'undo', 'redo'];

    const toolbarItems = [...code, ...text, ...font, '-', ...doing, ...heading];
    export default {};
</script>
<script setup lang="ts">
    import { ref, defineExpose } from 'vue';
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    // [+] EditorConfig 型態問題待解決
    // import { EditorConfig } from '@ckeditor/ckeditor5-core/src/editor/editorconfig';

    // interface iProps {
    //     config?: EditorConfig;
    // }

    // const props = withDefaults(defineProps<iProps>(), {
    //     config: {
    //         toolbar: {
    //             items: [...toolbarItems],
    //         },
    //         shouldNotGroupWhenFull: true,
    //         language: 'zh',
    //         table: {
    //             contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells'],
    //         },
    //         licenseKey: '',
    //     },
    // });

    let editor = ref();
    //方法：初始化ck編輯器
    function initCKEditor(val: string) {
        const editorDOM = <HTMLElement>document.querySelector('#editor');
        if (editorDOM) {
            // ClassicEditor.create(editorDOM, props.config)
            ClassicEditor.create(editorDOM)
                .then((newEditor) => {
                    const toolbarContainer = document.querySelector('#toolbar-container');
                    if (toolbarContainer) {
                        toolbarContainer.appendChild(<HTMLElement>newEditor.ui.view.toolbar.element);
                        editor.value = newEditor;
                        newEditor.setData(val);
                    }
                })
                .catch((error) => {
                    console.error(error);
                });
        }
    }

    // 獲得編輯器內容
    function getContent() {
        return editor.value.getData();
    }

    // 對外暴露兩個方法
    defineExpose({ initCKEditor, getContent });
</script>

<style lang="scss">
    .ck-content {
        min-height: 350px;
        color: #111;
    }
</style>
