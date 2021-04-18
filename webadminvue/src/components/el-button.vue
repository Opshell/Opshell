<template>
    <a class="Btn" href=""></a>
</template>

<script>
export default {
    name: "elBtn",
    props: {
        type: {
            defualt: "text",
        },
        name: {},
        value: {},
        placeholder: {},
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
    
</style>
