import axios from '@plugin/axios'

export default {
    namespaced: true,

    state: {
        partners: [],
        initialized: false,
    },

    actions: {
        load ({state}) {
            state.initialized = true;

            axios.get('/api/partners', {params: {per_page: -1}})
                .then(({data}) => {
                    state.partners = data.data
                })
        },
        initialize ({ state, dispatch }) {
            !state.initialized && dispatch('load')
        },
    },
}
