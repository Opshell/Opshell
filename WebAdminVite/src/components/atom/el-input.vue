<template>
    <!-- 一個可以依照:type 來變化 text pass number tel email search 幾種常用的input -->
    <label class="inputBox">
        <input class="input" :value="modelValue" :placeholder="placeholder" @input="updateModelValue($event)" />
        <span class="placeholder" :class="[{ title: feild }]" v-text="placeholder"></span>
        <span v-if="remark != ''" class="remark" v-text="remark"></span>
    </label>
</template>

<script setup lang="ts">
    interface iProps {
        modelValue?: string | null;
        feild?: boolean;
        placeholder?: string;
        remark?: string;
    }
    const props = withDefaults(defineProps<iProps>(), {
        feild: true,
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
        background: rgba(255, 255, 255, 0.95);
        @include setSize(100%, 38px);
        max-width: 500px;
        min-width: 150px;
        padding: 5px 10px;
        border: 2px solid #e5e5e5;
        border-radius: 3px;
        letter-spacing: 1.5px;
        backdrop-filter: blur(5px);
        -webkit-autofill: unset;
        &:focus {
            outline: 0;
        }
        &::placeholder {
            color: transparent;
        }

        &[type='text'],
        &[type='password'] {
            padding: 0px 5px;
            vertical-align: top;
            border: 1px solid rgba(216, 216, 216, 0.8);
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
    .inputBox {
        position: relative;
        padding: 16px 0 0;
        &:hover {
            .input {
                border-color: $colorMain;
            }
            .placeholder {
                color: $colorMain;
            }
        }

        .input {
            &:not(:placeholder-shown) ~ .placeholder,
            &:focus ~ .placeholder {
                top: 16px;
                left: 0;
                padding: 1px 10px;
                color: $colorMain;
                font-size: 14px;
                transform: translate3d(0, -100%, 0);
            }
            &:not(:placeholder-shown) {
                background: rgba(230, 230, 230, 0.8);
            }
            &:focus {
                border-color: $colorSubs;
                & ~ .placeholder {
                    color: $colorSubs;
                }
            }
        }
        .placeholder {
            position: absolute;
            top: calc(50% + 8px);
            left: 10px;
            font-size: 15px;
            color: #666;
            line-height: 1.2;
            text-align: left;
            transform: translate3d(0, -50%, 0);
            transition: 0.2s $cubic-FiSo;
        }
    }
</style>
