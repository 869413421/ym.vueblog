import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex)

const state = {
    token: window.localStorage.getItem('token') == null ? '' : window.localStorage.getItem('token'),
    user: window.localStorage.getItem('user') == null ? '' : JSON.parse(window.localStorage.getItem('user')),
}

const mutations = {
    TokenMutation(state, n) {
        state.token = n;
        window.localStorage.removeItem('token');
        window.localStorage.setItem('token', n);
    },
    UserMutation(state, n) {
        state.user = n;
        window.localStorage.removeItem('user');
        var user = JSON.stringify(n);
        window.localStorage.setItem('user', user);
    }
}

const actions = {
    DispachToken(conext, n) {
        return conext.commit('TokenMutation', n)
    },
    DispachUser(conext, n) {
        return conext.commit('UserMutation', n)
    }
}

export default new Vuex.Store({
    state,
    mutations,
    actions
})