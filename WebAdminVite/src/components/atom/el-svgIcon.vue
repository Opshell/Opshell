<template>
    <div class="icon" @click="jump" role="">
        <svg class="svg">
            <use :xlink:href="`#${name}`" />
        </svg>
        <span v-if="text != ''" class="text">{{ text }}</span>
    </div>
</template>

<script setup lang="ts">
    // 用於存放元件的 props
    const props = defineProps({
        href: { type: String, default: '' },
        name: { type: String, required: true, default: 'circle' },
        text: { type: String, default: '' },
    });

    // 跳轉 [#]未測試
    const jump = () => {
        if (props.href !== '') {
            useRouter().push(props.href);
        }
    };
</script>

<style scoped lang="scss">
    .icon {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        @include setSize(100%, 100%);
        fill: #bbb;
        overflow: hidden;
        transition: 0.3s $cubic-FiSo;
        .svg {
            display: flex;
            align-items: center;
            justify-content: center;
            @include setSize(100%, 100%);
        }
        .text {
        }
    }
</style>
