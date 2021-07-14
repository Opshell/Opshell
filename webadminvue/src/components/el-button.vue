<template>
    <div class="Btn" role="button" :title="title">
        <svg v-if="icon != ''" class="sprite"> 
            <use :xlink:href="'/sprite.svg#' + icon"/> 
        </svg>
        <span v-if="text != ''" class="text">{{ text }}</span>
    </div>
</template>

<script>
    export default {
        name: "elBtn",
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
        .sprite{
            vertical-align: top;
            fill: #fff;
            @include setSize(100%, 100%);
            @extend %pm0;
            min-width: 12px;
            min-height: 12px;
            transition: .3s ease-in-out;
            + .text{
                margin: 0 0 0 15px; 
            }
        }

        &:hover{
            .sprite{
                fill: $colorSubs;
            }
            color: $colorSubs;
        }
    }
</style>
