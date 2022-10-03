<template>
    <div v-if="href == ''" class="icon">
        <svg class="svg">
            <use :xlink:href="`#${name}`" />
        </svg>
        <span v-if="text != ''" class="text">{{ text }}</span>
    </div>

    <router-link v-else class="icon" :to="href">
        <svg class="svg">
            <use :xlink:href="`#${name}`" />
        </svg>
        <span v-if="text != ''" class="text">{{ text }}</span>
    </router-link>
</template>

<script lang="ts">
    export default {
        name: 'el-svgIcon',
        props: {
            href: {
                type: String,
                default: '',
            },
            name: {
                type: String,
                required: true,
                default: 'email',
            },
            text: {
                type: String,
                default: '',
            },
        },
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
        &.tipsBtn {
            cursor: pointer;
            // &:hover {
            // 提示按鈕型icon hover時
            //     position: absolute;
            //     width: auto;
            //     border-radius: 20px;
            // }
        }
    }
</style>
