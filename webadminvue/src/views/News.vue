<template>
    <div class="News">
        <h1>Here show the news list.</h1>
        <elTable :value="list"></elTable>
    </div>
</template>

<script>
    import { mapState } from "vuex";
    import elTable from "../components/el-gridTable.vue";

    export default {
        data() {
            return {
                list: {},
            };
        },
        components: {
            elTable,
        },
        mounted() {
            fetch("/api/news/list") // /mapi/news/list/2
                .then((res) => res.json())
                .then((data) => {
                    if (data.status == "Success") {
                        this.list = data.data;
                    }
                });
        },
        methods: {},
        computed: {
            ...mapState([
                // 批量載入vuex state
                "userData",
                "pageData",
            ]),
        },
    };
</script>

<style scoped lang="scss"></style>
