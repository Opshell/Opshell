<template>

    <label class="labInput" v-if="type == 'checkbox'">
        <input class="input" type="checkbox" v-model="rawValue">
        <span v-if="placeholder" class="text">{{ placeholder }}</span>
    </label>
    <input v-else-if="type == 'text'" :type="type" :name="name" :placeholder="placeholder" v-model="rawValue"
        class="input" :disabled="disabled" />
    <input v-else :type="type" :name="name" :placeholder="placeholder" v-model="rawValue" class="input"
        :disabled="disabled" />
</template>

<script>
    export default {
        name: "elInput",
        props: {
            type: {
                type: String,
                default: "text",
            },
            name: {
                type: String,
                default: "",
            },
            value: {
                type: String,
                default: "",
            },
            placeholder: {
                type: String,
                default: "",
            },
            disabled: {
                type: Boolean,
                default: false,
            },
        },
        data: function () {
            return {
                rawValue: "",
            };
        },
        mounted: function () {
            let vm = this;
            vm.rawValue = vm.value;
        },
        watch: {
            rawValue: function (v) {
                this.$emit("input", v);
            },
        },
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

        &[type="text"],
        &[type="password"] {
            padding: 0px 5px;
            vertical-align: top;
            border: 1px solid rgba(216, 216, 216, 0.8);
        }

        &[type="radio"],
        &[type="checkbox"] {
            margin-right: 5px;
            cursor: pointer;
            vertical-align: middle;
        }

        &[type="number"] {
            -moz-appearance: textfield;
        }
        &[type="number"]::-webkit-inner-spin-button,
        [type="number"]::-webkit-outer-spin-button {
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
        padding-left: 30px;
        .input{

            &[type="checkbox"] {
                // position: absolute;
                @include setSize(0, 0);
                top: 0;
                left: 0;

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
                    transform: translate3d(-100%, -50%, 0);
                    transition: border-color, background-color .15s $cubic-FiSo;
                }
                &::after {
                    @include setSize(0, 0);
                    border-top: none;
                    border-right: none;
                    border-width: 0;
                    border-radius: 1px;
                    transform: rotateZ(-45deg) translate3d(-30%, -200%, 0);
                }

                &:checked {
                    &::before{
                        border-color: #20ac33;
                        background: #20ac33;
                    }
                    &::after {
                        @include setSize(20px, 10px);
                        border: 3px solid #eee;
                        border-top: none;
                        border-right: none;
                        filter: drop-shadow(0 0 3px rgba(0, 0, 0, 1));
                        transition: border-color .15s $cubic-FiSo,
                                    height .15s $cubic-FiSo,
                                    width .15s $cubic-FiSo .14s;
                    }
                }
            }
        }
    }
</style>
