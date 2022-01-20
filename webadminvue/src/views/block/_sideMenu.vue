<template>
    <nav class="sideMenu">
        <elTreeItem :menu="list" :child_count="list.length" />
    </nav>
</template>

<script>
    import { mapState } from "vuex";

    import elTreeItem from "@/components/el-treeItem";

    export default {
        name: "sideMenu",
        components: {elTreeItem},
        data: function () {
            return {
                list: {},
            };
        },
        mounted: function () {
            const token = localStorage.getItem("token");
            this.axios({
                url: "/api/backEnd/sidemenu",
                method: "GET",
                data: {},
                headers: { Authorization: `Bearer ${token}` },
            })
                .then((result) => {
                    if (result.status == 200) {
                        this.list = result.data.data;
                    } else {
                        return {
                            status: false,
                            msg: result.data.message,
                            data: result.data.data,
                        };
                    }
                })
                .catch(() => {
                    return false;
                });
        },
        computed: mapState(["isLogin", "isLoading", "userData"]),
        // <transition-group v-if="isLogin" name="verbatim" tag="nav" class="sideMenu"></transition-group>
    };
</script>

<style lang="scss">
    .sideMenu {
        display: flex;
        flex-direction: column;
        background: $colorBack2;
        @include setSize(100%, 100%);
        padding: 0;
        box-sizing: border-box;
    }
</style>
