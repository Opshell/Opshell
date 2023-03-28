<template>
    <input class="input" :type="type" :placeholder="placeholder" :value="modelValue" @input="updateModelValue($event)" />
</template>

<script setup lang="ts">
    interface iProps {
        modelValue?: string | number | boolean | null;
        type?: string;
        placeholder?: string;
    }
    const props = withDefaults(defineProps<iProps>(), {
        type: 'text',
        placeholder: '',
    });

    // type-based (TS)
    const emit = defineEmits<{
        (e: 'change', id: number): void;
        (e: 'update:modelValue', value: string): void;
    }>();

    // input值更新的時候，emit出去
    const updateModelValue = (event: Event) => {
        // 不斷言 HTMLInputElement的話 取值會有錯誤
        const target = event.target as HTMLInputElement;

        emit('update:modelValue', target.value);
    };
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
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

        &[type='text'],
        &[type='password'] {
            padding: 0px 5px;
            vertical-align: top;
            border: 1px solid rgba(216, 216, 216, 0.8);
        }

        &[type='radio'],
        &[type='checkbox'] {
            margin-right: 5px;
            cursor: pointer;
            vertical-align: middle;
        }

        &[type='number'] {
            -moz-appearance: textfield;
        }
        &[type='number']::-webkit-inner-spin-button,
        [type='number']::-webkit-outer-spin-button {
            margin: 0;
            -webkit-appearance: none;
        }

        &:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 30px #fcfcfc inset;
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
