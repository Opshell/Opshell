<template>
    <template v-for="(item, i) in list" :key="i">
        <div class="linkBlock"
            v-if="item.child"
            :class="{ box: item.child.length > 0, open: !item.hide_sub, fitBar: depth==0}"
        >
            <div class="link"
                :style="{ 'padding-left': depth * 1.5 + 'em' }"
                @click="openChild(i)"
            >
                <elSvgIcon class="icon" name="folder" />
                <span class="text">{{ item.title }}</span>
                <elSvgIcon v-if="item.hide_sub" class="icon" name="square-plus" />
                <elSvgIcon v-else class="icon" name="square-minus" />
            </div>
            <div class="linkBox" :style="{ 'height': boxHeight + 'px'}">
                <elTreeItem
                    :menu="item.child"
                    :depth="depth+1"
                    :hide_sub="(item.hide_sub)? true : false"
                    :child_count="item.child.length || 0"
                    @calc-height="calcHeight"
                />
            </div>
        </div>
        <router-link
            v-else class="link"
            :class="{ fitBar: depth == 0 }"
            :to="item.link"
            :key="'i_' + item.id"
            :depth="depth"
            :style="{ 'padding-left': depth * 1.5 + 'em' }"
        >
            <elSvgIcon class="icon" :name="item.icon" />
            <span class="text">{{ item.title }}</span>
        </router-link>
    </template>
</template>

<script>
import { ref, reactive, onMounted, onUpdated, watch } from "vue";
    import elSvgIcon from "../components/el-svgIcon.vue";

    export default {
        name: "elTreeItem",
        components: { elSvgIcon },
        emits: [ "calcHeight" ],
        props: {
            menu: {
                type:  Object,
                default: () => { }
            },
            depth: { // 計算後推用
                type: Number,
                default: 0
            },
            hide_sub: { // 是否收闔
                type: Boolean,
                default: true
            },
            child_count: { // 子層數量
                type: Number,
                default: 0
            }
        },
        setup(props, { emit }) {
            const list = reactive(props.menu);
            // const hideSub = ref(props.hide_sub);
            const boxHeight = ref(0);
            const optionHeight = 40;

            console.log(list);
            onMounted(() => {
                console.log(list);
            });
            onUpdated(() => {
                console.log(list);
            });

            // --- methods ---
            // 開啟子層
            const openChild = (i) => {
                list[i].hide_sub = !list[i].hide_sub; // hide_sub == 1 的時候，是收闔的
            };
            /** 回拋Height
             * @param {*} boxh  // 盒子高度
             */
            const calcHeight = (boxh) => {
                boxHeight.value = Number(boxHeight.value) + Number(boxh);
                if (props.depth != 0) {
                    emit("calcHeight", boxh);
                }
            };
            /** 遞迴關閉下層選單
             * @param {list} Array // 要檢查的Array
             */
            const rcsCloseChild = (list) => {
                list.forEach((el) => {
                    if (el.child != undefined) {
                        el.hide_sub = true;
                        rcsCloseChild(el.child);
                    }
                });
            }

            // 上層關閉時，觸發遞進關閉下層
            watch(props.hide_sub, (val) => {

                console.log(val);
                console.log(val);
                if (val) { rcsCloseChild(list); }
                emit("calcHeight", (!val) ? props.child_count * optionHeight : props.child_count * optionHeight);
            }, { deep: true });

            return {
                list,
                boxHeight,
                openChild,
                calcHeight,
            }
        }
    }
</script>

<style scoped lang="scss">
    .linkBlock{
        .linkBox{
            background: rgba(0, 0, 0, 0.2);
            height: 0;
            box-shadow: 0 2px 15px 0 rgba(0, 0, 0, 0.3) inset;
            cursor: pointer;

            overflow: hidden;
            transition: .15s $cubic-FiSo;
        }
    }

    .link {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;

        background: rgba(0, 0, 0, 0.2);
        @include setSize(100%, 40px);
        padding: 5px 2px;
        border-top: 1px solid #333;
        border-bottom: 1px solid #666;
        box-sizing: border-box;

        color: #eee;
        transition: background-color .5s $cubic-FiSo .2s;
        cursor: pointer;
        overflow: hidden;
        .icon {
            @include setSize(1.5em, 1.5em);
            margin: 0 8px;
            fill: #eee;
        }
        .text{
            flex: 1;
            text-align: left;
        }

        // &::before {
        //     content: "";
        //     position: absolute;
        //     top: 50%;
        //     left: 0;
        //     background: linear-gradient(to right, #2c3e50 0%, #334e69 100%);
        //     @include setSize(30px, 30px);
        //     border-radius: 50%;
        //     opacity: 0;
        //     transform: translate3d(-100%, -50%, 0);
        //     transition: 0.15s $cubic-FiSo;
        // }

        &:hover {
            color: #42b983;
            .icon{
                fill: #42b983;
            }
            // &::before {}
        }

        &:active {
            background-color: #2c474e;
            transition: background-color .15s $cubic-FiSo;
        }

        &.router-link-exact-active {
            color: $colorSubs;
            .icon{
                fill: $colorSubs;
            }
            // &::before {}
        }
    }
</style>