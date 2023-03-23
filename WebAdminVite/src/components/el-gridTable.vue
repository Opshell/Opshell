<template>
    <section class="gridList" role="table">
        <header class="gridBlock">
            <div v-for="(title, i) in header" class="gridBox" :key="title + '_' + i">
                {{ title }}
            </div>
        </header>

        <div v-for="(item, i) in list" class="gridBlock" :key="'item_' + i">
            <div class="gridBox" v-for="(val, key) in item" :key="val" :class="key">
                <!-- <span class="key">{{ key }}</span> -->
                <span class="value">{{ val }}</span>
            </div>
        </div>
    </section>
</template>

<script lang="ts">
    export default {
        name: 'elGridTable',
        props: {
            value: {},
        },
        data: function () {
            return {
                header: [],
                list: {},
            };
        },
        mounted() {
            this.list = JSON.parse(JSON.stringify(this.value));

            // if (this.header.length == 0) {
            for (const title in this.list[0]) {
                this.header.push(title); // title 生成
            }
            // }
        },
        watch: {
            value: {
                handler: function (v) {
                    this.list = JSON.parse(JSON.stringify(v));
                },
                deep: true,
            },
        },
    };
</script>

<style scoped lang="scss">
    .gridList {
        display: flex;
        flex-direction: column;
        @include setSize(100%, 100%);
        border: 1px solid #3a7878;
        .gridBlock {
            display: flex;
            align-items: stretch;
            justify-content: center;
            width: 100%;
            border-bottom: 1px solid #3a7878;
        }
        .gridBox {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px 8px;
            border-right: 1px solid #3a7878;
        }
    }
</style>
