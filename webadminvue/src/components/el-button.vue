<template>
    <div class="Btn" role="button" :title="title"
        :class="[{icon: icon != ''}]"
        @mouseenter="unfold"
        @mouseleave="unfold"
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
            text: {
                type: String,
                default: "",
            },
        },
        setup(props) {
            let isHover = ref(false);

            // 計算展開長度
            const textSize = computed(() => {
                const textLen = props.text.length; // 字數
                let size = ''; // 預設輸出

                // 如果有icon && 有文字 && 被hover
                if (props.icon != '' && props.text != '' && isHover.value) {
                    size = `width: ${textLen}em;`
                }

                return size;
            });
            // 判斷hover
            const unfold = () => {
                if (props.icon != '') {
                    isHover.value = !isHover.value;
                }
            };

            return {
                textSize,
                unfold
            };
        }
    };
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
    .Btn{
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        cursor: pointer;
        .svgIcon{
            flex-shrink: 0;
            fill: currentColor;
            @include setSize(30px, 100%);
            min-width: 12px;
            min-height: 12px;
            overflow: hidden;
            transition: .3s ease-in-out;
        }

        &.icon {
            flex-shrink: 0;
            justify-content: flex-start;
            padding: 5px;
            box-shadow: 1px 1px 1px 0 rgba(0, 0, 0, .1),
                -1px -1px 1px 0 rgba(255, 255, 255, .1);
            overflow: hidden;
            .text{
                width: 0;
                margin: 0 0 0 5px;
                transition: .3s $cubic-FiSo;
                white-space: nowrap;
            }
        }

        &:hover{
            color: $colorSubs;
            .svgIcon{ fill: $colorSubs; }
        }
        &:active{
            color: #eee;
            transition: 0;
            .svgIcon{
                fill: #eee;
                transition: 0;
            }
        }
    }
</style>
