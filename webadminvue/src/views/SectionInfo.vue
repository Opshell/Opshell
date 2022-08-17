<template>
    <div class="NewsInfo">
        <h1>Here show the section's information.</h1>

        <elDetail :url="url" :demand="demand"/>
    </div>
</template>

<script>
    import { mapState } from "vuex";
    import elDetail from "../components/el-detail.vue";

    export default {
        data() {
            return {
                demand: []
            };
        },
        components: { elDetail },
        mounted: function () {
            const demand = [
                {
                    title: '上層ID',
                    feild: 'parent_id',
                    type: 'text',
                    default: 0
                }, {
                    title: '資料表名稱',
                    feild: 'table_name',
                    type: 'text',
                    default: ''
                }, {
                    title: '檢查欄位名稱',
                    feild: 'field_name',
                    type: 'text',
                    default: ''
                }, {
                    title: '檢查欄位值',
                    feild: 'field_value',
                    type: 'text',
                    default: ''
                }, {
                    title: '檢視需要等級',
                    feild: 'auth_view',
                    type: 'text',
                    default: 0
                }, {
                    title: '操作需要等級',
                    feild: 'auth_crud',
                    type: 'text',
                    default: 0
                }, {
                    title: '資料夾預設關閉',
                    feild: 'hide_sub',
                    type: 'text',
                    default: 1
                }, {
                    title: '節點連結',
                    feild: 'link',
                    type: 'text',
                    default: ''
                }, {
                    title: '排序',
                    feild: 'sort',
                    type: 'text',
                    default: 1000
                }, {
                    title: '節點狀態',
                    feild: 'status',
                    type: 'radio',
                    default: 1
                }
            ];

            this.demand = demand;
        },
        methods: {},
        computed: {
            ...mapState([
                // 批量載入vuex state
                "userData",
                "pageData",
            ]),
            url: function() {
                return `/api/section/info/${ this.$route.params.id }`;
            },
        },
    };
</script>
<style scoped lang="scss"></style>
