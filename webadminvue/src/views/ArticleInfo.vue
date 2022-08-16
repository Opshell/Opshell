<template>
    <div class="News">
        <h1>Here show the news list.</h1>

        <elTable :value="list"></elTable>
    </div>
</template>

<script>
    import { mapState } from "vuex";
    import { getData } from "../composition/getData.js"

    import elTable from "../components/el-gridTable.vue";

    export default {
        data() {
            return {
                list: {},
                number: [1, 2, 3]
            };
        },
        components: {
            elTable,
        },
        mounted() {
            getData("/api/news/list").then((result) => {
                console.log(result);
            });
            // fetch("/api/news/list") // /mapi/news/list/2
            //     .then((res) => res.json())
            //     .then((data) => {
            //         if (data.status == "Success") {
            //             console.log(data.data);
            //             this.list = data.data;
            //             console.log(this.list);

            //         }
            //     });
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
