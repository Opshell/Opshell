<template>
    <div class="gridBlock" role="table">
        <template v-for="item in list">
            <div class="gridBox" v-for="(val, key) in item" :key="val" :class="key">
                <span class="key">{{ key }}</span>
                <span class="value">{{ val }}</span>
            </div>
        </template>
    </div>
</template>

<script>
    export default {
        name: "elGridTable",
        props: {
            value: {},
        },
        data: function () {
            return {
                list: {},
            };
        },
        mounted() {
            this.list = JSON.parse(JSON.stringify(this.value));
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
    .gridBlock {
        .gridBox {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    }

    .gridBox {
        .title {
        }
        .value {
        }
    }
</style>
