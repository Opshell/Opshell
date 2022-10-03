<template>
    <template v-for="(item, i) in list" :key="'bar_'+i">
        <div class="gridBar">
            <div class="td check"><elInput type="checkbox" /></div>
            <div class="td parent">{{item.depath_id}}</div>
            <div class="td id">{{item.id}}</div>
            <div class="td icon">
                <elSvgIcon :name="item.icon"></elSvgIcon>
            </div>
            <div class="td title"> {{item.title}} </div>
            <div class="td link"> {{item.link}} </div>
            <div class="td crud">
                <elBtn class="tipsBtn"
                    :href="'/sectionInfo/' + item.id"
                    icon="edit" text="編輯"
                />
                <elBtn class="tipsBtn"
                    icon="trash" text="刪除"
                    @click="delectSection(item.id)"
                />
            </div>
        </div>

        <elSectionBar v-if="item.child" :menu="item.child" :depth="depth + 1" />
    </template>
</template>

<script>
import { ref, watch } from "vue";
import elSvgIcon from "../components/el-svgIcon.vue";
import elInput from "./el-input.vue";
import elBtn from "./el-btn.vue";

export default {
    name: "elSectionBar",
    components: { elSvgIcon, elInput, elBtn },
    props: {
        menu: {},
        depth: { // 計算後推用
            type: Number,
            default: 0
        },
    },
    setup(props) {
        const list = ref(props.menu);

        for (const key in list.value) {
            if (Object.hasOwnProperty.call(list.value, key)) {
                const ele = list.value[key];

                let depath = '';
                for (let i = 0; i < props.depth; i++) {
                    depath += '=';
                }
                if (props.depth > 0) { depath += '>'; }

                list.value[key].parent_id = ele.parent_id.toString();
                list.value[key].depath_id = ele.parent_id + ' ' + depath;
            }
        }

        const delectSection = (id) => {
            console.log(id);
        };

        watch(() => props.menu, (val) => {
            list.value = val;
        }, {deep: true});

        return {
            list,
            delectSection
        }
    },
}
</script>

<style scoped lang="scss"></style>