<template>
    <section v-if="info" class="gridList" role="table">
        <header class="header">
            <elSvgIcon :name="header.icon" />
            <h2 class="title">
                <elFormGroup title="功能名稱">
                    <elInput v-model="header.title" />
                </elFormGroup>
            </h2>
        </header>

        <div class="groupBlock">
            <elFormGroup v-for="(item, i) in info" :title="item.title" :key="'group_' + i">
                <elInput v-model="item.value" :type="item.type" />
            </elFormGroup>
        </div>
    </section>
</template>

<script>
    import { getData } from '../hook/getData.js';
    import elSvgIcon from '../components/el-svgIcon.vue';
    import elFormGroup from '../components/el-formGroup.vue';
    import elInput from './el-input.vue';

    export default {
        name: 'elDetail',
        props: {
            url: {
                type: String,
                default: '',
            },
            demand: {
                // 要顯示的欄位 (裡面是物件 欄位名 欄位類型 預設值)
                type: Array,
                default: () => [],
            },
            value: {},
        },
        data: function () {
            return {
                header: {
                    title: 123,
                },
                info: [],
            };
        },
        components: { elSvgIcon, elFormGroup, elInput },
        mounted() {
            this.info = this.deepCopy(this.demand);
            let data = {};

            const token = localStorage.getItem('token');
            getData(this.url, 'GET', {}, { Authorization: `Bearer ${token}` }).then((result) => {
                if (result.status) {
                    data = result.data;

                    if (!this.isObjEmpty(data)) {
                        this.header.title = data.title;
                        this.header.icon = data.icon;
                        this.header.img = data.img;

                        for (const key in this.info) {
                            if (this.objHOP(this.info, key)) {
                                const ele = this.info[key];

                                // 設定資料庫撈出來的值到info
                                this.info[key].value = data[ele.field]
                                    ? data[ele.field]
                                    : this.info[key].default;
                            }
                        }
                    }
                }

                this.$store.commit('endLoading');
            });
        },
        watch: {},
    };
</script>

<style scoped lang="scss">
    .header {
        display: flex;
        align-items: flex-end;
        justify-content: flex-start;
        .groupBox {
            width: calc(100% - 150px);
        }
        .icon {
            @include setSize(100px, 100px);
            padding: 5px;
            border: 5px solid #333;
            border-radius: 3px;
            margin: -20px 5px 5px;
        }
        .title {
            flex: 1;
        }
    }

    .groupBlock {
        display: flex;
        flex-wrap: wrap;
        width: 100%;
    }
</style>
