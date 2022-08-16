<template>
    <div class="NewsInfo">
        <h1>Here show the section's information by id = {{id}}.</h1>
    </div>
</template>

<script>
    import { mapState } from "vuex";

    export default {
        data() {
            return {};
        },
        components: {},
        mounted: function () {
            console.log(this);
            this.$store.commit("endLoading");
        },
        methods: {},
        computed: {
            ...mapState([
                // 批量載入vuex state
                "userData",
                "pageData",
            ]),
            id: function() {
                return this.$route.params.id;
            },
        },
    };
</script>

<style scoped lang="scss"></style>
