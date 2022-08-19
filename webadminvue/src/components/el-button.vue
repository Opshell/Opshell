<template>
    <router-link v-if="href != ''"  :to="href"
        class="Btn" role="button"
        :title="title"
        :class="[{icon: icon != ''}]"
        @mouseenter="unfold"
        @mouseleave="unfold"
        :style="boxSize"
    >
        <elSvgIcon v-if="icon != ''" class="svgIcon" :name="icon" />
        <span class="text" :style="textSize">{{ text }}</span>
    </router-link>

    <div v-else class="Btn" role="button"
        :title="title"
        :class="[{icon: icon != ''}]"
        @mouseenter="unfold"
        @mouseleave="unfold"
        :style="boxSize"
    >
        <elSvgIcon v-if="icon != ''" class="svgIcon" :name="icon" />
        <span class="text" :style="textSize">{{ text }}</span>
    </div>
</template>

<script>
    import { defineAsyncComponent, ref, computed } from "vue";
    export default {
        name: "elBtn",
        components: {
            elSvgIcon: defineAsyncComponent(() => import("../components/el-svgIcon.vue")),
        },
        props: {
            title: {
                type: String,
                default: "",
            },
            icon: {
                type: String,
                default: "",
            },
            href: {
                type: String,
                default: "",
            },
            text: {
                type: String,
                default: "",
            },
        },
        setup(props) {
            const isHover = ref(false);
            const textLen = ref(props.text.length); // 字數

            // 判斷hover
            const unfold = () => {
                if (props.icon != '') {
                    isHover.value = !isHover.value;
                }
            };
            // 如果有icon && 有文字 && 被hover
            const iconTextHover = computed(() => {
                return (props.icon != '' && props.text != '' && isHover.value);
            });

            // 盒子展開尺寸(讀取computed 要使用value)
            const boxSize = computed(() => {
                return (iconTextHover.value)? `width: calc(50px + ${textLen.value}em);` : '';
            });
            // 文字展開尺寸
            const textSize = computed(() => {
                return (iconTextHover.value)? `width: ${textLen.value}em;` : '';
            });

            return {
                boxSize,
                textSize,
                unfold
            };
        }
    };
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss">
    .Btn{
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        background: $colorMain;
        width: 100%;
        padding: 8px 15px;
        border: 1px solid rgba(60, 60, 60, .1);
        border-radius: 1px;
        box-sizing: border-box;
        box-shadow: 0 0 1px 0 rgba(0, 0, 0, .15);
        color: $colorBase;
        cursor: pointer;
        transition: .2s $cubic-FiSo;
        overflow: hidden;

        &.icon {
            flex-grow: 0;
            flex-shrink: 0;
            justify-content: flex-start;
            @include setSize(40px, 40px);
            padding: 5px;
            box-shadow: 1px 1px 1px 0 rgba(0, 0, 0, .1),
                -1px -1px 1px 0 rgba(255, 255, 255, .1);

            .text{
                width: 0;
                margin: 0;
                transition: .15s $cubic-FiSo;
                white-space: nowrap;
                overflow: hidden;
            }

            &:hover {
                .text{ margin: 0 0 0 5px; }
            }
            + .icon { margin: 0 0 0 10px; }
        }

        .svgIcon{
            flex-shrink: 0;
            fill: currentColor;
            @include setSize(30px, 100%);
            min-width: 12px;
            min-height: 12px;
            overflow: hidden;
            transition: .3s ease-in-out;
        }

        &:hover{
            background: $colorSub2;
            color: $colorSubs;
            .svgIcon{ fill: $colorSubs; }
        }
        &:active{
            background: $colorSubs;
            color: $colorMain;
            transition: .03s $cubic-FiSo;
            box-shadow: 0 0 1px 0 rgba(0, 0, 0, .15) inset,
                        0 0 1px 0 rgba(255, 255, 255, .35);
            .svgIcon{
                fill: $colorMain;
                transition: 0;
            }
        }

        // &::before {
        //     content: '';
        //     position: absolute;
        //     top: 50%;
        //     left: 50%;
        //     background: $colorSubs;
        //     @include setSize(0, 0);
        //     border-radius: 999px;
        //     transition: .5s $cubic-FiSo;
        //     transform-origin: 50% 50%;
        //     transform: translate3d(-50%, -50%, 0);
        //     z-index: 1;
        // }
        // &:hover{
        //     background: $colorSub2;
        // }
        // &:active{
        //     background: $colorSub2;
        //     &::before {
        //         @include setSize(200px, 200px);
        //     }
        // }
    }
</style>
