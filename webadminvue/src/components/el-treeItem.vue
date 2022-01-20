<template>
    <template v-for="(item, i) in list" :key="i">
        <div class="linkBlock"
            v-if="item.child"
            :class="{ box: item.child.length > 0, open: !item.hide_sub }"
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
                    :child_count="item.child.length"
                    @calc-height="calcHeight"
                />
            </div>
        </div>
        <router-link
            v-else class="link"
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
    import elSvgIcon from "../components/el-svgIcon.vue";

    export default {
        name: "elTreeItem",
        components: { elSvgIcon },
        emits: [ "calcHeight" ],
        props: {
            menu: {}, //
            depth: { // 計算後推用
                type: Number,
                default: 0
            },
            hide_sub:{ // 是否收闔
                type: Boolean,
                default: true
            },
            child_count:{ // 子層數量
                type: Number,
                default: 0
            }
        },
        data: function () {
            return {
                list: {},
                optionHeight: 40,
                boxHeight: 0,
            };
        },
        mounted() {
            this.list = this.menu;
        },
        methods: {
            openChild: function (i) {
                this.list[i].hide_sub = !this.list[i].hide_sub; // hide_sub == 1 的時候，是收闔的
            },
            calcHeight: function (boxh) {
                this.boxHeight += boxh;
                if(this.depth != 0){
                    this.$emit("calcHeight", boxh);
                }
            },
            /** 遞迴關閉下層選單
             * @param {list} Array // 要檢查的Array
             */
            rcsCloseChild: function (list) {
                let ths = this;
                list.forEach(function(el){
                    if(el.child != undefined){
                        el.hide_sub = true;
                        ths.rcsCloseChild(el.child);
                    }
                });
            }
        },
        computed: {
            // bh() {
            //     return `height: ${(!this.hide_sub)? this.child_count * 40 : 0}px`;
            // }
        },
        watch: {
            menu: {
                handler: function (v) {
                    this.list = v;
                },
                deep: true,
            },
            hide_sub: {
                handler: function (v) {
                    if(v){ this.rcsCloseChild(this.list); }
                    this.$emit("calcHeight", (!v)? this.child_count * this.optionHeight : -this.child_count * this.optionHeight);
                },
                deep: true,
            }
        },
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
        &.router-link-exact-active {
            color: $colorSubs;
            .icon{
                fill: $colorSubs;
            }
            // &::before {}
        }
    }
</style>