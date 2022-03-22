import { createStore } from "vuex"

import user from '@stores/modules/user';

const store = createStore({
    modules: {
        user,
    },
    state() {
        return {};
    },
    mutations: {},
    actions: {},
    getters: {},
})

export default store