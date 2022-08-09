<template>
    <svg class="icon">
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
    .icon{
        display: flex;
        align-items: center;
        justify-content: center;
        @include setSize(100%, 100%);
    }
</style>
