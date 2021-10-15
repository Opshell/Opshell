<template>
    <div class="Btn" role="button" :title="title">
        <elSvgIcon v-if="icon != ''" class="svgIcon" :name="icon"/>
        <span v-if="text != ''" class="text">{{ text }}</span>
    </div>
</template>

<script>
    import elSvgIcon from "@/components/el-svgIcon.vue";

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
        padding: 10px; 
        color: #fff;
        cursor: pointer;
        .svgIcon{
            fill: currentColor;
            @include setSize(100%, 100%);
            @extend %pm0;
            min-width: 12px;
            min-height: 12px;
            overflow: hidden;
            transition: .3s ease-in-out;
            + .text{
                margin: 0 0 0 15px; 
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
