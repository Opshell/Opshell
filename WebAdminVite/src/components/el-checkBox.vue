<template>
    <label class="labInput">
        <input class="input" type="checkbox" :checked="checked" @change="updateCheckStatus($event)" />
        <span v-if="text" class="text">{{ text }}</span>
    </label>
</template>

<script lang="ts" setup>
    // 一個vite + ts + vue3 的checkbox
    interface iProps {
        checked?: boolean;
        text?: string;
    }

    const props = withDefaults(defineProps<iProps>(), {
        checked: false,
        text: '',
    });

    const emit = defineEmits<{
        (e: 'change', id: number): void;
        (e: 'update:checked', checked: boolean): void;
    }>();

    // checkbox 狀態改變時
    const updateCheckStatus = (event: Event) => {
        // 不斷言 HTMLInputElement的話 取值會有錯誤
        const target = event.target as HTMLInputElement;

        emit('update:checked', target.checked);
    };
</script>

<style lang="scss">
    input {
        @include setSize(100%, 35px);
        box-sizing: border-box;
        @extend %baseFont;
        -webkit-autofill: unset;

        &:focus {
            outline: 0;
        }
        &::placeholder {
            color: #ccc;
        }

        &[type='radio'],
        &[type='checkbox'] {
            margin-right: 5px;
            cursor: pointer;
            vertical-align: middle;
        }
    }
    .labInput {
        position: relative;
        display: flex;
        align-items: center;
        margin: 0;
        .input {
            position: relative;
            &[type='checkbox'] {
                @include setSize(0, 0);
                margin: 0;
                &::before,
                &::after {
                    content: '';
                    position: absolute;
                    @include setSize(0, 0);
                    box-sizing: border-box;
                    background: transparent;
                }
                &::before {
                    @include setSize(20px, 20px);
                    border-radius: 3px;
                    border: 3px solid #aaa;
                    transform: translate3d(-50%, -50%, 0);
                    transition: border-color 0.15s $cubic-FiSo, background-color 0.15s $cubic-FiSo 0.05s;
                }
                &::after {
                    @include setSize(0, 0);
                    border-top: none;
                    border-right: none;
                    border-width: 0;
                    border-radius: 1px;
                    transform: rotateZ(-45deg) translate3d(0, -120%, 0);
                }

                &:checked {
                    &::before {
                        border-color: #20ac33;
                        background-color: #16a328;
                    }
                    &::after {
                        @include setSize(20px, 10px);
                        border: 3px solid #eee;
                        border-top: none;
                        border-right: none;
                        filter: drop-shadow(0 0 3px rgba(0, 0, 0, 1));
                        transition: border-color 0.15s $cubic-FiSo, height 0.15s $cubic-FiSo, width 0.15s $cubic-FiSo 0.14s;
                    }
                }

                + .text {
                    margin: 0 0 0 12px;
                }
            }
        }
    }
</style>
