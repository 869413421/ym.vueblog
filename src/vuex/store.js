import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const state = {
    count: 0
}

const mutations = {
    mutationsAddNum(state, n = 10) {
        return (state.count += n);
    },
    mutationsReduceNum(state, n = 10) {
        return (state.count -= n);
    }
}

const actions = {
    actionAddNum({ commit }, n) {
        commit('mutationsAddNum', n);
    },
    actionReduceNum({ commit }, n) {
        commit('mutationsReduceNum', n);
    }
}

export default new Vuex.Store({
    state,
    mutations,
    actions
})