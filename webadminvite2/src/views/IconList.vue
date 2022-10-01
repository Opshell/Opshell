<template>
    <div class="iconBlock">
        <div v-for="(item, i) in iconList" class="iconBox" :key="i">
            <div class="box" :title="item">
                <elSvgIcon :name="item" />
            </div>
            <!-- <div class="name">{{item}}</div> -->
        </div>
    </div>
</template>

<script setup lang="ts">
    import { useStore } from '@/store';

    const store = useStore();
    const iconList: Ref<string[]> = ref([]);

    onMounted(() => {
        iconList.value = [];

        const spriteSvg = document.getElementById('__svg__icons__dom__');
        if (spriteSvg != null) {
            let svgList = [...spriteSvg.children];

            svgList.forEach((svgDom) => {
                iconList.value.push(svgDom.id);
            });
        }
    });

    store.commit('route/endLoading');
</script>

<style scoped lang="scss">
    .iconBlock {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: flex-start;
        width: 100%;
        .iconBox {
            display: flex;
            flex-direction: column;
            background: #666;
            width: calc(10% - 10px);
            border-radius: 5px;
            margin: 5px;
            cursor: pointer;
            transition: .3s $cubic-FiSo;
            .box{
                position: relative;
                display: flex;
                flex-direction: column;
                width: 100%;
                @include setProportion();
            }
            .icon {
                position: absolute;
                @include setSize(100%, 100%);
                padding: 12px;
                box-sizing: border-box;
            }
            .name {
                width: 100%;
                padding: 8px;
                box-sizing: border-box;
                word-break: break-all;
            }

            &:hover { fill: #ccc; }
        }
    }
</style>
