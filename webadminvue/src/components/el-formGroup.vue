<template>
    <div class="groupBox" role="button" :title="title">
        <h6 class="title">{{title}}：</h6>
        <slot></slot>
    </div>
</template>

<script>
    export default {
        name: "elFormGroup",
        components: {},
        props: {
            title: {
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
    .groupBox {
        display: flex;
        background: #333;
        @include setSize(calc(25% - 5px), 45px);
        padding: 6px 10px;
        border-radius: 3px;
        box-sizing: border-box;
        margin: 0 2.5px 5px;
        .title {
            display: flex;
            align-items: center;
            border-right: 2px solid #1B1B1B;
            color: #bbb;
            font-size: 22px;
            white-space: nowrap;
        }

        @include setRWD(1200px){
            width: calc(50% - 5px);
        }
        @include setRWD(500px){
            width: calc(100% - 5px);
        }
    }
</style>
