<template>
    <div class="">
        <h1 class="text">404 | Page Not Found.</h1>
    </div>
</template>

<script>
    import { mapState } from "vuex";

    export default {
        data() {
            return {};
        },
        components: {},
        methods: {},
        computed: {
            ...mapState([
                // 批量載入vuex state
                "userData",
                "pageData",
            ]),
            newsId() {
                return this.$route.params.newsId;
            },
        },
    };
</script>

<style scoped lang="scss">
    .text {
        color: #eee;
        font-size: 36px;
    }
</style>
