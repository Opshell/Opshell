<template>
    <!-- 做一個可以新增、修改、預覽、刪除的圖片上傳元件 -->
    <div class="imgUploadBlock">
        <label class="uploadBlock">
            <input type="file" class="fileInput" accept="image/*" :multiple="props.isMultiple" @change="previewImage" />

            <div v-if="previewList.length == 0" class="note">將圖片拖曳進、點擊此區域來上傳圖片</div>

            <div v-else class="previewBlock">
                <div v-for="(item, i) in previewList" class="previewBox" :key="'img_' + i">
                    <img :src="item" class="img" />
                    <p class="mb-0">file name: {{ imageDataList[i].name }}</p>
                    <p>size: {{ imageDataList[i].size / 1024 }}KB</p>
                </div>
            </div>

            <div v-if="modelValue" class="previewBlock">
                <img :src="modelValue" alt="" />
            </div>

            <ElSvgIcon v-if="previewList.length > 0" name="cross-circle" class="icon" @click.stop="clear" title="刪除圖片"></ElSvgIcon>
        </label>
    </div>
</template>

<script setup lang="ts">
    /* global Opshell */
    // [-] type import
    import { Ref } from 'vue';

    interface iProps {
        modelValue?: string | null;
        isMultiple?: boolean;
    }

    let previewList: Ref<string[]> = ref([]); // 預覽圖片陣列
    let imageDataList: Ref<File[]> = ref([]); // 圖片資料陣列

    const props = withDefaults(defineProps<iProps>(), {
        modelValue: '',
        isMultiple: false,
    });

    const previewImage = (event: Event) => {
        let input = event.target as HTMLInputElement;
        let count = 0;
        let i = 0;
        if (input.files) {
            count = input.files.length;
            console.log('count', count);
            while (count--) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    previewList.value.push(e.target?.result as string);
                };

                imageDataList.value.push(input.files[i]);
                reader.readAsDataURL(input.files[i]);
                i++;
            }
        }
    };

    const clear = () => {
        previewList.value = [];
        imageDataList.value = [];
    };

    // const upload = (file, onUploadProgress) => {
    //     let formData = new FormData();
    //     formData.append('file', file);
    //     return http.post('/upload', formData, {
    //         headers: {
    //             'Content-Type': 'multipart/form-data',
    //         },
    //         onUploadProgress,
    //     });
    // };

    // const getFiles = () => {
    //     return http.get('/files');
    // };
</script>

<style scope lang="scss">
    .imgUploadBlock {
        display: flex;
        flex-direction: column;
        @include setSize(100%, 100%);
        max-width: 500px;
        max-height: 500px;

        .uploadBlock {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e9e9e9 url('@/assets/images/No_Image.jpg') no-repeat 50% 50%;
            background-size: contain;
            @include setSize(100%, 350px);
            border: 5px dashed #ccc;
            border-radius: 12px;
            box-shadow: 0 0 3px 1px rgba(0, 0, 0, 0.25) inset;

            cursor: pointer;
            transition: 0.15s $cubic-FiSo;
            overflow: hidden;

            &:hover {
                border-color: #999;
            }

            .fileInput {
                @include setSize(100%, 100%);
                cursor: pointer;
                opacity: 0;
            }

            .note {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                color: #333;
                letter-spacing: 1px;
                font-size: 26px;
                font-weight: bold;
                text-align: center;
                text-shadow: 0 0 1px #fff;
            }

            .previewBlock {
                position: absolute;
                top: 0;
                left: 0;
                @include setSize(100%, 100%);
                .previewBox {
                    display: flex;
                    flex-direction: column;
                    align-items: flex-start;
                    justify-content: center;
                    @include setSize(100%, 100%);
                }
                .img {
                    // width: 500px;
                    max-width: 100%;
                }
            }

            .icon {
                position: absolute;
                top: 10px;
                right: 10px;
                @include setSize(50px, 50px);
                color: #333;
                z-index: 10;
            }
        }
    }
</style>
