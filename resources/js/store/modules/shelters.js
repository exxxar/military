import axios from 'axios';

let state = {
    shelterItems: [],
    shelterRegions:[],

}

const getters = {
    shelterItemsCount: state => state.shelterItems.length||0,
    shelterRegionsCount: state => state.shelterRegions.length||0,
    shelterItems: state => state.shelterItems,
    shelterRegions: state => state.shelterRegions,
    shelterItemsById: (state) => (id) => {
        return state.shelterItems.find(shelterItem => shelterItem.id === id)
    },

}

const actions = {
    async getShelterRegions({commit}) {
        return await axios.get(`/api/shelters/regions`).then((response) => {
            commit('UPDATE_SHELTER_REGIONS', response.data)

        }).catch(err => {
            commit('UPDATE_SHELTER_REGIONS',
                !localStorage.getItem('regions_store')  ?
                    [] : JSON.parse(localStorage.getItem('regions_store')))
        })
    },
    async getShelterItems({commit}) {
        return await axios.get(`/api/shelters`).then((response) => {
            commit('UPDATE_SHELTER_ITEMS', response.data)
        }).catch(err => {
            commit('UPDATE_SHELTER_ITEMS',
                !localStorage.getItem('shelters_store')  ?
                    [] : JSON.parse(localStorage.getItem('shelters_store')))
        })
    }
}

const mutations = {
    UPDATE_SHELTER_ITEMS(state, payload) {
        state.shelterItems = payload.data || [];
        localStorage.setItem('shelters_store', JSON.stringify(payload));
    },
    UPDATE_SHELTER_REGIONS(state, payload) {
        state.shelterRegions = payload.data || [];
        localStorage.setItem('regions_store', JSON.stringify(payload));
    }
}

const sheltersModule = {
    state,
    mutations,
    actions,
    getters
}
export default sheltersModule;
