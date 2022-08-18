export const state = {

};
export const actions = {

};
export const mutations = {

};
export const getters = {
    isAuthenticated: state => !!state.user || !!sessionStorage.getItem("user"),
};

export default {
    state,
    getters,
    actions,
    mutations,
    namespaced: true,
};