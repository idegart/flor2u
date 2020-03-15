import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

import partners from './partners'

const store = new Vuex.Store({
    modules: {
        partners,
    },
});

export default store
