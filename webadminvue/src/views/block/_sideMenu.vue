<template>
    <transition-group v-if="isLogin" name="verbatim" tag="nav" class="sideMenu">
        <!-- <router-link class="link" to="/">Vue Info</router-link>
        <router-link class="link" to="/dashboard">Dashboard</router-link>
        <router-link class="link" to="/about">About</router-link>
        <router-link class="link" to="/news">news</router-link>
        <router-link class="link" to="/newsinfo/testparam1">News-1</router-link> -->

        <template v-for="(item, i) in list">
            <div v-if="item.child.length > 0" 
                class="link" 
                :class="{box: item.child.length > 0, open: !item.hide_sub}" 
                :key="'i'+item.id"
                :style="{height: item.height+'px'}"
                @click="openChild(i, item.child.length)" 
            >
                <span class="title">{{ item.title }}</span>
                <div class="childBox">
                    <router-link v-for="(child, ci) in item.child" class="link" :to="child.link" :key="'c'+ci">{{ child.title }}</router-link>
                </div>
            </div>

            <router-link v-else class="link" :to="item.link" :key="'i'+item.id">{{ item.title }}</router-link>
        </template>

    </transition-group>
</template>

<script>
    import { mapState } from "vuex";

    export default {
        name: "sideMenu",
        components: {},
        data: function () {
            return {
                list: {}
            };
        },
        mounted: function () {
            const token = localStorage.getItem("token");
            this.axios({
                url:"/api/backEnd/sidemenu",
                method: "GET",
                data: {},
                headers: { "Authorization": `Bearer ${token}` }
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
        methods: {
            openChild: function(i, length){
                this.list[i].hide_sub = !this.list[i].hide_sub;
                if(this.list[i].hide_sub){
                    this.list[i].height = 40;
                }else{
                    this.list[i].height = 40 * (length + 1);
                }
                console.log(this.list[i].height);
            }
        },
        computed: mapState(["isLogin", "isLoading", "userData"]),
    };
</script>

<style lang="scss">
    .sideMenu {
        display: flex;
        flex-direction: column;
        background: $colorBack2;
        @include setSize(100%, 100%);
        padding: 5px;
        box-sizing: border-box;
        .link {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            @include setSize(100%, 40px);
            padding: 0 15px;
            border-bottom: 1px solid rgba(44, 62, 79, 0.7);
            box-sizing: border-box;

            color: #eee;
            font-weight: bold;
            z-index: 1;
            overflow: hidden;
            &.box{
                justify-content: flex-start;
                transition:  .3s $cubic-FiSo;
                &.open{ height: auto; }
            }
            
            .title{
                flex-shrink: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 40px;
            }
            .childBox{
                background: #333;
            }

            &::before {
                content: "";
                position: absolute;
                top: -1px;
                left: 0;
                background: linear-gradient(to right, #2c3e50 0%, #334e69 100%);
                @include setSize(0, calc(100% + 2px));
                box-shadow: 3px 0 3px 0 rgba(0, 0, 0, 0.15) inset;
                transform: translateX(-10px);
                transition: 0.15s $cubic-FiSo;
                opacity: 0;
                z-index: -1;
            }

            &:hover {
                color: #42b983;
                &::before {
                    width: 80%;
                    opacity: 0.5;
                }
            }
            &.router-link-exact-active {
                align-items: flex-end;
                padding-right: 30px;
                color: $colorSubs;
                &::before {
                    width: calc(100% + 30px);
                    opacity: 1;
                }
            }
        }
    }
</style>
