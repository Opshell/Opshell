import { computed } from 'vue';
import { useStore, mapGetters, mapState, mapMutations, mapActions } from 'vuex';

const useMapper = (mapper, mapFn) => {
    const store = useStore();

    const storeStateFns = mapFn(mapper);
    const storeState = {};
    Object.keys(storeStateFns).forEach((keyFn) => {
        const fn = storeStateFns[keyFn].bind({ $store: store });
        storeState[keyFn] = computed(fn);
    })

    return storeState;
}

export const store = () => {
    return useStore();
}

export const useState = (mapper) => {
    return useMapper(mapper, mapState);
}

export const useGetters = (mapper) => {
    return useMapper(mapper, mapGetters);
}

export const useMutations = (mapper) => {
    return useMapper(mapper, mapMutations);
}

export const useActions = (mapper) => {
    return useMapper(mapper, mapActions);
}