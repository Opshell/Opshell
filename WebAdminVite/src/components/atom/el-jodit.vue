<template>
    <textarea id="editorRef" ref="editorRef" name="editor"></textarea>
</template>

<script setup lang="ts">
    import 'jodit/build/jodit.min.css';
    import { Jodit } from 'jodit';
    import { Config } from 'jodit/types/config';

    let editorRef = ref(null);
    const props = defineProps({
        modelValue: String,
        config: { type: Object, default: () => ({}) },
    });
    const emit = defineEmits(['update:modelValue']);

    let editorInstance: Jodit | null; // 建立實例

    let config: Config = {
        theme: 'default', //主题：預設 default，黑夜 dark
        placeholder: '請輸入內容...',
        zIndex: 10,
        language: 'zh_tw',
        width: '100%',
        height: '500',
        minHeight: 400,
        saveModeInCookie: false,
        toolbarSticky: false, // 工具列設定sticky
        statusbar: true, // 底部狀態欄(左：html元素；右：單字數，字數統計)
        image: {
            // 圖片相關設定
            editSrc: false,
            editStyle: false,
            useImageEditor: false,
        },
        link: {
            noFollowCheckbox: false,
            modeClassName: 'input',
        },
        i18n: {
            zh_tw: {
                top: '上',
                right: '右',
                bottom: '下',
                left: '左',
                Title: '標題',
                Link: '連結',
                'Line height': '行高',
                Alternative: '描述',
                'Alternative text': '描述',
                'Lower Alpha': '小寫英文字母',
                'Lower Greek': '小寫希臘字母',
                'Lower Roman': '小寫羅馬數字',
                'Upper Alpha': '大寫英文字母',
                'Upper Roman': '大寫羅馬數字',
            },
        },
        createAttributes: {
            blockquote: {
                style: `
                    display: block;
                    padding: 16px;
                    margin: 0 0 24px;
                    border-left: 8px solid #dddfe4;
                    background: #eef0f4;
                    color: rgba(0, 0, 0, 0.9);
                    overflow: auto;
                    word-break: break-word !important;
                `,
                class: 'blockquote-box', // class名
            },
        },
        sourceEditorCDNUrlsJS: [
            // "https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.2/ace.js",
            'https://cdn.staticfile.org/ace/1.4.2/ace.js',
        ],
        beautifyHTMLCDNUrlsJS: ['https://cdn.staticfile.org/js-beautify/1.14.4/beautifier.min.js', 'https://cdn.staticfile.org/js-beautify/1.14.4/beautify-html.min.js'],
        //disablePlugins: "stat", // 要禁用的插件，用逗號分割。stat是底部字元數與單字數統計
        buttons: `
                    bold, italic, underline, strikethrough,
                    |, font, fontsize, paragraph, brush, lineHeight,\
                    |, ul, ol, indent, outdent, left,
                    |, eraser, superscript, subscript,
                    |, image, file, video,
                    |, copyformat, selectall,
                    |, hr, table, link, symbols,
                    |, undo, redo,
                    |, source, fullsize, preview
                `,
        controls: {
            font: {
                list: Jodit.atom({
                    'Microsoft YaHei': '微軟雅黑',
                    KaiTi: '楷體',
                    '思源黑體 Heavy': '思源黑體',
                    '思源宋体 Heavy': '思源宋體',
                }),
            },
        },
        uploader: {
            // [+] 檔案上傳未完成
            url: '/upload', // 上傳檔案存放目錄
            isSuccess(res) {
                console.log('isSuccess', res);
                // return true;
                return res;
            },
            defaultHandlerSuccess(data) {
                // 參數的值 預設是接口返回的data值
                console.log('defaultHandlerSuccess', data);
                data.forEach((item) => {
                    this.s.insertImage(item.url); // 將圖片插入編輯器中，不可省略
                });
            },
            defaultHandlerError(err) {
                console.log('defaultHandlerError', err);
                this.jodit.events.fire('errorMessage', err);
            },
            error(err) {
                console.log('error', err);
                this.jodit.events.fire('errorMessage', '檔案上傳失敗');
            },
        },
    };
    onMounted(() => {
        editorInstance = Jodit.make('#editorRef', { ...config, ...props.config }); // 合併參數 建立實例
        editorInstance.value = props.modelValue ?? '';
        editorInstance.events.on('change', (newValue) => {
            emit('update:modelValue', newValue);
        });
    });
    onBeforeUnmount(() => {
        if (editorInstance) {
            editorInstance.destruct(); // 物件銷毀
        }
        editorInstance = null;
    });
    watch(
        () => props.modelValue,
        (newValue) => {
            if (editorInstance != null && editorInstance.value !== newValue) {
                editorInstance.value = newValue ?? '';
            }
        },
    );
</script>

<style lang="scss">
    .jodit-wysiwyg {
        color: #111;
    }

    .jodit-checkbox,
    .jodit-ui-checkbox__input {
        appearance: checkbox;
        -webkit-appearance: checkbox;
    }
    .jodit .jodit-input {
        color: #666;
    }
    .jodit-ui-button_variant_primary {
        background-color: var(--themeColor);
        &:hover:not([disabled]) {
            background-color: var(--themeColor-hover);
        }
    }
    // .jodit-container {
    // blockquote-box {
    //   display: block;
    //   padding: 16px;
    //   margin: 0 0 24px;
    //   border-left: 8px solid #dddfe4;
    //   background: #eef0f4;
    //   color: rgba(0, 0, 0, 0.5);
    //   overflow: auto;
    //   word-break: break-word !important;
    // }
    // }
    .jodit-workplace {
        ol,
        ul,
        li {
            list-style-position: inside;
        }
    }
</style>
