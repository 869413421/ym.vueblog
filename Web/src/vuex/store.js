import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex)

const state = {
    token: window.localStorage.getItem('token'),
}

const mutations = {
    LoginStatus(state, n) {
        window.localStorage.removeItem('token');
        window.localStorage.setItem('token', n);
    }
}

const actions = {
    Login(conext, n) {
        conext.commit('LoginStatus', n);
    }
}

export default new Vuex.Store({
    state,
    mutations,
    actions
})