<template>
    <a class="Btn" role="button" :title="title"></a>
</template>

<script>
export default {
    name: "elBtn",
    props: {
        title:{
            type: String,
            default: "",
        }
    },
    data: function () {
        return {};
    },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
    
</style>
