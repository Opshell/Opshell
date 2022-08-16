<template>
    <article class="gridBlock">

        <header class="gridBar">
            <div class="td check"><elInput type="checkbox" @click="selectAll()" /></div>
            <div class="td parent">父層ID</div>
            <div class="td id">ID</div>
            <div class="td icon">圖示</div>
            <div class="td title">名稱</div>
            <div class="td link">連結</div>
            <div class="td crud">操作</div>
        </header>

        <elSectionBar :menu="list" />
    </article>
</template>

<script>
    import { mapState } from "vuex";
    import { getData } from "@/composition/getData.js"

    import elSectionBar from "@/components/el-sectionBar.vue";
    import elInput from "@/components/el-input.vue";
    import store from "../store";
    // import elTable from "../components/el-gridTable.vue";

    export default {
        data() {
            return {
                header: [],
                list: {},
                number: [1, 2, 3]
            };
        },
        components: { elSectionBar, elInput },
        mounted: function () {
            const token = localStorage.getItem("token");
            getData(
                "/api/section/list",
                "GET", {},
                { Authorization: `Bearer ${token}` },
            ).then((result) => {
                store.commit('setLoading');
                if (result.status) {
                    this.list = result.data.data;
                }
            });
        },
        computed: {
            ...mapState([
                // 批量載入vuex state
                "isLoading",
                "userData",
                "pageData",
            ]),
        },
        methods: {
            selectAll: function () {

            }
        }
    };
</script>

<style lang="scss">
    .gridBlock {
        display: flex;
        flex-direction: column;
        @include setSize(100%, 100%);
    }

    .gridBar {
        display: grid;
        grid-gap: 2px 2px; // 水平 垂直
        grid-template-areas: "check parent id icon title link crud";
        grid-template-columns: 40px 100px 60px 65px 1fr 1fr 120px;
        width: 100%;
        border-bottom: 2px solid #1b1b1b;
        // align-items: center;
        // justify-items: start;
        .td {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            background: #333;
            height: 50px;
            padding: 6px 10px;
            box-sizing: border-box;
            font-size: 18px;
            color: #bbb;
            fill: #bbb;
            transition: .15s $cubic-FiSo;
        }
        .check {
            grid-area: check;
            align-items: center;
            justify-content: center;
        }
        .parent {grid-area: parent;}
        .id{
            grid-area: id;
            align-items: center;
            justify-content: center;
        }
        .icon {
            grid-area: icon;
            align-items: center;
            justify-content: center;
        }
        .title {grid-area: title;}
        .link {grid-area: link;}
        .crud { grid-area: crud; }

        &:hover .td {
            background: $colorMain;
            height: 50px;
            padding: 5px 10px;
            font-size: 20px;
            color: #bbb;
            fill: #bbb;
        }

        animation: fit-in 0.5s $cubic-FiSo both;
        @include setDelay('animation-delay', 15, 0.045);
    }
</style>
