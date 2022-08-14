<template>
    <template v-for="(item, i) in list" :key="'bar_'+i">
        <div class="gridBar">
            <div class="td check"><input type="checkbox" name="" id=""></div>
            <div class="td parent">{{item.parent_id}}</div>
            <div class="td id">{{item.id}}</div>
            <div class="td icon">
                <elSvgIcon :name="item.icon"></elSvgIcon>
            </div>
            <div class="td title"> {{item.title}} </div>
            <div class="td link"> {{item.link}} </div>
            <div class="td crud">
                <elSvgIcon :href="'/section/info/' + item.id" class="tipsBtn" name="edit" text=""></elSvgIcon>
                <elSvgIcon class="tipsBtn" name="trash" @click="delectSection"></elSvgIcon>
            </div>
        </div>

        <elSectionBar v-if="item.child" :menu="item.child" :depth="depth + 1" />
    </template>
</template>

<script>
// import { obj } from "../assets/js/opshellLibary";
import elSvgIcon from "../components/el-svgIcon.vue";

export default {
    name: "elSectionBar",
    components: { elSvgIcon },
    emits: [ "calcHeight" ] ,
    props: {
        menu: {}, //
        depth: { // 計算後推用
            type: Number,
            default: 0
        },
    },
    data: function () {
        return {
            list: {},
        };
    },
    mounted() {
        this.list = this.deepCopy(this.menu);
        for (const key in this.list) {
            if (this.objHOP(this.list, key)) {
                const ele = this.list[key];

                let depath = '';
                for (let i = 0; i < this.depth; i++) {
                    depath += '=';
                }
                if (this.depth > 0) { depath += '>'; }

                this.list[key].parent_id = ele.parent_id + ' ' + depath;
            }
        }
    },
    methods: {},
    computed: {},
    watch: {
        menu: {
            handler: function (v) {
                this.list = v;
            },
            deep: true,
        },
    },
}
</script>

<style scoped lang="scss"></style>