<template>
    <figure v-if="figure">
        <img :src="src"
            :alt="alt">
        <figcaption>{{text}}</figcaption>
    </figure>
    <img v-else :src="src" :alt="alt">
</template>

<script>
export default {
    name: "elImg",
    props: {
        figure:{
            type: Boolean,
            default: false,
        },
        src: {
            type: String,
            default: "",
        },
        alt: {
            type: String,
            default: "",
        },
        text: {
            type: String,
            default: "",
        }
    },
    data: function () {
        return {
            rawValue: "",
        };
    },
    mounted: function () {
        let vm = this;
        vm.rawValue = vm.value;
    }
};
</script>

<style scoped lang="scss">
    
</style>
