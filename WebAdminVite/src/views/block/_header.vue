<template>
    <header class="headerBlock">
        <h1 class="breadcrumbs">
            <!-- <transition-group name="verbatim"> -->
            <template v-for="(item, i) in breadcrumbs" :key="i">
                <router-link v-if="item.href" class="breadcrumb" :to="item.href">
                    <elSvgIcon v-if="i!=0" name="angle-small-right" />{{ item.title }}
                </router-link>
                <span v-else class="breadcrumb">
                    <elSvgIcon v-if="i!=0" name="angle-small-right" />{{ item.title }}
                </span>
            </template>
            <!-- </transition-group> -->

            <!-- <transition-group name="verbatim">
                <span v-for="(item, i) in pageData.title" v-bind:key="i">
                    {{ item }}
                </span>
            </transition-group> -->
        </h1>

        <div class="searchBar">
            <elInput placeholder="搜尋列" />
            <elSvgIcon name="search" />
        </div>

        <div class="CRUDBox">
            <elBtn text="儲存" title="儲存" icon="disk" />
            <elBtn text="回上頁" title="回上頁" icon="undo" />
            <elBtn text="刪除" title="刪除" icon="trash" />
        </div>
    </header>
</template>

<script>
    import { mapState } from "vuex";
    import elInput from "@/components/el-input.vue";
    import elSvgIcon from "@/components/el-svgIcon.vue";
    import elBtn from "@/components/el-button.vue";

    // @ is an alias to /src
    export default {
        name: "Header",
        components: { elInput, elSvgIcon, elBtn },
        data: function () {
            return {};
        },
        mounted: function () {},
        method: {},
        computed: {
            ...mapState([
                "user",
                "isLoading",
                "route",
                "redirect",
                "pageData",
            ]),
            breadcrumbs: function () {
                let breadcrumbs = this.route.to.fullPath.split("/");
                breadcrumbs[0] = {
                    title: '總覽',
                    href: "/dashboard"
                };
                breadcrumbs[1] = {
                    title: this.route.to.meta.title,
                    href: this.route.to.path
                };
                if (breadcrumbs[2]) {
                    breadcrumbs[2] = { title: 'ID：' + breadcrumbs[2], };
                }

                return breadcrumbs;
            }
    },

    };
</script>

<style lang="scss">
    .headerBlock {
        position: relative;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: $colorBack;
        width: 100%;
        padding: 25px;
        box-sizing: border-box;
        .breadcrumbs {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            background: $colorBack2;
            padding: 5px 15px;
            @include setSize(100%, 50px);
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 20px;
            font-family: "Noto Sans CJK TC";
            font-weight: normal;
            color: #fff;
            line-height: 0.8;
            .breadcrumb {
                display: flex;
                align-items: center;
            }
            .icon {
                @include setSize(40px, 40px);
            }
        }
        .searchBar {
            display: flex;
            margin: 0 10px;
            .icon {
                @include setSize(40px, 40px);
                margin: 0 0 0 5px;
            }
        }
        .CRUDBox {
            display: flex;
            background: #333;
            padding: 8px 5px 8px 15px;
            border-radius: 10px;
            transform: translate3d(25px, 0, 0);
            z-index: 1;
        }
    }
</style>
