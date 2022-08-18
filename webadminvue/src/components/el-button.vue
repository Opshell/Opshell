<template>
    <div class="Btn" :class="[{icon: icon != ''}]" role="button" :title="title">
        <elSvgIcon v-if="icon != ''" class="svgIcon" :name="icon" />
        <span v-if="text != ''" class="text">{{ text }}</span>
    </div>
</template>

<script>
    import elSvgIcon from "../components/el-svgIcon.vue";

    export default {
        name: "elBtn",
        components: { elSvgIcon },
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
        data: function () {
            return {};
        },
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
            + .text{
                width: 0;
                margin: 0 0 0 15px;
                transition: .3s $cubic-FiSo;
            }
        }

        &.icon {
            flex-shrink: 0;
            justify-content: flex-start;
            padding: 5px;
            box-shadow: 1px 1px 1px 0 rgba(0, 0, 0, .1),
                -1px -1px 1px 0 rgba(255, 255, 255, .1);
            overflow: hidden;
            &:hover {
                width: auto;
                .text{width: 100%;}
            }
        }

        &:hover{
            .svgIcon{
                fill: $colorSubs;
            }
            color: $colorSubs;
        }
    }
</style>
