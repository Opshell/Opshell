<template>
    <div class="NewsInfo">
        <h1>Here show the section's information.</h1>

        <!-- <elDetail :url="url" :demand="demand" /> -->
    </div>
</template>

<script lang="ts">
    import { mapState } from 'vuex';
    import elDetail from '../components/el-detail.vue';

    export default {
        data() {
            return {
                demand: [
                    {
                        title: '上層ID',
                        field: 'parent_id',
                        type: 'text',
                        default: 0,
                    },
                    {
                        title: '資料表名稱',
                        field: 'table_name',
                        type: 'text',
                        default: '',
                    },
                    {
                        title: '檢查欄位名稱',
                        field: 'field_name',
                        type: 'text',
                        default: '',
                    },
                    {
                        title: '檢查欄位值',
                        field: 'field_value',
                        type: 'text',
                        default: '',
                    },
                    {
                        title: '檢視需要等級',
                        field: 'auth_view',
                        type: 'text',
                        default: 0,
                    },
                    {
                        title: '操作需要等級',
                        field: 'auth_crud',
                        type: 'text',
                        default: 0,
                    },
                    {
                        title: '資料夾預設關閉',
                        field: 'hide_sub',
                        type: 'text',
                        default: 1,
                    },
                    {
                        title: '節點連結',
                        field: 'link',
                        type: 'text',
                        default: '',
                    },
                    {
                        title: '排序',
                        field: 'sort',
                        type: 'text',
                        default: 1000,
                    },
                    {
                        title: '節點狀態',
                        field: 'status',
                        type: 'radio',
                        default: 1,
                    },
                ],
            };
        },
        components: { elDetail },
        methods: {},
        computed: {
            ...mapState([
                // 批量載入vuex state
                'userData',
                'pageData',
            ]),
            url: function () {
                return `/api/section/info/${this.$route.params.id}`;
            },
        },
    };
</script>
<style scoped lang="scss"></style>
