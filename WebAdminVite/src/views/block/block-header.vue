<template>
    <header class="headerBlock">
        <h1 class="breadcrumbs">
            <!-- <transition-group name="verbatim"> -->
            <template v-for="(item, i) in breadcrumbs" :key="i">
                <router-link v-if="item.href" class="breadcrumb" :to="item.href"> <elSvgIcon v-if="i != 0" name="angle-small-right" />{{ item.title }} </router-link>
                <span v-else class="breadcrumb"> <ElSvgIcon v-if="i != 0" name="angle-small-right" />{{ item.title }} </span>
            </template>
            <!-- </transition-group> -->

            <!-- <transition-group name="verbatim">
                <span v-for="(item, i) in pageData.title" v-bind:key="i">
                    {{ item }}
                </span>
            </transition-group> -->
        </h1>

        <div class="searchBar">
            <ElInput placeholder="搜尋列" />
            <ElSvgIcon name="search" />
        </div>

        <div class="CRUDBox">
            <ElBtn text="儲存" title="儲存" icon="disk" />
            <ElBtn text="回上頁" title="回上頁" icon="undo" />
            <ElBtn text="刪除" title="刪除" icon="trash" />
        </div>
    </header>
</template>

<script setup lang="ts">
    import { useStore } from '@/store';

    const store = useStore();

    interface iBreadcrumb {
        title: string;
        href?: string;
    }

    const setBreadcrumbs = () => {
        console.log(store.state);
        let fullPath = store.state.route.to.fullPath.split('/');

        let breadcrumbs: iBreadcrumb[] = [];

        breadcrumbs.push({
            title: '總覽',
            href: '/dashboard',
        });
        breadcrumbs.push({
            title: store.state.route.to.meta.title,
            href: store.state.route.to.path,
        });
        if (fullPath[2]) {
            breadcrumbs.push({ title: 'ID：' + fullPath[2] });
        }

        return breadcrumbs;
    };

    let breadcrumbs: iBreadcrumb[] = setBreadcrumbs();
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
            font-family: 'Noto Sans CJK TC';
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
