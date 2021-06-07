<template>
    <div class="Dashboard">
        <h1>Welcome back {{ userData.name }}</h1>
    </div>
</template>

<script>
    import { mapState } from "vuex";

    export default {
        data() {
            return { };
        },
        components: { },
        mounted(){
            fetch('/mapi')
                .then(res => res.json())
                .then(data => console.log(data));
        },
        methods: { },
        computed: mapState([// 批量載入vuex state
            "userData",
        ]),
    };
</script>

<style scoped lang="scss">
  
</style>
