declare module '@vue/runtime-core' {
    // 宣告vuex內部的 store state
    interface State {
       count: number
    }

    // 宣告 `this.$store` 型別
    interface ComponentCustomProperties {
       $store: Store<State>
    }
}