<template>
    <div class="Dashboard">
        <h1>Welcome back {{ userData.name }}</h1>
    </div>
</template>

<script>
    import { mapState } from "vuex";

    export default {
        data() {
            return {};
        },
        components: {},
        mounted() {
            this.$store.commit("endLoading");
            // const token = localStorage.getItem("token");
            // this.axios({
            //     url: "/api/dashboard/info",
            //     method: "GET",
            //     headers: { "Authorization": `Bearer ${token}` }
            // }).then(res => console.log(res));
        },
        methods: {},
        computed: mapState([
            // 批量載入vuex state
            "userData",
        ]),
    };
</script>

<style scoped lang="scss"></style>
