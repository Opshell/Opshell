<template>
    <svg class="svgIcon">
        <use :xlink:href="`#${name}`" />
    </svg>
</template>

<script>
    export default {
        name: "el-svgIcon",
        props: {
            name: {
                type: String,
                required: true,
                default: "email",
            },
        },
    };
</script>

<style scoped lang="scss">
    .svgIcon {
        @include setSize(100%, 100%);
        fill: currentColor !important;
        overflow: hidden;
    }
</style>
