<template>
    <div class="NewsInfo">
        <h1>Here show the news{{ newsId }}'s information .</h1>
    </div>
</template>

<script>
    import { mapState } from "vuex";

    export default {
        data() {
            return {
                
            };
        },
        components: {
 
        },
        methods: {

        },
        computed: {
            ...mapState([// 批量載入vuex state
                'userData',
                'pageData',
            ]),
            newsId(){
                return this.$route.params.newsId;
            },
        }
    };
</script>

<style scoped lang="scss">
  
</style>
