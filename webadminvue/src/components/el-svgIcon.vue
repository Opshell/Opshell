<template>
    <svg>
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

<style scoped lang="scss"></style>
