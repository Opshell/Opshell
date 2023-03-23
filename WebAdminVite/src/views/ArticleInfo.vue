<template>
    <div class="NewsInfo">
        <h1>Here show the news{{ newsId }}'s information .</h1>
    </div>
</template>

<script lang="ts">
    import { mapState } from 'vuex';
    import { getData } from '../hook/getData.js';

    import elTable from '../components/el-gridTable.vue';

    export default {
        data() {
            return {
                list: {},
                number: [1, 2, 3],
            };
        },
        components: {
            elTable,
        },
        mounted() {
            getData('/api/news/list').then((result) => {
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
                'userData',
                'pageData',
            ]),
            newsId() {
                return this.$route.params.newsId;
            },
        },
    };
</script>

<style scoped lang="scss"></style>
