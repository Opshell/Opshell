<!--
    用vue3 *.vue + typescript 做一個 可以依照 type 分別渲染成
    radio checkbox switch 三種不同的和選方式
    如果有輸入 list 則v-for 出列表 如果是switch則不引用list參數
-->

<template>
    <!-- type == radio -->
    <template v-if="type == 'radio'">
        <label v-for="(item, i) in list" class="checkBox radio" :key="'radio_' + i">
            <input type="radio" class="input hide" :value="item.value" v-model="model" />
            <div class="dot circle"></div>
            <span class="text">{{ item.text }}</span>
        </label>
    </template>

    <!-- type == check -->
    <template v-if="type == 'check'">
        <label v-for="(item, i) in list" class="checkBox" :key="'check_' + i">
            <input type="checkbox" class="input hide" :value="item.value" v-model="model" />
            <div class="dot"></div>
            <span class="text">{{ item.text }}</span>
        </label>
    </template>

    <!-- type == switch -->
    <label v-if="type == 'switch'" class="switchInput" title="">
        <input type="checkbox" class="input hide" v-model="model" />
        <div class="dot"></div>
        <span class="text"></span>
    </label>
</template>

<script lang="ts" setup>
    import { defineProps, ref } from 'vue';

    interface iProps {
        type: string;
        list?: { text: string; value: string }[] | null;
        modelValue: string | number | boolean | Array<string | number>;
    }

    const props = defineProps<iProps>();

    const type = ref(props.type);
    const list = ref(props.list);

    const emit = defineEmits(['update:modelValue']);
    const model = computed({
        get() {
            return props.modelValue;
        },
        set(value) {
            emit('update:modelValue', value);
        },
    });
</script>

<style lang="scss">
    .checkBox {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 8px;

        .dot {
            flex-shrink: 0;
            position: relative;
            background: #eee;
            @include setSize(18px, 18px);
            border-radius: 3px;

            box-shadow: -1px -1px 1px 0 rgba($color: #eee, $alpha: 0.65), 1px 1px 1px 0 rgba($color: #000, $alpha: 0.25);

            overflow: hidden;
            &::before {
                content: '';
                position: absolute;
                top: 50%;
                left: 50%;
                @include setSize(100%, 100%);
                border: 6px solid $colorSubs;
                box-sizing: content-box;
                box-shadow: 0 0 1px 1px rgba($color: #000, $alpha: 0.15);
                transform-origin: 50% 50%;
                transform: translate3d(-50%, -50%, 0);
                transition: 0.2s $cubic-FiSo;
                z-index: 1;
            }

            &.circle {
                border-radius: 50%;
                &::before {
                    border-radius: 50%;
                }
            }
        }

        :checked + .dot {
            &::before {
                @include setSize(0, 0);
            }
        }

        .text {
            font-size: 18px;
        }

        + .checkBox {
            margin: 0 8px;
        }
        &:first-child {
            margin-left: 0;
        }
        &:last-child {
            margin-right: 0;
        }
    }

    .switchInput {
        flex-shrink: 0;
        position: relative;
        background: #ccc;
        @include setSize(50px, 26px);
        border-radius: 13px;
        .dot {
            // No
            @include setSize(100%, 100%);
            border-radius: 13px;
            @include setSunken();
            transition: 0.2s $cubic-FiSo;
            &::after {
                content: '';
                position: absolute;
                top: 50%;
                left: 50%;
                background: #f5f5f5;
                @include setSize(22px, 22px);
                border-radius: 50%;
                box-shadow: 1px 1px 5px 0 rgba(0, 0, 0, 0.3);
                transform-origin: 50% 50%;
                transform: translate3d(-105%, -50%, 0);
                transition: 0.15s $cubic-SiMo;
                z-index: 1;
            }
        }

        :checked + .dot {
            // Yes
            background: $colorSubs;
            &::after {
                background: #fff;
                @include setSize(30px, 30px);
                box-shadow: -1px 1px 4px 0 rgba(0, 0, 0, 0.3);
                transform: translate3d(-10%, -50%, 0);
                transition: 0.25s $cubic-SiRo;
            }
        }
    }
</style>
